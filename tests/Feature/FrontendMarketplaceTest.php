<?php

use App\Livewire\Marketplaces as FrontendMarketplaces;
use App\Models\Marketplace;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders active and maintenance marketplaces on frontend component', function () {
    Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Shopee Official Store',
        'store_url' => 'https://shopee.co.id/official',
        'is_active' => true,
        'display_order' => 1,
    ]);

    Marketplace::create([
        'platform' => 'tokopedia',
        'store_name' => 'Tokopedia Maintenance Store',
        'store_url' => 'https://tokopedia.com/maintaining',
        'is_active' => false,
        'maintenance_message' => 'Sedang stok opname',
        'display_order' => 2,
    ]);

    Livewire::test(FrontendMarketplaces::class)
        ->assertStatus(200)
        ->assertSee('Shopee Official Store')
        ->assertSee('Tokopedia Maintenance Store')
        ->assertSee('Sedang stok opname')
        ->assertSee('Kunjungi Toko')
        ->assertSee('Order via WhatsApp');
});

it('uses WhatsApp fallback URL for inactive marketplaces', function () {
    Setting::set('company_whatsapp', '08123456789', 'contact');

    Marketplace::create([
        'platform' => 'tiktok',
        'store_name' => 'TikTok Shop Off',
        'is_active' => false,
    ]);

    Livewire::test(FrontendMarketplaces::class)
        ->assertSee('https://wa.me/628123456789');
});

it('renders empty component cleanly when no marketplaces exist in database', function () {
    Livewire::test(FrontendMarketplaces::class)
        ->assertStatus(200)
        ->assertDontSee('Pesan Produk Kami via Official Store');
});
