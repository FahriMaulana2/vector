<?php

use App\Livewire\Admin\Settings\Index as SettingsIndex;
use App\Livewire\Footer;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('renders google maps embed field in admin settings', function () {
    Livewire::test(SettingsIndex::class)
        ->assertSee('Google Maps Embed URL')
        ->assertSee('Masukkan URL embed Google Maps untuk menampilkan lokasi OMAH Vector pada website.')
        ->assertSeeHtml('settings.google_maps_embed');
});

it('saves google maps embed url in settings table under company group', function () {
    $sampleUrl = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28337775945!2d106.75963558832717!3d-6.229569452097722';

    Livewire::test(SettingsIndex::class)
        ->set('settings.company_name', 'OMAH Vector')
        ->set('settings.google_maps_embed', $sampleUrl)
        ->call('save')
        ->assertDispatched('notify');

    expect(Setting::getGoogleMaps())->toBe($sampleUrl);

    $dbSetting = Setting::where('key', 'google_maps_embed')->first();
    expect($dbSetting)->not->toBeNull();
    expect($dbSetting->value)->toBe($sampleUrl);
    expect($dbSetting->group)->toBe('company');
});

it('normalizes full iframe tag into embed url only when saved by admin', function () {
    $cleanUrl = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920';
    $iframeTag = '<iframe src="'.$cleanUrl.'" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

    Livewire::test(SettingsIndex::class)
        ->set('settings.company_name', 'OMAH Vector')
        ->set('settings.google_maps_embed', $iframeTag)
        ->call('save')
        ->assertDispatched('notify');

    expect(Setting::getGoogleMaps())->toBe($cleanUrl);
});

it('reflects updated google maps url in frontend footer', function () {
    $mapUrl = 'https://www.google.com/maps/embed?pb=test-footer-map';

    Setting::set('google_maps_embed', $mapUrl, 'company');
    Setting::forgetCache();

    Livewire::test(Footer::class)
        ->assertSeeHtml('src="'.$mapUrl.'"')
        ->assertSeeHtml('title="Lokasi');
});
