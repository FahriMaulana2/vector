<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int|null $option_id
 * @property string $side_mode
 * @property int $min_qty
 * @property float $price_per_unit
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @property-read ProductOption|null $option
 */
class ProductQtyPriceTier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'option_id',
        'side_mode',
        'min_qty',
        'price_per_unit',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'product_id' => 'integer',
        'option_id' => 'integer',
        'side_mode' => 'string',
        'min_qty' => 'integer',
        'price_per_unit' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the product that owns this tier.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product option associated with this tier.
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'option_id');
    }

    /**
     * Find price for product, side_mode, quantity, and optional option_id based on highest matching min_qty.
     */
    public static function findPriceFor(int $productId, string $sideMode, int $qty, ?int $optionId = null): ?float
    {
        $baseQuery = static::query()
            ->where('product_id', $productId)
            ->where('is_active', true)
            ->where('side_mode', $sideMode)
            ->where('min_qty', '<=', $qty);

        if ($optionId !== null) {
            $tier = (clone $baseQuery)
                ->where('option_id', $optionId)
                ->orderByDesc('min_qty')
                ->first();

            if ($tier) {
                return (float) $tier->price_per_unit;
            }
        }

        $tier = (clone $baseQuery)
            ->whereNull('option_id')
            ->orderByDesc('min_qty')
            ->first();

        return $tier ? (float) $tier->price_per_unit : null;
    }
}
