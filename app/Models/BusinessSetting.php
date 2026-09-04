<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BusinessSetting extends Model
{
    protected $fillable = [
        'primary_whatsapp',
        'secondary_phone',
        'fallback_email',
    ];

    public static function getCached(): self
    {
        return Cache::remember('business_settings.cached', 3600, function (): self {
            return static::first() ?? new static;
        });
    }

    /**
     * @return array{type: string|null, value: string|null}
     */
    public function getFallbackContact(): array
    {
        if (! empty($this->primary_whatsapp)) {
            return ['type' => 'whatsapp', 'value' => $this->primary_whatsapp];
        }

        if (! empty($this->secondary_phone)) {
            return ['type' => 'phone', 'value' => $this->secondary_phone];
        }

        if (! empty($this->fallback_email)) {
            return ['type' => 'email', 'value' => $this->fallback_email];
        }

        return ['type' => null, 'value' => null];
    }

    public function hasFallbackContact(): bool
    {
        return $this->getFallbackContact()['type'] !== null;
    }

    /**
     * Bangun URL WhatsApp dari primary_whatsapp, pakai normalisasi
     * nomor yang SAMA dengan Setting::normalizePhoneNumber() (format 62xxx).
     */
    public function getWhatsAppUrl(?string $customMessage = null): ?string
    {
        if (empty($this->primary_whatsapp)) {
            return null;
        }

        $normalized = Setting::normalizePhoneNumber($this->primary_whatsapp);
        if (! $normalized) {
            return null;
        }

        $url = "https://wa.me/{$normalized}";
        if ($customMessage) {
            $url .= '?text='.rawurlencode($customMessage);
        }

        return $url;
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('business_settings.cached'));
        static::deleted(fn () => Cache::forget('business_settings.cached'));
    }
}
