<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property string $group
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * The cache key for settings.
     */
    private const CACHE_KEY = 'OMAH_settings';

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
        return static::get('company_name', 'OMAH Vector');
    }

    /**
     * Get logo URL from settings.
     */
    public static function getLogoUrl(): ?string
    {
        $logo = static::get('logo');

        return $logo ? asset('storage/'.$logo) : null;
    }

    /**
     * Get company description from settings.
     */
    public static function getDescription(): ?string
    {
        return static::get('company_description');
    }

    /**
     * Get office hours from settings.
     */
    public static function getOfficeHours(): ?string
    {
        return static::get('office_hours');
    }

    /**
     * Get WhatsApp number from settings.
     */
    public static function getWhatsAppNumber(): ?string
    {
        return static::get('company_whatsapp');
    }

    /**
     * Normalize a phone number to standard international format (without +).
     */
    public static function normalizePhoneNumber(?string $number): ?string
    {
        if (! $number) {
            return null;
        }

        // Strip all non-digit characters
        $digits = preg_replace('/\D/', '', $number);
        if (! $digits) {
            return null;
        }

        // Convert leading 0 to 62 for Indonesian numbers
        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        }

        return $digits;
    }

    /**
     * Get formatted WhatsApp link.
     */
    public static function getWhatsAppLink(?string $customMessage = null): string
    {
        $number = static::getWhatsAppNumber();
        $normalized = static::normalizePhoneNumber($number);
        if (! $normalized) {
            return '#';
        }

        $url = "https://wa.me/{$normalized}";
        if ($customMessage !== null && $customMessage !== '') {
            $url .= '?text='.rawurlencode($customMessage);
        }

        return $url;
    }

    /**
     * Get email from settings.
     */
    public static function getEmail(): ?string
    {
        return static::get('company_email');
    }

    /**
     * Get phone from settings.
     */
    public static function getPhone(): ?string
    {
        return static::get('company_phone');
    }

    /**
     * Get address from settings.
     */
    public static function getAddress(): ?string
    {
        return static::get('company_address');
    }

    /**
     * Get Google Maps embed code from settings.
     */
    public static function getGoogleMaps(): ?string
    {
        return static::get('google_maps_embed');
    }

    /**
     * Get a single social media URL by platform.
     */
    public static function getSocial(string $platform): ?string
    {
        return static::get($platform.'_url');
    }

    /**
     * Get Facebook URL.
     */
    public static function getFacebook(): ?string
    {
        return static::getSocial('facebook');
    }

    /**
     * Get Instagram URL.
     */
    public static function getInstagram(): ?string
    {
        return static::getSocial('instagram');
    }

    /**
     * Get TikTok URL.
     */
    public static function getTikTok(): ?string
    {
        return static::getSocial('tiktok');
    }

    /**
     * Get YouTube URL.
     */
    public static function getYoutube(): ?string
    {
        return static::getSocial('youtube');
    }

    /**
     * Get LinkedIn URL.
     */
    public static function getLinkedin(): ?string
    {
        return static::getSocial('linkedin');
    }

    /**
     * Get social media links from settings.
     */
    public static function getSocialMedia(): array
    {
        return [
            'facebook' => static::getFacebook(),
            'instagram' => static::getInstagram(),
            'tiktok' => static::getTikTok(),
            'youtube' => static::getYoutube(),
            'linkedin' => static::getLinkedin(),
        ];
    }

    /**
     * Get SEO title from settings.
     */
    public static function getSeoTitle(): ?string
    {
        return static::get('seo_title');
    }

    /**
     * Get SEO description from settings.
     */
    public static function getSeoDescription(): ?string
    {
        return static::get('seo_description');
    }

    /**
     * Get SEO keywords from settings.
     */
    public static function getSeoKeywords(): ?string
    {
        return static::get('seo_keywords');
    }

    /**
     * Get SEO meta tags from settings.
     */
    public static function getSEO(): array
    {
        return [
            'meta_title' => static::getSeoTitle(),
            'meta_description' => static::getSeoDescription(),
            'meta_keywords' => static::getSeoKeywords(),
            'og_image' => static::get('og_image'),
        ];
    }

    /**
     * Get favicon URL from settings.
     */
    public static function getFaviconUrl(): ?string
    {
        $favicon = static::get('favicon');

        return $favicon ? asset('storage/'.$favicon) : null;
    }
}
