<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $customer_name
 * @property string|null $customer_photo
 * @property string|null $company
 * @property string|null $position
 * @property int $rating
 * @property string $testimonial
 * @property string|null $project_name
 * @property bool $is_featured
 * @property int $sort_order
 * @property bool $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Testimonial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_name',
        'customer_photo',
        'company',
        'position',
        'rating',
        'testimonial',
        'project_name',
        'is_featured',
        'sort_order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Testimonial $testimonial): void {
            if (empty($testimonial->sort_order)) {
                $testimonial->sort_order = static::max('sort_order') + 1;
            }
        });

        static::deleting(function (Testimonial $testimonial): void {
            if ($testimonial->customer_photo && Storage::disk('public')->exists($testimonial->customer_photo)) {
                Storage::disk('public')->delete($testimonial->customer_photo);
            }
        });
    }

    /**
     * Scope a query to only include active testimonials.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured testimonials.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order testimonials by sort order.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the photo URL.
     */
    public function getCustomerPhotoUrlAttribute(): ?string
    {
        return $this->customer_photo ? Storage::disk('public')->url($this->customer_photo) : null;
    }

    /**
     * Generate star rating HTML.
     */
    public function stars(): string
    {
        $fullStars = str_repeat('★', $this->rating);
        $emptyStars = str_repeat('☆', 5 - $this->rating);
        return $fullStars . $emptyStars;
    }

    /**
     * Get rating as array of booleans.
     */
    public function getRatingArrayAttribute(): array
    {
        return array_map(fn($i) => $i <= $this->rating, range(1, 5));
    }

    /**
     * Get featured testimonials.
     */
    public static function getFeatured(int $limit = 3): \Illuminate\Database\Eloquent\Collection
    {
        return static::active()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();
    }
}