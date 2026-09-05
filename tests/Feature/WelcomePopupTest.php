<?php

use App\Livewire\WelcomePopup;
use App\Models\Marketplace;
use App\Models\PopupCampaign;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders nothing when no active popup campaign exists', function () {
    Cache::forget('active_popup');

    Livewire::test(WelcomePopup::class)
        ->assertStatus(200)
        ->assertDontSee('role="dialog"');
});

it('renders active campaign and resolves correct CTA URL', function () {
    Cache::forget('active_popup');
    Setting::set('company_whatsapp', '08123456789', 'contact');

    $marketplace = Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Shopee Official Store',
        'store_url' => 'https://shopee.co.id/omah',
        'is_active' => true,
    ]);

    $campaign = PopupCampaign::create([
        'template_type' => 'code_flash_sale',
        'title' => 'Diskon Promo Merdeka',
        'description' => 'Dapatkan diskon 20% cetak banner',
        'cta_type' => 'marketplace',
        'marketplace_id' => $marketplace->id,
        'cta_text' => 'Klaim Diskon',
        'is_active' => true,
    ]);

    Livewire::test(WelcomePopup::class)
        ->assertStatus(200)
        ->assertSee('Diskon Promo Merdeka')
        ->assertSee('Dapatkan diskon 20% cetak banner')
        ->assertSee('https://shopee.co.id/omah');
});

it('increments view count exactly once when recordView is called', function () {
    Cache::forget('active_popup');

    $campaign = PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Welcome Campaign',
        'description' => 'Selamat datang di OMAH Vector',
        'cta_type' => 'custom_url',
        'cta_url' => 'https://example.com/welcome',
        'cta_text' => 'Buka Link',
        'is_active' => true,
    ]);

    $component = Livewire::test(WelcomePopup::class);

    $component->call('recordView');
    expect($campaign->fresh()->view_count)->toBe(1);

    // Submitting view again in same component session should be guarded
    $component->call('recordView');
    expect($campaign->fresh()->view_count)->toBe(1);
});

it('increments click count when recordClick is called', function () {
    Cache::forget('active_popup');

    $campaign = PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Welcome Campaign Click',
        'description' => 'Deskripsi',
        'cta_type' => 'custom_url',
        'cta_url' => 'https://example.com',
        'cta_text' => 'Klik Sini',
        'is_active' => true,
    ]);

    Livewire::test(WelcomePopup::class)
        ->call('recordClick');

    expect($campaign->fresh()->click_count)->toBe(1);
});

it('triggers Smart Sync fallback notification when campaign marketplace is inactive', function () {
    Cache::forget('active_popup');
    Setting::set('company_whatsapp', '08123456789', 'contact');

    $inactiveMarketplace = Marketplace::create([
        'platform' => 'tokopedia',
        'store_name' => 'Tokopedia Off',
        'store_url' => 'https://tokopedia.com/off',
        'is_active' => false,
    ]);

    PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Campaign Maintenance',
        'description' => 'Deskripsi',
        'cta_type' => 'marketplace',
        'marketplace_id' => $inactiveMarketplace->id,
        'cta_text' => 'Beli Sekarang',
        'is_active' => true,
    ]);

    Livewire::test(WelcomePopup::class)
        ->assertSee('Toko Sedang Maintenance')
        ->assertSee('https://wa.me/628987654321', false); // falls back to WhatsApp
});
