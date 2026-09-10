<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $year
 * @property string $title
 * @property string|null $description
 * @property int $sort_order
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class AboutMilestone extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'year',
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
        'year' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to only include active milestones.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order chronologically by year then sort_order.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('year')->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get all active milestones ordered chronologically.
     *
     * @return Collection<int, self>
     */
    public static function getActive(): Collection
    {
        return static::active()->ordered()->get();
    }
}
