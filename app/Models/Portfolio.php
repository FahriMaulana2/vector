<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
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

    protected $casts = [
        'project_date' => 'date',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Portfolio $portfolio): void {
            if (empty($portfolio->sort_order)) {
                $portfolio->sort_order = ((int) static::max('sort_order')) + 1;
            }
        });

        static::deleting(function (Portfolio $portfolio): void {
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }

            foreach ($portfolio->images as $image) {
                if (
                    $image->image &&
                    Storage::disk('public')->exists($image->image)
                ) {
                    Storage::disk('public')->delete($image->image);
                }
            }
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)
            ->orderBy('sort_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query
            ->orderBy('sort_order')
            ->orderBy('title');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : null;
    }

    public function getFormattedProjectDateAttribute(): ?string
    {
        return $this->project_date?->format('F Y');
    }

    public function coverImage(): ?PortfolioImage
    {
        return $this->images()
            ->where('is_primary', true)
            ->first()
            ?? $this->images()->first();
    }

    public function gallery(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->images()
            ->where('is_primary', false)
            ->get();
    }
}