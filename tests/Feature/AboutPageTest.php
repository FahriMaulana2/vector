<?php

use App\Models\AboutMilestone;
use App\Models\AboutStat;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('about page renders with navbar and cta home', function () {
    $response = $this->get(route('about'));
    $response->assertOk();
    $response->assertSee('Pesan Sekarang');
    $response->assertSee('Kembali ke Beranda');
    $response->assertSee(route('home'));
});

test('about page renders dynamic stats and milestones from database', function () {
    AboutStat::create([
        'label' => 'Pelanggan Setia',
        'value' => '3.500+',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    AboutMilestone::create([
        'year' => 2024,
        'title' => 'Peluncuran Studio Digital & Percetakan Modern',
        'description' => 'Ekspansi fasilitas cetak UV dan merchandise.',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->get(route('about'));
    $response->assertOk();
    $response->assertSee('Pelanggan Setia');
    $response->assertSee('3.500+');
    $response->assertSee('Peluncuran Studio Digital & Percetakan Modern');
    $response->assertSee('2024');
});
