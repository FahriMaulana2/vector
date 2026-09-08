<?php

declare(strict_types=1);

use App\Livewire\Pemesanan;
use App\Livewire\ProductConfiguratorModal;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\ProductOptionGroup;
use App\Models\ProductQtyPriceTier;
use App\Services\CartService;
use App\Services\PricingEngine;
use Livewire\Livewire;

beforeEach(function () {
    app(CartService::class)->clear();
});

it('throws exception on qty_tiered product when no tier matches instead of falling back to zero', function () {
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'test-cat'],
        ['name' => 'Test Category', 'is_active' => true]
    );

    $product = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Cetak A3+ Qty Tiered',
        'slug' => 'cetak-a3-qty-tiered',
        'price' => null,
        'pricing_mode' => 'qty_tiered',
        'base_price_unit' => 'lembar',
        'supports_2_sisi' => true,
        'min_qty' => 5,
        'is_active' => true,
    ]);

    // Tier starts from qty 10
    ProductQtyPriceTier::create([
        'product_id' => $product->id,
        'side_mode' => '1_muka',
        'min_qty' => 10,
        'price_per_unit' => 8000,
        'is_active' => true,
    ]);

    $engine = app(PricingEngine::class);

    // Qty 6 is below tier min_qty 10 -> must throw exception, never 0
    expect(fn () => $engine->calculate($product, 6, [], '1_muka'))
        ->toThrow(InvalidArgumentException::class, 'Kombinasi jumlah (6) dan sisi cetak (1_muka) tidak tersedia');
});

it('calculates tiered pricing with side_mode 1_muka vs 2_muka correctly', function () {
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'test-cat'],
        ['name' => 'Test Category', 'is_active' => true]
    );

    $product = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Cetak A3+ Real Data',
        'slug' => 'cetak-a3-real-data',
        'price' => null,
        'pricing_mode' => 'qty_tiered',
        'base_price_unit' => 'lembar',
        'supports_2_sisi' => true,
        'min_qty' => 1,
        'is_active' => true,
    ]);

    ProductQtyPriceTier::create([
        'product_id' => $product->id,
        'side_mode' => '1_muka',
        'min_qty' => 1,
        'price_per_unit' => 8000,
        'is_active' => true,
    ]);

    ProductQtyPriceTier::create([
        'product_id' => $product->id,
        'side_mode' => '2_muka',
        'min_qty' => 1,
        'price_per_unit' => 9500,
        'is_active' => true,
    ]);

    $engine = app(PricingEngine::class);

    $res1 = $engine->calculate($product, 5, [], '1_muka');
    expect($res1['unit_price'])->toBe(8000.0)
        ->and($res1['line_subtotal'])->toBe(40000.0);

    $res2 = $engine->calculate($product, 5, [], '2_muka');
    expect($res2['unit_price'])->toBe(9500.0)
        ->and($res2['line_subtotal'])->toBe(47500.0);
});

it('handles absolute price_mode, per_length_m unit, and per-option manual quote in PricingEngine', function () {
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'test-cat'],
        ['name' => 'Test Category', 'is_active' => true]
    );

    $product = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Cetak Foto Custom',
        'slug' => 'cetak-foto-custom',
        'price' => 10000,
        'pricing_mode' => 'standard',
        'base_price_unit' => 'pcs',
        'min_qty' => 1,
        'is_active' => true,
    ]);

    $group = ProductOptionGroup::create([
        'product_id' => $product->id,
        'name' => 'Ukuran Cetak',
        'is_required' => true,
    ]);

    $option10R = ProductOption::create([
        'product_option_group_id' => $group->id,
        'name' => 'Ukuran 10R',
        'price_mode' => 'absolute',
        'price_unit' => 'flat',
        'price_delta' => 25000,
        'requires_manual_quote' => false,
    ]);

    $optionManual = ProductOption::create([
        'product_option_group_id' => $group->id,
        'name' => 'Laminasi & Figura Custom',
        'price_mode' => 'delta',
        'price_unit' => 'flat',
        'price_delta' => 0,
        'requires_manual_quote' => true,
    ]);

    $engine = app(PricingEngine::class);

    // Absolute override replaces base price of 10000 with 25000
    $calcAbsolute = $engine->calculate($product, 2, [$option10R->id]);
    expect($calcAbsolute['unit_price'])->toBe(25000.0)
        ->and($calcAbsolute['line_subtotal'])->toBe(50000.0)
        ->and($calcAbsolute['manual_quote_flag'])->toBeFalse();

    // Option requiring manual quote sets flag
    $calcManual = $engine->calculate($product, 1, [$optionManual->id]);
    expect($calcManual['manual_quote_flag'])->toBeTrue()
        ->and($calcManual['manual_quote_note'])->toContain('Laminasi & Figura Custom');
});

