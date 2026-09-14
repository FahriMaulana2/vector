<?php

declare(strict_types=1);

use App\Livewire\Admin\Products\Form;
use App\Models\Product;
use App\Services\PricingEngine;
use Database\Seeders\CatalogProductSeeder;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(CatalogProductSeeder::class);
});

it('calculates Cetak A3+ Art Carton 230gr qty 15 2 muka as Rp8500 per lembar', function () {
    $product = Product::where('slug', 'cetak-dokumen-stiker-a3-plus')
        ->with('optionGroups.options')
        ->firstOrFail();

    $bahanGroup = $product->optionGroups->firstWhere('name', 'Pilih Bahan');
    expect($bahanGroup)->not->toBeNull();

    $artCarton230 = $bahanGroup->options->firstWhere('name', 'Art Carton 230gr');
    expect($artCarton230)->not->toBeNull();

    $pricingEngine = app(PricingEngine::class);

    // Qty = 15, 2_muka -> should match min_qty=10 tier for 2_muka = 8500
    $result = $pricingEngine->calculate(
        product: $product,
        qty: 15,
        selectedOptionIds: [$bahanGroup->id => $artCarton230->id],
        sideMode: '2_muka'
    );

    expect($result['unit_price'])->toBe(8500.0)
        ->and($result['base_price_snapshot'])->toBe(8500.0)
        ->and($result['qty'])->toBe(15)
        ->and($result['line_subtotal'])->toBe(127500.0)
        ->and($result['side_mode'])->toBe('2_muka');
});

it('calculates Cetak A3+ Art Carton 230gr with different quantities and sides correctly', function () {
    $product = Product::where('slug', 'cetak-dokumen-stiker-a3-plus')
        ->with('optionGroups.options')
        ->firstOrFail();

    $bahanGroup = $product->optionGroups->firstWhere('name', 'Pilih Bahan');
    $artCarton230 = $bahanGroup->options->firstWhere('name', 'Art Carton 230gr');

    $pricingEngine = app(PricingEngine::class);

    // Qty 15, 1_muka -> tier 10 = 7000
    $res1 = $pricingEngine->calculate(
        product: $product,
        qty: 15,
        selectedOptionIds: [$artCarton230->id],
        sideMode: '1_muka'
    );
    expect($res1['unit_price'])->toBe(7000.0)
        ->and($res1['line_subtotal'])->toBe(105000.0);

    // Qty 5, 2_muka -> tier 1 = 9500
    $res2 = $pricingEngine->calculate(
        product: $product,
        qty: 5,
        selectedOptionIds: [$artCarton230->id],
        sideMode: '2_muka'
    );
    expect($res2['unit_price'])->toBe(9500.0)
        ->and($res2['line_subtotal'])->toBe(47500.0);

    // Qty 5, 1_muka -> tier 1 = 8000
    $res3 = $pricingEngine->calculate(
        product: $product,
        qty: 5,
        selectedOptionIds: [$artCarton230->id],
        sideMode: '1_muka'
    );
    expect($res3['unit_price'])->toBe(8000.0)
        ->and($res3['line_subtotal'])->toBe(40000.0);
});

it('does not allow 2 muka for 1 muka only materials like Sticker Kromo', function () {
    $product = Product::where('slug', 'cetak-dokumen-stiker-a3-plus')
        ->with('optionGroups.options')
        ->firstOrFail();

    $bahanGroup = $product->optionGroups->firstWhere('name', 'Pilih Bahan');
    $kromo = $bahanGroup->options->firstWhere('name', 'Sticker Kromo');

    $pricingEngine = app(PricingEngine::class);

    // 1 muka works
    $res = $pricingEngine->calculate(
        product: $product,
        qty: 10,
        selectedOptionIds: [$kromo->id],
        sideMode: '1_muka'
    );
    expect($res['unit_price'])->toBe(9000.0);

    // 2 muka should throw exception because Sticker Kromo has no 2_muka tier
    expect(fn () => $pricingEngine->calculate(
        product: $product,
        qty: 10,
        selectedOptionIds: [$kromo->id],
        sideMode: '2_muka'
    ))->toThrow(InvalidArgumentException::class);
});

it('calculates Cetak A3+ with finishing add-ons correctly', function () {
    $product = Product::where('slug', 'cetak-dokumen-stiker-a3-plus')
        ->with('optionGroups.options')
        ->firstOrFail();

    $bahanGroup = $product->optionGroups->firstWhere('name', 'Pilih Bahan');
    $artCarton230 = $bahanGroup->options->firstWhere('name', 'Art Carton 230gr');

    $finishingGroup = $product->optionGroups->firstWhere('name', 'Finishing');
    $cuttingPutus = $finishingGroup->options->firstWhere('name', 'Cutting Putus'); // +3500
    $laminasiDoff = $finishingGroup->options->firstWhere('name', 'Laminasi Doff'); // +3000

    $pricingEngine = app(PricingEngine::class);

    // Qty 10, 1_muka (tier=7000) + Cutting Putus (3500) + Laminasi Doff (3000) = 13500/lembar
    $result = $pricingEngine->calculate(
        product: $product,
        qty: 10,
        selectedOptionIds: [$artCarton230->id, $cuttingPutus->id, $laminasiDoff->id],
        sideMode: '1_muka'
    );

    expect($result['base_price_snapshot'])->toBe(7000.0)
        ->and($result['options_total'])->toBe(6500.0)
        ->and($result['unit_price'])->toBe(13500.0)
        ->and($result['line_subtotal'])->toBe(135000.0);
});

