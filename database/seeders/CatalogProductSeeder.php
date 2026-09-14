<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\ProductOptionGroup;
use App\Models\ProductQtyPriceTier;
use Illuminate\Database\Seeder;

class CatalogProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories
        $apparelCategory = ProductCategory::firstOrCreate(
            ['slug' => 'apparel'],
            ['name' => 'Apparel', 'sort_order' => 1, 'is_active' => true]
        );

        $printingCategory = ProductCategory::firstOrCreate(
            ['slug' => 'printing'],
            ['name' => 'Printing', 'sort_order' => 2, 'is_active' => true]
        );

        $signageCategory = ProductCategory::firstOrCreate(
            ['slug' => 'signage'],
            ['name' => 'Signage', 'sort_order' => 3, 'is_active' => true]
        );

        $invitationCategory = ProductCategory::firstOrCreate(
            ['slug' => 'invitation'],
            ['name' => 'Invitation', 'sort_order' => 4, 'is_active' => true]
        );

        // Helper for option groups
        $seedOptions = function (Product $product, array $groupsData): void {
            foreach ($groupsData as $gIdx => $gData) {
                $group = ProductOptionGroup::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $gData['name'],
                    ],
                    [
                        'type' => $gData['type'] ?? 'radio',
                        'is_required' => $gData['is_required'] ?? false,
                        'sort_order' => $gIdx,
                    ]
                );

                foreach ($gData['options'] as $oIdx => $oData) {
                    ProductOption::updateOrCreate(
                        [
                            'product_option_group_id' => $group->id,
                            'name' => $oData['name'],
                        ],
                        [
                            'price_mode' => $oData['price_mode'] ?? 'delta',
                            'price_unit' => $oData['price_unit'] ?? 'flat',
                            'price_delta' => $oData['price_delta'] ?? 0,
                            'requires_manual_quote' => $oData['requires_manual_quote'] ?? false,
                            'is_default' => $oData['is_default'] ?? false,
                            'sort_order' => $oIdx,
                        ]
                    );
                }
            }
        };

        /*
        |--------------------------------------------------------------------------
        | 1. Apparel: Sablon DTF
        |--------------------------------------------------------------------------
        */
        $dtf = Product::updateOrCreate(
            ['slug' => 'sablon-dtf'],
            [
                'product_category_id' => $apparelCategory->id,
                'name' => 'Sablon DTF',
                'description' => 'Cetak sablon DTF berkualitas tinggi untuk berbagai jenis kaos.',
                'pricing_mode' => 'standard',
                'price' => 65000,
                'base_price_unit' => 'pcs',
                'min_qty' => 1,
                'is_active' => true,
            ]
        );

        $seedOptions($dtf, [
            [
                'name' => 'Ukuran',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'S', 'price_delta' => 0, 'is_default' => true],
                    ['name' => 'M', 'price_delta' => 0],
                    ['name' => 'L', 'price_delta' => 0],
                    ['name' => 'XL', 'price_delta' => 0],
                    ['name' => 'XXL', 'price_delta' => 5000],
                    ['name' => '3XL', 'price_delta' => 10000],
                    ['name' => '4XL', 'price_delta' => 15000],
                ],
            ],
            [
                'name' => 'Model',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'Pendek', 'price_delta' => 0, 'is_default' => true],
                    ['name' => 'Panjang', 'price_delta' => 10000],
                ],
            ],
            [
                'name' => 'Finishing',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'Tanpa', 'price_delta' => 0, 'is_default' => true],
                    ['name' => 'Upgrade Plastisol', 'price_delta' => 10000],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. Apparel: Sablon Plastisol
        |--------------------------------------------------------------------------
        */
        $plastisol = Product::updateOrCreate(
            ['slug' => 'sablon-plastisol'],
            [
                'product_category_id' => $apparelCategory->id,
                'name' => 'Sablon Plastisol',
                'description' => 'Cetak sablon Plastisol tahan lama dengan tekstur mantap.',
                'pricing_mode' => 'standard',
                'price' => 75000,
                'base_price_unit' => 'pcs',
                'min_qty' => 1,
                'is_active' => true,
            ]
        );

        $seedOptions($plastisol, [
            [
                'name' => 'Ukuran',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'S', 'price_delta' => 0, 'is_default' => true],
                    ['name' => 'M', 'price_delta' => 0],
                    ['name' => 'L', 'price_delta' => 0],
                    ['name' => 'XL', 'price_delta' => 0],
                    ['name' => 'XXL', 'price_delta' => 5000],
                    ['name' => '3XL', 'price_delta' => 10000],
                    ['name' => '4XL', 'price_delta' => 15000],
                ],
            ],
            [
                'name' => 'Model',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'Pendek', 'price_delta' => 0, 'is_default' => true],
                    ['name' => 'Panjang', 'price_delta' => 10000],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. Cetak A3+: Cetak Dokumen & Stiker A3+
        |--------------------------------------------------------------------------
        */
        $a3 = Product::updateOrCreate(
            ['slug' => 'cetak-dokumen-stiker-a3-plus'],
            [
                'product_category_id' => $printingCategory->id,
                'name' => 'Cetak Dokumen & Stiker A3+',
                'description' => 'Cetak dokumen, brosur, sertifikat, dan stiker ukuran A3+ dengan beragam pilihan bahan berkualitas.',
                'pricing_mode' => 'qty_tiered',
                'price' => null,
                'base_price_unit' => 'lembar',
                'supports_2_sisi' => true,
                'min_qty' => 1,
                'is_active' => true,
            ]
        );

        $bahanGroup = ProductOptionGroup::updateOrCreate(
            [
                'product_id' => $a3->id,
                'name' => 'Pilih Bahan',
            ],
            [
                'type' => 'radio',
                'is_required' => true,
                'sort_order' => 0,
            ]
        );

        $a3BahanTiers = [
            'HVS 70gr BW' => [
                'tiers' => [[1, 5000, 6500], [10, 3500, 5000]],
            ],
            'Art Paper 120gr' => [
                'tiers' => [[1, 5000, 6500], [10, 4500, 6000]],
            ],
            'Art Paper 150gr' => [
                'tiers' => [[1, 6000, 7500], [10, 5000, 6500]],
            ],
            'Art Carton 230gr' => [
                'tiers' => [[1, 8000, 9500], [10, 7000, 8500]],
            ],
            'Art Carton 260gr' => [
                'tiers' => [[1, 8000, 9500], [10, 7000, 8500]],
            ],
            'Linen' => [
                'tiers' => [[1, 9500, 11000], [10, 9000, 10500]],
            ],
            'BC' => [
                'tiers' => [[1, 9000, 10500], [10, 8000, 9500]],
            ],
            'Sticker Kromo' => [
                'tiers' => [[1, 10000], [10, 9000]],
            ],
            'Sticker Vinyl D/G' => [
                'tiers' => [[1, 12000], [10, 11000]],
            ],
            'Sticker Vinyl Transparant' => [
                'tiers' => [[1, 12000], [10, 11000]],
            ],
            'Decal' => [
                'tiers' => [[1, 20000], [10, 19000]],
            ],
            'Hologram' => [
                'tiers' => [[1, 21000], [10, 20000]],
            ],
        ];

        $bIdx = 0;
        foreach ($a3BahanTiers as $bahanName => $bahanData) {
            $opt = ProductOption::updateOrCreate(
                [
                    'product_option_group_id' => $bahanGroup->id,
                    'name' => $bahanName,
                ],
                [
                    'price_mode' => 'delta',
                    'price_unit' => 'flat',
                    'price_delta' => 0,
                    'requires_manual_quote' => false,
                    'is_default' => $bIdx === 0,
                    'sort_order' => $bIdx,
                ]
            );

            foreach ($bahanData['tiers'] as $tierConfig) {
                $minQty = $tierConfig[0];
                $price1Muka = $tierConfig[1];
                $price2Muka = $tierConfig[2] ?? null;

                ProductQtyPriceTier::updateOrCreate(
                    [
                        'product_id' => $a3->id,
                        'option_id' => $opt->id,
                        'side_mode' => '1_muka',
                        'min_qty' => $minQty,
                    ],
                    [
                        'price_per_unit' => $price1Muka,
                        'is_active' => true,
                    ]
                );

                if ($price2Muka !== null) {
                    ProductQtyPriceTier::updateOrCreate(
                        [
                            'product_id' => $a3->id,
                            'option_id' => $opt->id,
                            'side_mode' => '2_muka',
                            'min_qty' => $minQty,
                        ],
                        [
                            'price_per_unit' => $price2Muka,
                            'is_active' => true,
                        ]
                    );
                }
            }

            $bIdx++;
        }

        // Finishing Cetak A3+
        $finishingA3 = ProductOptionGroup::updateOrCreate(
            [
                'product_id' => $a3->id,
                'name' => 'Finishing',
            ],
            [
                'type' => 'checkbox',
                'is_required' => false,
                'sort_order' => 1,
            ]
        );

        $finishingOptions = [
            ['name' => 'Cutting Half', 'price_delta' => 2000],
            ['name' => 'Cutting Putus', 'price_delta' => 3500],
            ['name' => 'Laminasi Glossy', 'price_delta' => 2000],
            ['name' => 'Laminasi Doff', 'price_delta' => 3000],
        ];

        foreach ($finishingOptions as $fIdx => $fOpt) {
            ProductOption::updateOrCreate(
                [
                    'product_option_group_id' => $finishingA3->id,
                    'name' => $fOpt['name'],
                ],
                [
                    'price_mode' => 'delta',
                    'price_unit' => 'flat',
                    'price_delta' => $fOpt['price_delta'],
                    'requires_manual_quote' => false,
                    'is_default' => false,
                    'sort_order' => $fIdx,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Eco Solvent: Stiker Indoor Eco Solvent
        |--------------------------------------------------------------------------
        */
        $eco1 = Product::updateOrCreate(
            ['slug' => 'stiker-indoor-eco-solvent'],
            [
                'product_category_id' => $signageCategory->id,
                'name' => 'Stiker Indoor Eco Solvent',
                'description' => 'Stiker indoor cetak resolusi tinggi menggunakan tinta eco solvent.',
                'pricing_mode' => 'standard',
                'price' => 0,
                'requires_area_calculation' => true,
                'base_price_unit' => 'm2',
                'min_qty' => 1,
                'is_active' => true,
            ]
        );

        $seedOptions($eco1, [
            [
                'name' => 'Pilih Bahan',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'Graftac', 'price_mode' => 'absolute', 'price_delta' => 135000, 'is_default' => true],
                    ['name' => 'Maxdecal Glossy', 'price_mode' => 'absolute', 'price_delta' => 150000],
                    ['name' => 'Maxdecal Transparant', 'price_mode' => 'absolute', 'price_delta' => 150000],
                    ['name' => 'Maxdecal Transparant+Tinta Putih', 'price_mode' => 'absolute', 'price_delta' => 200000],
                    ['name' => 'Orajet Transparant', 'price_mode' => 'absolute', 'price_delta' => 135000],
                    ['name' => 'Orajet Transparant+Tinta Putih', 'price_mode' => 'absolute', 'price_delta' => 185000],
                    ['name' => 'Orajet Glossy', 'price_mode' => 'absolute', 'price_delta' => 135000],
                    ['name' => 'One Way', 'price_mode' => 'absolute', 'price_delta' => 115000],
                    ['name' => 'Chrome', 'price_mode' => 'absolute', 'price_delta' => 155000],
                    ['name' => 'Hologram', 'price_mode' => 'absolute', 'price_delta' => 190000],
                ],
            ],
            [
                'name' => 'Cutting Meteran',
                'type' => 'checkbox',
                'is_required' => false,
                'options' => [
                    ['name' => 'Half', 'price_mode' => 'delta', 'price_unit' => 'per_length_m', 'price_delta' => 25000],
                    ['name' => 'Putus', 'price_mode' => 'delta', 'price_unit' => 'per_length_m', 'price_delta' => 45000],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. Eco Solvent: Media Foto & Canvas (Indoor)
        |--------------------------------------------------------------------------
        */
        $eco2 = Product::updateOrCreate(
            ['slug' => 'media-foto-canvas-indoor'],
            [
                'product_category_id' => $signageCategory->id,
                'name' => 'Media Foto & Canvas (Indoor)',
                'description' => 'Cetak media foto seni & kanvas indoor kualitas tajam dan tahan lama.',
                'pricing_mode' => 'standard',
                'price' => 0,
                'requires_area_calculation' => true,
                'base_price_unit' => 'm2',
                'min_qty' => 1,
                'is_active' => true,
            ]
        );

        $seedOptions($eco2, [
            [
                'name' => 'Pilih Bahan',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'Canvas', 'price_mode' => 'absolute', 'price_delta' => 175000, 'is_default' => true],
                    ['name' => 'Photo Paper Silky', 'price_mode' => 'absolute', 'price_delta' => 140000],
                    ['name' => 'Luster', 'price_mode' => 'absolute', 'price_delta' => 125000],
                    ['name' => 'Art Carton 260gr Meteran', 'price_mode' => 'absolute', 'price_delta' => 100000],
                    ['name' => 'Art Paper 150gr Meteran', 'price_mode' => 'absolute', 'price_delta' => 95000],
                    ['name' => 'HVS Meteran', 'price_mode' => 'absolute', 'price_delta' => 95000],
                ],
            ],
            [
                'name' => 'Cutting Meteran',
                'type' => 'checkbox',
                'is_required' => false,
                'options' => [
                    ['name' => 'Half', 'price_mode' => 'delta', 'price_unit' => 'per_length_m', 'price_delta' => 25000],
                    ['name' => 'Putus', 'price_mode' => 'delta', 'price_unit' => 'per_length_m', 'price_delta' => 45000],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 6. Eco Solvent: Banner & Backlite UV
        |--------------------------------------------------------------------------
        */
        $eco3 = Product::updateOrCreate(
            ['slug' => 'banner-backlite-uv'],
            [
                'product_category_id' => $signageCategory->id,
                'name' => 'Banner & Backlite UV',
                'description' => 'Cetak banner & backlite UV tahan cuaca outdoor dan indoor.',
                'pricing_mode' => 'standard',
                'price' => 0,
                'requires_area_calculation' => true,
                'base_price_unit' => 'm2',
                'min_qty' => 1,
                'is_active' => true,
            ]
        );

        $seedOptions($eco3, [
            [
                'name' => 'Pilih Bahan',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'Backlite Jerman 510gsm UV', 'price_mode' => 'absolute', 'price_delta' => 145000, 'is_default' => true],
                    ['name' => 'Banner Jerman 440gsm UV', 'price_mode' => 'absolute', 'price_delta' => 85000],
                ],
            ],
            [
                'name' => 'Cutting Meteran',
                'type' => 'checkbox',
                'is_required' => false,
                'options' => [
                    ['name' => 'Half', 'price_mode' => 'delta', 'price_unit' => 'per_length_m', 'price_delta' => 25000],
                    ['name' => 'Putus', 'price_mode' => 'delta', 'price_unit' => 'per_length_m', 'price_delta' => 45000],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 7. Cetak Foto
        |--------------------------------------------------------------------------
        */
        $foto = Product::updateOrCreate(
            ['slug' => 'cetak-foto'],
            [
                'product_category_id' => $printingCategory->id,
                'name' => 'Cetak Foto',
                'description' => 'Cetak foto premium berbagai ukuran dari pas photo hingga 24R.',
                'pricing_mode' => 'standard',
                'price' => 0,
                'base_price_unit' => 'pcs',
                'min_qty' => 1,
                'is_active' => true,
            ]
        );

        $seedOptions($foto, [
            [
                'name' => 'Ukuran',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'Pas Photo', 'price_mode' => 'absolute', 'price_delta' => 2000, 'is_default' => true],
                    ['name' => '4R', 'price_mode' => 'absolute', 'price_delta' => 4000],
                    ['name' => '5R', 'price_mode' => 'absolute', 'price_delta' => 6000],
                    ['name' => '6R', 'price_mode' => 'absolute', 'price_delta' => 7000],
                    ['name' => '8R', 'price_mode' => 'absolute', 'price_delta' => 9000],
                    ['name' => 'A4', 'price_mode' => 'absolute', 'price_delta' => 10000],
                    ['name' => '12R', 'price_mode' => 'absolute', 'price_delta' => 40000],
                    ['name' => '12R Jumbo', 'price_mode' => 'absolute', 'price_delta' => 45000],
                    ['name' => '16R', 'price_mode' => 'absolute', 'price_delta' => 60000],
                    ['name' => '18R', 'price_mode' => 'absolute', 'price_delta' => 65000],
                    ['name' => '20R', 'price_mode' => 'absolute', 'price_delta' => 75000],
                    ['name' => '22R', 'price_mode' => 'absolute', 'price_delta' => 100000],
                    ['name' => '24R', 'price_mode' => 'absolute', 'price_delta' => 115000],
                ],
            ],
            [
                'name' => 'Add-on',
                'type' => 'checkbox',
                'is_required' => false,
                'options' => [
                    ['name' => 'Edit Background', 'price_mode' => 'delta', 'price_unit' => 'flat', 'price_delta' => 3000],
                    ['name' => 'Laminasi', 'price_mode' => 'delta', 'price_unit' => 'flat', 'price_delta' => 0, 'requires_manual_quote' => true],
                    ['name' => 'Tambah Figura', 'price_mode' => 'delta', 'price_unit' => 'flat', 'price_delta' => 0, 'requires_manual_quote' => true],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 8. Undangan
        |--------------------------------------------------------------------------
        */
        $undangan = Product::updateOrCreate(
            ['slug' => 'undangan'],
            [
                'product_category_id' => $invitationCategory->id,
                'name' => 'Undangan',
                'description' => 'Bahan: Art Carton Glossy 230gsm',
                'pricing_mode' => 'standard',
                'price' => 0,
                'base_price_unit' => 'pcs',
                'min_qty' => 100,
                'is_active' => true,
            ]
        );

        $seedOptions($undangan, [
            [
                'name' => 'Model',
                'type' => 'radio',
                'is_required' => true,
                'options' => [
                    ['name' => 'OV.UND001(16x11cm)', 'price_mode' => 'absolute', 'price_delta' => 1000, 'is_default' => true],
                    ['name' => 'OV.UND002(22x15cm)', 'price_mode' => 'absolute', 'price_delta' => 1500],
                    ['name' => 'OV.UND003(15.5x23.5cm)', 'price_mode' => 'absolute', 'price_delta' => 2000],
                    ['name' => 'OV.UND004(16x15.5cm)', 'price_mode' => 'absolute', 'price_delta' => 2000],
                    ['name' => 'OV.UND005(32x11.75cm,lipat)', 'price_mode' => 'absolute', 'price_delta' => 1500],
                    ['name' => 'OV.UND006(32x18cm,lipat)', 'price_mode' => 'absolute', 'price_delta' => 1500],
                    ['name' => 'OV.UND007(31x23.5cm)', 'price_mode' => 'absolute', 'price_delta' => 3000],
                ],
            ],
        ]);
    }
}
