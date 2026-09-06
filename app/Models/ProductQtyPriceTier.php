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
 * @property string $side_mode
 * @property int $min_qty
 * @property float $price_per_unit
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
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
     * Find price for product, side_mode, and quantity based on highest matching min_qty.
     */
    public static function findPriceFor(int $productId, string $sideMode, int $qty): ?float
    {
        $tier = static::query()
            ->where('product_id', $productId)
            ->where('is_active', true)
            ->where('side_mode', $sideMode)
            ->where('min_qty', '<=', $qty)
            ->orderByDesc('min_qty')
            ->first();

        return $tier ? (float) $tier->price_per_unit : null;
    }
}