it('adds 2 different products to cart via Tambah & Pilih Produk Lain and successfully submits order form', function () {
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'branding'],
        ['name' => 'Branding', 'is_active' => true]
    );

    $product1 = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Kartu Nama Bisnis',
        'slug' => 'kartu-nama-bisnis',
        'price' => 50000,
        'pricing_mode' => 'standard',
        'base_price_unit' => 'pcs',
        'min_qty' => 1,
        'is_active' => true,
    ]);

    $product2 = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Brosur Lipat Tiga Promosi',
        'slug' => 'brosur-lipat-tiga-promosi',
        'price' => 1500,
        'pricing_mode' => 'standard',
        'base_price_unit' => 'lembar',
        'min_qty' => 10,
        'is_active' => true,
    ]);

    // 1. Add Product 1 via Configurator Modal (stay in catalog)
    Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product1->id)
        ->assertSet('isOpen', true)
        ->assertSet('product.id', $product1->id)
        ->set('qty', 2)
        ->call('addToCart', proceedToForm: false)
        ->assertSet('isOpen', false)
        ->assertDispatched('cart-updated')
        ->assertDispatched('show-toast');

    // 2. Add Product 2 via Configurator Modal (stay in catalog)
    Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product2->id)
        ->assertSet('isOpen', true)
        ->assertSet('product.id', $product2->id)
        ->set('qty', 100)
        ->call('addToCart', proceedToForm: false)
        ->assertSet('isOpen', false)
        ->assertDispatched('cart-updated');

    // Verify CartService holds 2 items
    $cartService = app(CartService::class);
    expect($cartService->count())->toBe(2);
    // Product 1: 50,000 * 2 = 100,000. Product 2: 1,500 * 100 = 150,000. Total = 250,000.
    expect($cartService->getSubtotal())->toBe(250000.0);

    // 3. Submit from Pemesanan form
    Livewire::test(Pemesanan::class)
        ->assertViewHas('cartCount', 2)
        ->assertViewHas('cartSubtotal', 250000.0)
        ->set('name', 'Budi Pratama')
        ->set('phone', '081234567890')
        ->set('email', 'budi@example.com')
        ->set('shipping_address', 'Jl. Merdeka No. 45, RT 01/RW 02, Jakarta')
        ->set('design_file_status', 'ready')
        ->set('notes', 'Tolong packing kayu yang aman.')
        ->call('submit')
        ->assertHasNoErrors();

    // 4. Assertions: 1 Order and 2 OrderItems created in database
    expect(Order::count())->toBeGreaterThanOrEqual(1);

    $order = Order::with('orderItems')->where('customer_email', 'budi@example.com')->latest()->first();
    expect($order)->not->toBeNull()
        ->and($order->customer_name)->toBe('Budi Pratama')
        ->and($order->product_id)->toBeNull()
        ->and($order->quantity)->toBeNull()
        ->and($order->shipping_address)->toBe('Jl. Merdeka No. 45, RT 01/RW 02, Jakarta')
        ->and($order->design_file_status)->toBe('ready')
        ->and((float) $order->subtotal)->toBe(250000.0)
        ->and($order->orderItems)->toHaveCount(2);

    $item1 = $order->orderItems->firstWhere('product_id', $product1->id);
    expect($item1)->not->toBeNull()
        ->and($item1->qty)->toBe(2)
        ->and((float) $item1->line_subtotal)->toBe(100000.0);

    $item2 = $order->orderItems->firstWhere('product_id', $product2->id);
    expect($item2)->not->toBeNull()
        ->and($item2->qty)->toBe(100)
        ->and((float) $item2->line_subtotal)->toBe(150000.0);

    // 5. Assert cart session is completely empty after successful submit
    expect($cartService->count())->toBe(0)
        ->and($cartService->getItems())->toBeEmpty();
});
