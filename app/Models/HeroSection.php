<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $description
 * @property string|null $button_text
 * @property string|null $button_link
 * @property string|null $image
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, HeroStatistic> $statistics
 */
class HeroSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_link',
        'image',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::updating(function (HeroSection $hero): void {
            if ($hero->is_active) {
                static::where('id', '!=', $hero->id)->update(['is_active' => false]);
            }
        });

        static::deleting(function (HeroSection $hero): void {
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
        });
    }

    /**
     * Get the statistics for the hero section.
     */
    public function statistics(): HasMany
    {
        return $this->hasMany(HeroStatistic::class)->orderBy('sort_order');
    }

    /**
     * Scope a query to only include active hero.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the active hero section.
     */
    public static function getActive(): ?self
    {
        return static::where('is_active', true)->with('statistics')->first();
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    /**
     * Check if hero has statistics.
     */
    public function hasStatistics(): bool
    {
        return $this->statistics()->count() > 0;
    }
}
