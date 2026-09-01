<?php

use App\Livewire\Contact;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Livewire;

it('maps selected products to the correct contact service and falls back to lainnya', function () {
    $component = Livewire::test(Contact::class);

    $component
        ->dispatch('product-selected', productName: 'Undangan Pernikahan Softcover')
        ->assertSet('service', 'Wedding Invitation');

    $component
        ->dispatch('product-selected', productName: 'Tumbler Stainless')
        ->assertSet('service', 'Custom Tumbler');

    $component
        ->dispatch('product-selected', productName: 'Produk Baru Tidak Dikenal')
        ->assertSet('service', 'Lainnya');
});

it('pre-selects the product service and populates message from query parameters on mount', function () {
    $category = ProductCategory::create([
        'name' => 'Custom Souvenir',
        'slug' => 'custom-souvenir',
        'is_active' => true,
    ]);

    Product::create([
        'product_category_id' => $category->id,
        'name' => 'Tumbler Premium Souvenir',
        'slug' => 'tumbler-premium-souvenir',
        'is_active' => true,
    ]);

    // Test the component with query parameters
    Livewire::withQueryParams(['product' => 'tumbler-premium-souvenir'])
        ->test(Contact::class)
        ->assertSet('service', 'Custom Tumbler')
        ->assertSet('message', 'Halo, saya tertarik untuk memesan produk Tumbler Premium Souvenir. Mohon informasi lebih lanjut.');
});
