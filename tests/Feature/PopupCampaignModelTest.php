<?php

use App\Models\BusinessSetting;
use App\Models\Marketplace;
use App\Models\PopupCampaign;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

it('adds marketplaces and popup_campaigns schema while confirming business_settings is dropped', function () {
    expect(Schema::hasTable('business_settings'))->toBeFalse()
        ->and(Schema::hasTable('marketplaces'))->toBeTrue()
        ->and(Schema::hasColumns('marketplaces', [
            'platform', 'store_name', 'store_url', 'logo_url', 'is_active', 'maintenance_message', 'display_order',
        ]))->toBeTrue()
        ->and(Schema::hasTable('popup_campaigns'))->toBeTrue()
        ->and(Schema::hasColumns('popup_campaigns', [
            'template_type', 'image_path', 'title', 'description', 'cta_type',
            'marketplace_id', 'cta_url', 'cta_text', 'is_active', 'starts_at', 'ends_at',
            'view_count', 'click_count',
        ]))->toBeTrue();
});

it('resolves fallback contacts in priority order via BusinessSetting wrapper', function () {
    Setting::set('company_phone', '08123456789', 'company');
    Setting::set('company_email', 'hello@example.com', 'company');

    $businessSetting = BusinessSetting::getCached();

    expect($businessSetting->getFallbackContact())->toBe([
        'type' => 'phone',
        'value' => '08123456789',
    ])->and($businessSetting->hasFallbackContact())->toBeTrue();
});

it('returns the latest currently active campaign', function () {
    Cache::forget('active_popup');

    $marketplace = Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Shopee Official',
        'store_url' => 'https://shopee.co.id/official',
    ]);

    PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Expired',
        'description' => 'Expired campaign',
        'cta_type' => 'marketplace',
        'marketplace_id' => $marketplace->id,
        'cta_text' => 'Shop',
        'is_active' => true,
        'ends_at' => now()->subMinute(),
    ]);

    $campaign = PopupCampaign::create([
        'template_type' => 'code_flash_sale',
        'title' => 'Current',
        'description' => 'Current campaign',
        'cta_type' => 'custom_url',
        'cta_text' => 'Open',
        'cta_url' => 'https://example.com',
        'is_active' => true,
    ]);

    expect(PopupCampaign::getActiveCampaign()?->is($campaign))->toBeTrue();
});
