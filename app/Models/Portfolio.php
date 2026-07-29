<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $portfolio_category_id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $image
 * @property string|null $client
 * @property \Carbon\Carbon|null $project_date
 * @property bool $is_featured
 * @property int $sort_order
 * @property bool $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\PortfolioCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PortfolioImage> $images
 */
class Portfolio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'portfolio_category_id',
        'title',
        'slug',
        'description',
        'image',
        'client',
        'project_date',
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
        'portfolio_category_id' => 'integer',
        'project_date' => 'date',
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

        static::creating(function (Portfolio $portfolio): void {
            if (empty($portfolio->sort_order)) {
                $portfolio->sort_order = static::max('sort_order') + 1;
            }
        });

        static::deleting(function (Portfolio $portfolio): void {
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }
        });
    }

    /**
     * Get the category that owns the portfolio.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    /**
     * Get the images for the portfolio.
     */
    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('sort_order');
    }

    /**
     * Scope a query to only include active portfolios.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured portfolios.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order portfolios by sort order.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('portfolio_category_id', $categoryId);
    }

    /**
     * Get the primary image URL.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    /**
     * Get the formatted project date.
     */
    public function getFormattedProjectDateAttribute(): ?string
    {
        return $this->project_date?->format('F Y');
    }

    /**
     * Get the primary image or first gallery image.
     */
    public function coverImage(): ?PortfolioImage
    {
        return $this->images()->where('is_primary', true)->first() 
            ?? $this->images()->first();
    }

    /**
     * Get all gallery images excluding primary.
     */
    public function gallery(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->images()->where('is_primary', false)->get();
    }
}