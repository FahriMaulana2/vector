<?php

use App\Livewire\Contact;
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
