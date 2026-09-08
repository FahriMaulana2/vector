<?php

declare(strict_types=1);

use App\Livewire\ProductConfiguratorModal;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\CartService;
use App\Services\PricingEngine;
use Livewire\Livewire;

beforeEach(function () {
    app(CartService::class)->clear();
});

function navigationTestProduct(): Product
{
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'test-cat-nav'],
        ['name' => 'Category Nav', 'is_active' => true]
    );

    return Product::create([
        'product_category_id' => $category->id,
        'name' => 'Produk Navigasi',
        'slug' => 'produk-navigasi',
        'price' => 25000,
        'is_active' => true,
    ]);
}

it('renders navbar menu as route links without section anchors', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('href="'.route('about').'"', false)
        ->assertSee('href="'.route('products.index').'"', false)
        ->assertSee('href="'.route('portfolio.index').'"', false)
        ->assertSee('href="'.route('orders.track').'"', false)
        ->assertDontSee('href="#about"', false)
        ->assertDontSee('href="#services"', false)
        ->assertDontSee('href="#contact"', false);
});

it('keeps contact information and marketplace section on the landing page', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('id="kontak"', false)
        ->assertSee('Hubungi');
});

it('does not render the order form on the landing page', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('wire:submit="submit"', false);
});

it('redirects to the product catalog when opening the order page without a cart', function () {
    $this->get(route('pemesanan'))->assertRedirect(route('products.index'));
});

it('renders the order page when the cart has items', function () {
    $product = navigationTestProduct();
    app(CartService::class)->addItem(app(PricingEngine::class)->calculate($product, 2));

    $this->get(route('pemesanan'))
        ->assertOk()
        ->assertSee('Produk Navigasi');
});

it('sends the configurator continue action to the order page', function () {
    $product = navigationTestProduct();

    Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product->id)
        ->set('qty', 2)
        ->call('addToCart', proceedToForm: true)
        ->assertRedirect(route('pemesanan'));

    expect(app(CartService::class)->count())->toBe(1);
});
