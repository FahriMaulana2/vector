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

it('disables submission and shows error when cart is empty', function () {
    Livewire::test(Pemesanan::class)
        ->set('name', 'Budi')
        ->set('phone', '0812345678')
        ->set('email', 'budi@test.com')
        ->set('shipping_address', 'Jl. Test No 1')
        ->set('design_file_status', 'ready')
        ->call('submit')
        ->assertHasErrors(['cart']);
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
