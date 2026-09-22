<?php

declare(strict_types=1);

use App\Livewire\CartIndicator;
use App\Livewire\Pemesanan;
use App\Livewire\ProductConfiguratorModal;
use App\Models\Product;
use App\Services\CartService;
use Database\Seeders\CatalogProductSeeder;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(CatalogProductSeeder::class);
    app(CartService::class)->clear();
});

it('after removing one item from a 2-item cart, the remaining item still appears in the render without page refresh (regression for Bug 1)', function () {
    $cartService = app(CartService::class);

    $products = Product::take(2)->get();
    expect($products->count())->toBeGreaterThanOrEqual(2, 'Need at least 2 products seeded');

    $product1 = $products->first();
    $product2 = $products->last();

    // 1. Add 2 items to cart
    $uuid1 = $cartService->addItem([
        'product_id' => $product1->id,
        'product_name' => $product1->name,
        'qty' => 2,
        'unit_price' => 50000,
        'line_subtotal' => 100000,
    ]);

    $uuid2 = $cartService->addItem([
        'product_id' => $product2->id,
        'product_name' => $product2->name,
        'qty' => 3,
        'unit_price' => 20000,
        'line_subtotal' => 60000,
    ]);

    expect($cartService->count())->toBe(2);

    // 2. Create the Pemesanan component — it renders both items
    $component = Livewire::test(Pemesanan::class)
        ->assertViewHas('cartCount', 2)
        ->assertSee($product1->name)
        ->assertSee($product2->name);

    // 3. Remove item 1 (simulate what happens after 3s undo timer: $wire.removeItem)
    $component->call('removeItem', $uuid1);

    // 4. Session now has only item 2
    expect($cartService->count())->toBe(1);

    // 5. Assert render AFTER remove: item 2 must still be visible, item 1 must be gone
    $component->assertViewHas('cartCount', 1)
        ->assertSee($product2->name)    // remaining item MUST render
        ->assertDontSee($product1->name); // deleted item must be gone
});

it('after removing item from cart, cartItems view data no longer contains removed uuid', function () {
    $cartService = app(CartService::class);
    $products = Product::take(2)->get();

    $uuid1 = $cartService->addItem([
        'product_id' => $products->first()->id,
        'product_name' => $products->first()->name,
        'qty' => 1,
        'unit_price' => 30000,
        'line_subtotal' => 30000,
    ]);

    $uuid2 = $cartService->addItem([
        'product_id' => $products->last()->id,
        'product_name' => $products->last()->name,
        'qty' => 5,
        'unit_price' => 10000,
        'line_subtotal' => 50000,
    ]);

    $component = Livewire::test(Pemesanan::class);
    $component->call('removeItem', $uuid1);

    $cartItems = $component->viewData('cartItems');
    expect($cartItems)->not->toHaveKey($uuid1)
        ->and($cartItems)->toHaveKey($uuid2)
        ->and($component->viewData('cartCount'))->toBe(1)
        ->and($component->viewData('cartSubtotal'))->toBe(50000.0);
});

it('correctly dispatches and populates Ubah Spesifikasi on the second item in a 2-item cart (Bug 2)', function () {
    $cartService = app(CartService::class);
    $products = Product::where('pricing_mode', 'standard')
        ->where('requires_area_calculation', false)
        ->take(2)
        ->get();
    expect($products->count())->toBe(2);

    $product1 = $products->first();
    $product2 = $products->last();

    // 1. Add item 1 via configurator modal
    Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product1->id)
        ->set('qty', 3)
        ->call('addToCart', proceedToForm: false);

    // 2. Add item 2 via configurator modal
    Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product2->id)
        ->set('qty', 7)
        ->call('addToCart', proceedToForm: false);

    expect($cartService->count())->toBe(2);

    $items = $cartService->getItems();
    $itemKeys = array_keys($items);
    $uuid1 = $itemKeys[0];
    $uuid2 = $itemKeys[1];

    // 3. Test that the rendered HTML in Pemesanan does not have Ubah Spesifikasi, and CartIndicator has the exact dispatch payload for item 2
    $pemesanan = Livewire::test(Pemesanan::class);
    $pemesanan->assertDontSee('Ubah Spesifikasi');

    $indicator = Livewire::test(CartIndicator::class);
    $indicator->assertSee("open-configurator', { productId: {$product2->id}, cartItemUuid: '{$uuid2}' }", escape: false);

    // 4. Simulate clicking Ubah Spesifikasi on item 2 by dispatching the exact event
    $modal = Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product2->id, cartItemUuid: $uuid2)
        ->assertSet('isOpen', true)
        ->assertSet('productId', $product2->id)
        ->assertSet('editingCartItemUuid', $uuid2)
        ->assertSet('qty', 7); // Exactly item 2's qty, NOT item 1 (3) or default min_qty

    // 5. Edit and save item 2
    $modal->set('qty', 15)
        ->call('addToCart', proceedToForm: false)
        ->assertSet('isOpen', false);

    expect($cartService->count())->toBe(2);
    expect($cartService->getItem($uuid2)['qty'])->toBe(15);
    expect($cartService->getItem($uuid1)['qty'])->toBe(3); // Item 1 untouched
});

it('correctly loads Ubah Spesifikasi on remaining item after another item was deleted (Bug 1 + Bug 2 combined)', function () {
    $cartService = app(CartService::class);
    $products = Product::where('pricing_mode', 'standard')
        ->where('requires_area_calculation', false)
        ->take(2)
        ->get();

    $product1 = $products->first();
    $product2 = $products->last();

    Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product1->id)
        ->set('qty', 2)
        ->call('addToCart', proceedToForm: false);

    Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product2->id)
        ->set('qty', 9)
        ->call('addToCart', proceedToForm: false);

    $items = $cartService->getItems();
    $itemKeys = array_keys($items);
    $uuid1 = $itemKeys[0];
    $uuid2 = $itemKeys[1];

    $pemesanan = Livewire::test(Pemesanan::class);

    // Delete item 1
    $pemesanan->call('removeItem', $uuid1);

    // Pemesanan must still render item 2 without Ubah Spesifikasi button
    $pemesanan->assertDontSee('Ubah Spesifikasi');

    // CartIndicator must still render item 2 with its own exact dispatch button
    $indicator = Livewire::test(CartIndicator::class);
    $indicator->assertSee("open-configurator', { productId: {$product2->id}, cartItemUuid: '{$uuid2}' }", escape: false);
    $indicator->assertDontSee("cartItemUuid: '{$uuid1}'", escape: false);

    // Open modal on remaining item
    $modal = Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product2->id, cartItemUuid: $uuid2)
        ->assertSet('isOpen', true)
        ->assertSet('editingCartItemUuid', $uuid2)
        ->assertSet('qty', 9);
});
