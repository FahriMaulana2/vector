<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $order_number
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $customer_email
 * @property int|null $product_id
 * @property int $quantity
 * @property string|null $notes
 * @property string|null $attachment_path
 * @property Carbon|null $estimated_completion_date
 * @property Carbon|null $completed_at
 * @property string|null $admin_notes
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product|null $product
 * @property-read Collection<int, OrderStatusHistory> $statusHistories
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'shipping_address',
        'design_file_status',
        'subtotal',
        'has_manual_quote_item',
        'product_id',
        'quantity',
        'notes',
        'attachment_path',
        'estimated_completion_date',
        'completed_at',
        'admin_notes',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'product_id' => 'integer',
        'quantity' => 'integer',
        'subtotal' => 'decimal:2',
        'has_manual_quote_item' => 'boolean',
        'estimated_completion_date' => 'date',
        'completed_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Order $order): void {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    /**
     * Get the product for this order.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the order items for this order.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the status history for this order.
     */
    public function statusHistories(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class)->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include pending orders.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include completed orders.
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to order by latest.
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Generate unique order number.
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD';

        do {
            $random = strtoupper(Str::random(5));
            $orderNumber = "{$prefix}-{$random}";
        } while (static::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Change the order status and record history.
     */
    public function changeStatus(string $newStatus, ?string $notes = null, ?int $userId = null): void
    {
        $oldStatus = $this->status;

        $this->update([
            'status' => $newStatus,
            'completed_at' => $newStatus === 'completed' ? now() : $this->completed_at,
        ]);

        OrderStatusHistory::create([
            'order_id' => $this->id,
            'previous_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $userId,
            'notes' => $notes,
        ]);
    }

    /**
     * Mark order as completed.
     */
    public function markCompleted(?int $userId = null): void
    {
        $this->changeStatus('completed', 'Order completed', $userId);
    }

    /**
     * Check if order is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if order is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if order is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Get status badge color.
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'menunggu_konfirmasi' => 'warning',
            'confirmed' => 'info',
            'terkonfirmasi' => 'success',
            'design_process' => 'primary',
            'printing' => 'secondary',
            'ready_for_pickup' => 'success',
            'completed' => 'success',
            'cancelled' => 'danger',
            'kedaluwarsa' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get human-friendly status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'terkonfirmasi' => 'Pesanan Dikonfirmasi',
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Pesanan Dikonfirmasi',
            'diproses' => 'Sedang Diproses',
            'design_process' => 'Proses Desain',
            'printing', 'produksi' => 'Dalam Produksi',
            'ready_for_pickup' => 'Siap Diambil / Dikirim',
            'dikirim' => 'Sedang Dikirim',
            'completed', 'selesai' => 'Selesai',
            'cancelled', 'dibatalkan' => 'Dibatalkan',
            'kedaluwarsa' => 'Kedaluwarsa',
            default => ucwords(str_replace('_', ' ', (string) $this->status)),
        };
    }
}
