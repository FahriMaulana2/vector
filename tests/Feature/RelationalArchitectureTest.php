<?php

use App\Models\Marketplace;
use App\Models\PopupCampaign;
use App\Models\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

it('returns active marketplaces ordered by display_order from Marketplace::getActiveOrdered()', function () {
    Marketplace::create([
        'platform' => 'tokopedia',
        'store_name' => 'Toko 2',
        'display_order' => 2,
        'is_active' => true,
    ]);

    Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Toko 1',
        'display_order' => 1,
        'is_active' => true,
    ]);

    Marketplace::create([
        'platform' => 'tiktok',
        'store_name' => 'Toko Non-aktif',
        'display_order' => 0,
        'is_active' => false,
    ]);

    $active = Marketplace::getActiveOrdered();

    expect($active)->toHaveCount(2)
        ->and($active->first()->platform)->toBe('shopee')
        ->and($active->last()->platform)->toBe('tokopedia');
});

it('fails to insert two marketplaces with the same platform due to unique constraint', function () {
    Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Shopee Official',
    ]);

    expect(function () {
        Marketplace::create([
            'platform' => 'shopee',
            'store_name' => 'Shopee Second Store',
        ]);
    })->toThrow(QueryException::class);
});

it('returns correct cta_final_url for all cta_type options in PopupCampaign', function () {
    $marketplace = Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Shopee Store',
        'store_url' => 'https://shopee.co.id/my-store',
    ]);

    Setting::set('company_whatsapp', '08123456789', 'contact');

    $mpCampaign = PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Marketplace Campaign',
        'description' => 'Desc',
        'cta_type' => 'marketplace',
        'marketplace_id' => $marketplace->id,
        'cta_text' => 'Beli di Shopee',
        'is_active' => true,
    ]);

    $waCampaign = PopupCampaign::create([
        'template_type' => 'code_flash_sale',
        'title' => 'WhatsApp Campaign',
        'description' => 'Desc',
        'cta_type' => 'whatsapp',
        'cta_text' => 'Chat Admin',
        'is_active' => true,
    ]);

    $urlCampaign = PopupCampaign::create([
        'template_type' => 'hybrid_canva',
        'title' => 'Custom URL Campaign',
        'description' => 'Desc',
        'cta_type' => 'custom_url',
        'cta_url' => 'https://example.com/promo',
        'cta_text' => 'Kunjungi Link',
        'is_active' => true,
    ]);

    expect($mpCampaign->cta_final_url)->toBe('https://shopee.co.id/my-store')
        ->and($waCampaign->cta_final_url)->toBe('https://wa.me/628123456789')
        ->and($urlCampaign->cta_final_url)->toBe('https://example.com/promo');
});

it('falls back marketplace CTA to WhatsApp URL when marketplace is inactive or maintenance (Smart Sync)', function () {
    Setting::set('company_whatsapp', '08123456789', 'contact');

    $inactiveMarketplace = Marketplace::create([
        'platform' => 'shopee',
        'store_name' => 'Shopee Maintenance',
        'store_url' => 'https://shopee.co.id/my-store',
        'is_active' => false,
    ]);

    $campaign = PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Marketplace Maintenance Campaign',
        'description' => 'Desc',
        'cta_type' => 'marketplace',
        'marketplace_id' => $inactiveMarketplace->id,
        'cta_text' => 'Beli di Shopee',
        'is_active' => true,
    ]);

    expect($campaign->cta_final_url)->toBe('https://wa.me/628123456789')
        ->and($campaign->is_cta_fallback_active)->toBeTrue();
});

it('falls back marketplace CTA to WhatsApp URL when marketplace_id is null', function () {
    Setting::set('company_whatsapp', '08123456789', 'contact');

    $campaign = PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Orphan Marketplace Campaign',
        'description' => 'Desc',
        'cta_type' => 'marketplace',
        'marketplace_id' => null,
        'cta_text' => 'Beli di Toko',
        'is_active' => true,
    ]);

    expect($campaign->cta_final_url)->toBe('https://wa.me/628123456789')
        ->and($campaign->is_cta_fallback_active)->toBeTrue();
});

it('evaluates is_cta_fallback_active correctly for active marketplaces and non-marketplace CTA types', function () {
    $activeMarketplace = Marketplace::create([
        'platform' => 'tokopedia',
        'store_name' => 'Tokopedia Store',
        'store_url' => 'https://tokopedia.com/my-store',
        'is_active' => true,
    ]);

    $mpCampaign = PopupCampaign::create([
        'template_type' => 'code_welcome',
        'title' => 'Active MP Campaign',
        'description' => 'Desc',
        'cta_type' => 'marketplace',
        'marketplace_id' => $activeMarketplace->id,
        'cta_text' => 'Beli di Tokopedia',
        'is_active' => true,
    ]);

    $waCampaign = PopupCampaign::create([
        'template_type' => 'code_flash_sale',
        'title' => 'WA Campaign',
        'description' => 'Desc',
        'cta_type' => 'whatsapp',
        'cta_text' => 'Chat Admin',
        'is_active' => true,
    ]);

    expect($mpCampaign->is_cta_fallback_active)->toBeFalse()
        ->and($waCampaign->is_cta_fallback_active)->toBeFalse();
});

it('runs data migration correctly when legacy flat columns exist and gracefully handles absent data', function () {
    expect(Schema::hasTable('business_settings'))->toBeFalse()
        ->and(Schema::hasTable('marketplaces'))->toBeTrue()
        ->and(Schema::hasTable('popup_campaigns'))->toBeTrue();

    expect(Schema::hasColumns('settings', [
        'whatsapp_number', 'phone_number', 'email', 'shopee_store_name',
    ]))->toBeFalse();
});

it('ensures legacy Setting key-value methods work without regression after flat columns are dropped', function () {
    Setting::set('company_name', 'Vector Studio', 'general');
    Setting::set('company_whatsapp', '08987654321', 'contact');
    Setting::set('facebook_url', 'https://facebook.com/vector', 'social');

    expect(Setting::getCompanyName())->toBe('Vector Studio')
        ->and(Setting::getWhatsAppNumber())->toBe('08987654321')
        ->and(Setting::getFacebook())->toBe('https://facebook.com/vector')
        ->and(Setting::getWhatsAppLink('Halo'))->toBe('https://wa.me/628987654321?text=Halo');
});
