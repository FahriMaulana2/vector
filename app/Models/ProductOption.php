<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_option_group_id
 * @property string $name
 * @property string $price_mode
 * @property string $price_unit
 * @property float $price_delta
 * @property bool $requires_manual_quote
 * @property bool $is_default
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ProductOptionGroup $group
 */
class ProductOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_option_group_id',
        'name',
        'price_mode',
        'price_unit',
        'price_delta',
        'requires_manual_quote',
        'is_default',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'product_option_group_id' => 'integer',
        'price_mode' => 'string',
        'price_unit' => 'string',
        'price_delta' => 'decimal:2',
        'requires_manual_quote' => 'boolean',
        'is_default' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the option group that owns this option.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ProductOptionGroup::class, 'product_option_group_id');
    }
}
