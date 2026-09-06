<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int|null $product_id
 * @property string $product_name
 * @property float $base_price_snapshot
 * @property array<string, mixed>|null $selected_options
 * @property float $options_total
 * @property float $unit_price
 * @property int $qty
 * @property float $line_subtotal
 * @property string|null $side_mode
 * @property float|null $length_m
 * @property float|null $width_m
 * @property bool $manual_quote_flag
 * @property string|null $manual_quote_note
 * @property float|null $manual_quote_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @property-read Product|null $product
 */
class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'base_price_snapshot',
        'selected_options',
        'options_total',
        'unit_price',
        'qty',
        'line_subtotal',
        'side_mode',
        'length_m',
        'width_m',
        'manual_quote_flag',
        'manual_quote_note',
        'manual_quote_amount',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'base_price_snapshot' => 'decimal:2',
        'selected_options' => 'array',
        'options_total' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'qty' => 'integer',
        'line_subtotal' => 'decimal:2',
        'length_m' => 'decimal:2',
        'width_m' => 'decimal:2',
        'manual_quote_flag' => 'boolean',
        'manual_quote_amount' => 'decimal:2',
    ];

    /**
     * Get the order that owns this item.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the associated product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get formatted unit price.
     */
    public function getFormattedUnitPriceAttribute(): string
    {
        return 'Rp '.number_format((float) $this->unit_price, 0, ',', '.');
    }

    /**
     * Get formatted line subtotal.
     */
    public function getFormattedLineSubtotalAttribute(): string
    {
        return 'Rp '.number_format((float) $this->line_subtotal, 0, ',', '.');
    }
}
