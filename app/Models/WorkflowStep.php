<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property int $step_number
 * @property string|null $icon
 * @property string $title
 * @property string|null $description
 * @property int $sort_order
 * @property bool $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class WorkflowStep extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'step_number',
        'icon',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'step_number' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (WorkflowStep $step): void {
            if (empty($step->sort_order)) {
                $step->sort_order = static::max('sort_order') + 1;
            }
        });
    }

    /**
     * Scope a query to only include active steps.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order steps by step number.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('step_number');
    }

    /**
     * Get all active workflow steps ordered.
     */
    public static function getActiveOrdered(): \Illuminate\Database\Eloquent\Collection
    {
        return static::active()->ordered()->get();
    }
}