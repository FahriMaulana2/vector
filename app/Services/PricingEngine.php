<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductQtyPriceTier;
use InvalidArgumentException;

class PricingEngine
{
    /**
     * Calculate price and configuration details for a product.
     *
     * @param  array<string|int, int|string>  $selectedOptionIds
     * @return array<string, mixed>
     *
     * @throws InvalidArgumentException
     */
    public function calculate(
        Product $product,
        int $qty = 1,
        array $selectedOptionIds = [],
        string $sideMode = '1_muka',
        ?float $lengthM = null,
        ?float $widthM = null
    ): array {
        // 1. Strict Input Validations
        $minQty = (int) ($product->min_qty ?? 1);
        if ($qty < $minQty) {
            $unit = $product->base_price_unit ?: 'pcs';
            throw new InvalidArgumentException("Jumlah minimum pemesanan untuk {$product->name} adalah {$minQty} {$unit}.");
        }

        if (! empty($product->qty_increment) && $product->qty_increment > 1 && ($qty % $product->qty_increment !== 0)) {
            $unit = $product->base_price_unit ?: 'pcs';
            throw new InvalidArgumentException("Jumlah pemesanan untuk {$product->name} harus kelipatan {$product->qty_increment} {$unit}.");
        }

        if ($product->requires_area_calculation) {
            if ($lengthM === null || $lengthM <= 0 || $widthM === null || $widthM <= 0) {
                throw new InvalidArgumentException('Panjang dan lebar harus diisi lebih dari 0 untuk produk ini.');
            }
        }

        // Normalize selected option IDs
        $flatOptionIds = [];
        foreach ($selectedOptionIds as $key => $value) {
            if (is_numeric($value) && (int) $value > 0) {
                $flatOptionIds[] = (int) $value;
            }
        }

        // Check option group constraints
        $product->loadMissing('optionGroups.options');
        foreach ($product->optionGroups as $group) {
            $groupOptionIds = $group->options->pluck('id')->all();
            $selectedInGroup = array_intersect($groupOptionIds, $flatOptionIds);
            $selectedCount = count($selectedInGroup);

            // Enforce required groups
            if ($group->is_required && $selectedCount === 0) {
                throw new InvalidArgumentException("Silakan pilih opsi untuk '{$group->name}'.");
            }

            // Enforce single-select constraint for radio/select
            if (in_array($group->type, ['radio', 'select'], true) && $selectedCount > 1) {
                throw new InvalidArgumentException("Grup opsi '{$group->name}' hanya boleh memilih satu opsi.");
            }
        }

        // 2. Base Price Determination & Anti-Zero Protection
        if ($product->pricing_mode === 'qty_tiered') {
            $tierPrice = ProductQtyPriceTier::findPriceFor($product->id, $sideMode, $qty);
            if ($tierPrice === null) {
                throw new InvalidArgumentException("Kombinasi jumlah ({$qty}) dan sisi cetak ({$sideMode}) tidak tersedia untuk produk ini.");
            }
            $basePrice = (float) $tierPrice;
        } else {
            $basePrice = (float) ($product->price ?? 0);
        }

        // 3. Option Evaluation
        $optionsTotal = 0.0;
        $absolutePriceOverride = null;
        $manualQuoteFlag = false;
        $manualQuoteNotes = [];
        $selectedOptionsDetails = [];

        if (! empty($flatOptionIds)) {
            $options = ProductOption::with('group')
                ->whereIn('id', $flatOptionIds)
                ->get();

            foreach ($options as $option) {
                // Per-option manual quote check
                if ($option->requires_manual_quote) {
                    $manualQuoteFlag = true;
                    $manualQuoteNotes[] = $option->name.' (perlu konfirmasi admin)';
                }

                // Price mode & unit evaluation
                if ($option->price_mode === 'absolute') {
                    $absolutePriceOverride = (float) $option->price_delta;
                } else {
                    if ($option->price_unit === 'per_length_m' && $lengthM !== null && $lengthM > 0) {
                        $optionsTotal += ((float) $option->price_delta * (float) $lengthM);
                    } else {
                        $optionsTotal += (float) $option->price_delta;
                    }
                }

                $selectedOptionsDetails[] = [
                    'group_id' => $option->product_option_group_id,
                    'group_name' => $option->group?->name ?? '',
                    'option_id' => $option->id,
                    'option_name' => $option->name,
                    'price_mode' => $option->price_mode,
                    'price_unit' => $option->price_unit,
                    'price_delta' => (float) $option->price_delta,
                    'requires_manual_quote' => (bool) $option->requires_manual_quote,
                ];
            }
        }

        // 4. Area & Override Compilation
        if ($absolutePriceOverride !== null) {
            $basePrice = $absolutePriceOverride;
        }

        if ($product->requires_area_calculation && $lengthM !== null && $widthM !== null && $lengthM > 0 && $widthM > 0) {
            $area = $lengthM * $widthM;
            $basePrice = $basePrice * $area;
        }

        $unitPrice = $basePrice + $optionsTotal;
        $lineSubtotal = $unitPrice * $qty;

        $manualQuoteNote = ! empty($manualQuoteNotes)
            ? implode(', ', $manualQuoteNotes)
            : ($manualQuoteFlag ? 'Perlu konfirmasi harga admin' : null);

        return [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'base_price_snapshot' => round($basePrice, 2),
            'selected_options' => $selectedOptionsDetails,
            'options_total' => round($optionsTotal, 2),
            'unit_price' => round($unitPrice, 2),
            'qty' => $qty,
            'line_subtotal' => round($lineSubtotal, 2),
            'side_mode' => $sideMode,
            'length_m' => $lengthM,
            'width_m' => $widthM,
            'manual_quote_flag' => $manualQuoteFlag,
            'manual_quote_note' => $manualQuoteNote,
        ];
    }
}
