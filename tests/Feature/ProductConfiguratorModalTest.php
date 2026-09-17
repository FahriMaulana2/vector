<?php

declare(strict_types=1);

use App\Livewire\ProductConfiguratorModal;
use App\Models\Product;
use App\Services\CartService;
use Database\Seeders\CatalogProductSeeder;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(CatalogProductSeeder::class);
    app(CartService::class)->clear();
});

it('can type qty manually on tiered product without throwing PropertyNotFoundException', function () {
    $product = Product::where('slug', 'cetak-dokumen-stiker-a3-plus')
        ->with('optionGroups.options')
        ->firstOrFail();

    $bahanGroup = $product->optionGroups->firstWhere('name', 'Pilih Bahan');
    $artCarton230 = $bahanGroup->options->firstWhere('name', 'Art Carton 230gr');

    $component = Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product->id)
        ->assertSet('isOpen', true)
        ->set("selectedOptions.{$bahanGroup->id}", $artCarton230->id);

    // User clears input (empty string)
    $component->set('qty', '')
        ->assertNotSet('errorMessage', null)
        ->assertSet('calculationPreview', null);

    // User types 15
    $component->set('qty', '15')
        ->assertSet('errorMessage', null)
        ->assertSet('calculationPreview.qty', 15);
    expect($component->get('calculationPreview.line_subtotal'))->toBeGreaterThan(0);

    // User increments and decrements
    $component->call('incrementQty')
        ->assertSet('qty', 16)
        ->assertSet('calculationPreview.qty', 16);

    // Add to cart
    $component->call('addToCart', proceedToForm: false)
        ->assertDispatched('cart-updated')
        ->assertDispatched('show-toast');

    $cartService = app(CartService::class);
    expect($cartService->count())->toBe(1);
    $item = collect($cartService->getItems())->first();
    expect($item['qty'])->toBe(16);
});

it('can type qty and dimensions manually on area-based product without throwing PropertyNotFoundException', function () {
    $product = Product::where('requires_area_calculation', true)->firstOrFail();

    $component = Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product->id)
        ->assertSet('isOpen', true);

    // Clear and type qty
    $component->set('qty', '')
        ->assertNotSet('errorMessage', null);

    $component->set('qty', '3')
        ->set('lengthM', '')
        ->assertNotSet('errorMessage', null);

    $component->set('lengthM', '2.5')
        ->set('widthM', '')
        ->assertNotSet('errorMessage', null);

    $component->set('widthM', '2.0')
        ->assertSet('errorMessage', null)
        ->assertSet('calculationPreview.qty', 3);

    expect($component->get('calculationPreview.line_subtotal'))->toBeGreaterThan(0);

    $component->call('addToCart', proceedToForm: false)
        ->assertDispatched('cart-updated');

    $cartService = app(CartService::class);
    expect($cartService->count())->toBe(1);
    $item = collect($cartService->getItems())->first();
    expect($item['qty'])->toBe(3)
        ->and($item['length_m'])->toBe(2.5)
        ->and($item['width_m'])->toBe(2.0);
});

it('can type qty manually on standard product without throwing PropertyNotFoundException', function () {
    $product = Product::where('pricing_mode', 'standard')
        ->where('requires_area_calculation', false)
        ->firstOrFail();

    $component = Livewire::test(ProductConfiguratorModal::class)
        ->dispatch('open-configurator', productId: $product->id)
        ->assertSet('isOpen', true);

    $component->set('qty', '')
        ->assertNotSet('errorMessage', null);

    $component->set('qty', '10')
        ->assertSet('errorMessage', null)
        ->assertSet('calculationPreview.qty', 10);
});