it('calculates Eco Solvent Stiker with area calculation and meteran cutting', function () {
    $product = Product::where('slug', 'stiker-indoor-eco-solvent')
        ->with('optionGroups.options')
        ->firstOrFail();

    $bahanGroup = $product->optionGroups->firstWhere('name', 'Pilih Bahan');
    $maxdecalGlossy = $bahanGroup->options->firstWhere('name', 'Maxdecal Glossy'); // absolute 150000

    $cuttingGroup = $product->optionGroups->firstWhere('name', 'Cutting Meteran');
    $cuttingHalf = $cuttingGroup->options->firstWhere('name', 'Half'); // 25000 per_length_m

    $pricingEngine = app(PricingEngine::class);

    // Area: length 2m, width 1m -> area = 2 m2
    // Base price = 150000 * 2 = 300000
    // Cutting: 25000 * length 2m = 50000
    // Unit price = 350000. Qty = 2 -> subtotal = 700000
    $result = $pricingEngine->calculate(
        product: $product,
        qty: 2,
        selectedOptionIds: [$maxdecalGlossy->id, $cuttingHalf->id],
        sideMode: '1_muka',
        lengthM: 2.0,
        widthM: 1.0
    );

    expect($result['base_price_snapshot'])->toBe(300000.0)
        ->and($result['options_total'])->toBe(50000.0)
        ->and($result['unit_price'])->toBe(350000.0)
        ->and($result['line_subtotal'])->toBe(700000.0);
});

it('calculates Cetak Foto with sizes and add-ons', function () {
    $product = Product::where('slug', 'cetak-foto')
        ->with('optionGroups.options')
        ->firstOrFail();

    $ukuranGroup = $product->optionGroups->firstWhere('name', 'Ukuran');
    $size12R = $ukuranGroup->options->firstWhere('name', '12R'); // absolute 40000

    $addOnGroup = $product->optionGroups->firstWhere('name', 'Add-on');
    $editBg = $addOnGroup->options->firstWhere('name', 'Edit Background'); // +3000
    $laminasi = $addOnGroup->options->firstWhere('name', 'Laminasi'); // manual quote

    $pricingEngine = app(PricingEngine::class);

    $result = $pricingEngine->calculate(
        product: $product,
        qty: 3,
        selectedOptionIds: [$size12R->id, $editBg->id, $laminasi->id]
    );

    expect($result['base_price_snapshot'])->toBe(40000.0)
        ->and($result['options_total'])->toBe(3000.0)
        ->and($result['unit_price'])->toBe(43000.0)
        ->and($result['line_subtotal'])->toBe(129000.0)
        ->and($result['manual_quote_flag'])->toBeTrue();
});

it('calculates Sablon DTF with sizes and long sleeve model', function () {
    $product = Product::where('slug', 'sablon-dtf')
        ->with('optionGroups.options')
        ->firstOrFail();

    $ukuranGroup = $product->optionGroups->firstWhere('name', 'Ukuran');
    $sizeXXL = $ukuranGroup->options->firstWhere('name', 'XXL'); // +5000

    $modelGroup = $product->optionGroups->firstWhere('name', 'Model');
    $modelPanjang = $modelGroup->options->firstWhere('name', 'Panjang'); // +10000

    $finishingGroup = $product->optionGroups->firstWhere('name', 'Finishing');
    $upgradePlastisol = $finishingGroup->options->firstWhere('name', 'Upgrade Plastisol'); // +10000

    $pricingEngine = app(PricingEngine::class);

    // Base 65000 + 5000 + 10000 + 10000 = 90000/pcs. Qty 2 = 180000
    $result = $pricingEngine->calculate(
        product: $product,
        qty: 2,
        selectedOptionIds: [$sizeXXL->id, $modelPanjang->id, $upgradePlastisol->id]
    );

    expect($result['base_price_snapshot'])->toBe(65000.0)
        ->and($result['unit_price'])->toBe(90000.0)
        ->and($result['line_subtotal'])->toBe(180000.0);
});

it('enforces min_qty 100 on Undangan product', function () {
    $product = Product::where('slug', 'undangan')
        ->with('optionGroups.options')
        ->firstOrFail();

    $modelGroup = $product->optionGroups->firstWhere('name', 'Model');
    $model1 = $modelGroup->options->first();

    $pricingEngine = app(PricingEngine::class);

    expect(fn () => $pricingEngine->calculate($product, 50, [$model1->id]))
        ->toThrow(InvalidArgumentException::class, 'Jumlah minimum pemesanan untuk Undangan adalah 100 pcs.');

    $result = $pricingEngine->calculate($product, 100, [$model1->id]);
    expect($result['unit_price'])->toBe(1000.0)
        ->and($result['line_subtotal'])->toBe(100000.0);
});

it('loads and saves tiers with option_id in admin product form', function () {
    $product = Product::where('slug', 'cetak-dokumen-stiker-a3-plus')->firstOrFail();

    Livewire::test(Form::class, ['product' => $product->id])
        ->assertOk()
        ->assertSet('isEditing', true)
        ->assertSee('Art Carton 230gr')
        ->assertSee('Tabel Harga per Qty');

    $firstTier = $product->qtyPriceTiers()->whereNotNull('option_id')->first();
    expect($firstTier)->not->toBeNull()
        ->and($firstTier->option_id)->toBeGreaterThan(0);
});
