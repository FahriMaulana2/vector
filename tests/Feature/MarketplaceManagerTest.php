<?php

use App\Livewire\Admin\Marketplaces\Index as MarketplaceManager;
use App\Models\BusinessSetting;
use App\Models\Marketplace;
use App\Models\PopupCampaign;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

/*
|--------------------------------------------------------------------------
| BusinessSetting Non-Eloquent Wrapper Tests
|--------------------------------------------------------------------------
*/

it('fallback uses WhatsApp first when company_whatsapp is set', function () {
    Setting::set('company_whatsapp', '08123456789', 'company');
    Setting::set('company_phone', '08987654321', 'company');
    Setting::set('company_email', 'admin@example.com', 'company');

    $wrapper = BusinessSetting::getCached();

    expect($wrapper->getFallbackContact())->toBe([
        'type' => 'whatsapp',
        'value' => '08123456789',
    ])->and($wrapper->getWhatsAppUrl('Halo'))->toBe('https://wa.me/628123456789?text=Halo');
});

it('fallback uses phone if WhatsApp is unavailable', function () {
    Setting::set('company_phone', '08987654321', 'company');
    Setting::set('company_email', 'admin@example.com', 'company');

    $wrapper = BusinessSetting::getCached();

    expect($wrapper->getFallbackContact())->toBe([
        'type' => 'phone',
        'value' => '08987654321',
    ]);
});

it('fallback uses email if WhatsApp and phone are unavailable', function () {
    Setting::set('company_email', 'admin@example.com', 'company');

    $wrapper = BusinessSetting::getCached();

    expect($wrapper->getFallbackContact())->toBe([
        'type' => 'email',
        'value' => 'admin@example.com',
    ]);
});

it('fallback returns null when no contact exists', function () {
    $wrapper = BusinessSetting::getCached();

    expect($wrapper->getFallbackContact())->toBe([
        'type' => null,
        'value' => null,
    ])->and($wrapper->getWhatsAppUrl())->toBeNull();
});

/*
|--------------------------------------------------------------------------
| Marketplace Manager CRUD Livewire Tests
|--------------------------------------------------------------------------
*/

it('renders marketplace manager component cleanly', function () {
    Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Shopee Official',
        'is_active' => true,
    ]);

    Livewire::test(MarketplaceManager::class)
        ->assertStatus(200)
        ->assertSee('Shopee Official');
});

it('can create a new marketplace with valid data', function () {
    Livewire::test(MarketplaceManager::class)
        ->set('platform', 'shopee')
        ->set('store_name', 'Toko Shopee')
        ->set('store_url', 'https://shopee.co.id/toko')
        ->set('is_active', true)
        ->set('display_order', 1)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('marketplaces', [
        'platform' => 'shopee',
        'store_name' => 'Toko Shopee',
        'store_url' => 'https://shopee.co.id/toko',
        'display_order' => 1,
    ]);
});

it('fails to create a marketplace with duplicate platform and shows user-friendly error', function () {
    Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Existing Shopee Store',
    ]);

    Livewire::test(MarketplaceManager::class)
        ->set('platform', 'shopee')
        ->set('store_name', 'Duplicate Shopee Store')
        ->call('save')
        ->assertHasErrors(['platform' => 'unique']);
});

it('can update an existing marketplace', function () {
    $marketplace = Marketplace::create([
        'platform' => 'tokopedia',
        'store_name' => 'Old Toko Name',
        'is_active' => true,
    ]);

    Livewire::test(MarketplaceManager::class)
        ->call('edit', $marketplace->id)
        ->set('store_name', 'Updated Toko Name')
        ->set('is_active', false)
        ->set('maintenance_message', 'Toko sedang libur.')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('marketplaces', [
        'id' => $marketplace->id,
        'store_name' => 'Updated Toko Name',
        'is_active' => false,
        'maintenance_message' => 'Toko sedang libur.',
    ]);
});

it('can toggle marketplace status between active and maintenance', function () {
    $marketplace = Marketplace::create([
        'platform' => 'tiktok',
        'store_name' => 'TikTok Shop',
        'is_active' => true,
    ]);

    Livewire::test(MarketplaceManager::class)
        ->call('toggleStatus', $marketplace->id);

    expect($marketplace->fresh()->is_active)->toBeFalse();
});

it('deletes marketplace and nulls out marketplace_id in linked popup_campaigns (nullOnDelete)', function () {
    $marketplace = Marketplace::create([
        'platform' => 'blibli',
        'store_name' => 'Blibli Store',
        'is_active' => true,
    ]);

    $campaign = PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Blibli Campaign',
        'description' => 'Desc',
        'cta_type' => 'marketplace',
        'marketplace_id' => $marketplace->id,
        'cta_text' => 'Beli di Blibli',
        'is_active' => true,
    ]);

    Livewire::test(MarketplaceManager::class)
        ->call('confirmDelete', $marketplace->id)
        ->assertSet('deletingCampaignCount', 1)
        ->call('delete');

    $this->assertDatabaseMissing('marketplaces', [
        'id' => $marketplace->id,
    ]);

    expect($campaign->fresh())
        ->not->toBeNull()
        ->and($campaign->fresh()->marketplace_id)->toBeNull();
});
