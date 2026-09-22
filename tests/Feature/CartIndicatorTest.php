<?php

declare(strict_types=1);

use App\Livewire\CartIndicator;
use App\Models\Product;
use App\Services\CartService;
use Database\Seeders\CatalogProductSeeder;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(CatalogProductSeeder::class);
    app(CartService::class)->clear();
});

it('renders hidden or empty when cart has 0 items', function () {
    $cartService = app(CartService::class);
    expect($cartService->count())->toBe(0);

    Livewire::test(CartIndicator::class)
        ->assertViewHas('count', 0)
        ->assertDontSee('Lanjut ke Pemesanan');
});

it('renders floating cart badge and subtotal when items are added to cart and reacts to cart-updated event', function () {
    $cartService = app(CartService::class);

    $product = Product::firstOrFail();

    $cartService->addItem([
        'product_id' => $product->id,
        'product_name' => $product->name,
        'qty' => 3,
        'unit_price' => 15000,
        'line_subtotal' => 45000,
    ]);

    expect($cartService->count())->toBe(1);

    $component = Livewire::test(CartIndicator::class)
        ->assertViewHas('count', 1)
        ->assertViewHas('subtotal', 45000.0)
        ->assertSee('45.000')
        ->assertSee($product->name)
        ->assertSee('Lanjut ke Pemesanan');

    // Add another item directly to cart and dispatch cart-updated
    $cartService->addItem([
        'product_id' => $product->id,
        'product_name' => $product->name,
        'qty' => 2,
        'unit_price' => 10000,
        'line_subtotal' => 20000,
    ]);

    $component->dispatch('cart-updated')
        ->assertViewHas('count', 2)
        ->assertViewHas('subtotal', 65000.0)
        ->assertSee('65.000');
});

it('renders Ubah button with open-configurator dispatch and wire:key for each cart item in dropdown', function () {
    $cartService = app(CartService::class);
    $product = Product::firstOrFail();

    $uuid = $cartService->addItem([
        'product_id' => $product->id,
        'product_name' => $product->name,
        'qty' => 5,
        'unit_price' => 15000,
        'line_subtotal' => 75000,
    ]);

    Livewire::test(CartIndicator::class)
        ->assertSee("wire:key=\"cart-dropdown-item-{$uuid}\"", escape: false)
        ->assertSee("open-configurator', { productId: {$product->id}, cartItemUuid: '{$uuid}' }", escape: false)
        ->assertSee('Ubah');
});

it('does not render cart indicator dropdown/trigger on pemesanan route', function () {
    $cartService = app(CartService::class);
    $product = Product::firstOrFail();

    $cartService->addItem([
        'product_id' => $product->id,
        'product_name' => $product->name,
        'qty' => 1,
        'unit_price' => 10000,
        'line_subtotal' => 10000,
    ]);

    $this->get(route('pemesanan'))
        ->assertOk()
        ->assertDontSee('Buka Keranjang Pesanan')
        ->assertDontSee('Keranjang Pesanan');
});
