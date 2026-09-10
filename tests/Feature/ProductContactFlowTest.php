<?php

declare(strict_types=1);

use App\Livewire\Pemesanan;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\CartService;
use App\Services\PricingEngine;
use Livewire\Livewire;

beforeEach(function () {
    app(CartService::class)->clear();
});

it('redirects to products index when cart is empty on mount', function () {
    Livewire::test(Pemesanan::class)
        ->assertRedirect(route('products.index'));
});

it('validates required checkout fields', function () {
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'test-cat-cf'],
        ['name' => 'Category CF', 'is_active' => true]
    );

    $product = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Produk Tes',
        'slug' => 'produk-tes-cf',
        'price' => 10000,
        'is_active' => true,
    ]);

    $cartService = app(CartService::class);
    $itemData = app(PricingEngine::class)->calculate($product, 1);
    $cartService->addItem($itemData);

    Livewire::test(Pemesanan::class)
        ->set('name', '')
        ->set('phone', '')
        ->set('email', 'bukan-email')
        ->set('shipping_address', '')
        ->call('submit')
        ->assertHasErrors(['name', 'phone', 'email', 'shipping_address']);
});
