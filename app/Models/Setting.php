<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property string $group
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * The cache key for settings.
     */
    private const CACHE_KEY = 'omh_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::saved(function (): void {
            static::forgetCache();
        });

        static::deleted(function (): void {
            static::forgetCache();
        });
    }

    /**
     * Clear the settings cache.
     */
    public static function forgetCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Get a setting value by key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::rememberForever(self::CACHE_KEY, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, ?string $value = null, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
            ]
        );
    }

    /**
     * Get all settings for a group.
     */
    public static function getGroup(string $group): array
    {
        return static::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Get company name from settings.
     */
    public static function getCompanyName(): string
    {
        return static::get('company_name', 'OMH Vector');
    }

    /**
     * Get logo URL from settings.
     */
    public static function getLogoUrl(): ?string
    {
        $logo = static::get('logo');
        return $logo ? asset('storage/' . $logo) : null;
    }

    /**
     * Get WhatsApp number from settings.
     */
    public static function getWhatsAppNumber(): ?string
    {
        return static::get('whatsapp_number');
    }

    /**
     * Get formatted WhatsApp link.
     */
    public static function getWhatsAppLink(): string
    {
        $number = static::getWhatsAppNumber();
        return $number ? "https://wa.me/{$number}" : '#';
    }

    /**
     * Get email from settings.
     */
    public static function getEmail(): ?string
    {
        return static::get('email');
    }

    /**
     * Get phone from settings.
     */
    public static function getPhone(): ?string
    {
        return static::get('phone');
    }

    /**
     * Get address from settings.
     */
    public static function getAddress(): ?string
    {
        return static::get('address');
    }

    /**
     * Get Google Maps embed URL from settings.
     */
    public static function getGoogleMaps(): ?string
    {
        return static::get('google_maps');
    }

    /**
     * Get social media links from settings.
     */
    public static function getSocialMedia(): array
    {
        return [
            'facebook' => static::get('facebook'),
            'instagram' => static::get('instagram'),
            'twitter' => static::get('twitter'),
            'linkedin' => static::get('linkedin'),
            'tiktok' => static::get('tiktok'),
        ];
    }

    /**
     * Get SEO meta tags from settings.
     */
    public static function getSEO(): array
    {
        return [
            'meta_title' => static::get('meta_title'),
            'meta_description' => static::get('meta_description'),
            'meta_keywords' => static::get('meta_keywords'),
            'og_image' => static::get('og_image'),
        ];
    }
}