<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

/**
 * @property int $id
 * @property int $order_id
 * @property string|null $previous_status
 * @property string $new_status
 * @property int|null $changed_by
 * @property string|null $notes
 * @property \Carbon\Carbon $created_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User|null $changedByUser
 */
class OrderStatusHistory extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'previous_status',
        'new_status',
        'changed_by',
        'notes',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_id' => 'integer',
        'changed_by' => 'integer',
        'created_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (OrderStatusHistory $history): void {
            if (empty($history->created_at)) {
                $history->created_at = now();
            }
        });
    }

    /**
     * Get the order for this history record.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user who changed the status.
     */
    public function changedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    /**
     * Scope a query to filter by order.
     */
    public function scopeForOrder(\Illuminate\Database\Eloquent\Builder $query, int $orderId): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('order_id', $orderId);
    }

    /**
     * Scope a query to order by latest.
     */
    public function scopeLatest(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get formatted timestamp.
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i');
    }
}