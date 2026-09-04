<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PopupCampaign extends Model
{
    protected $fillable = [
        'template_type',
        'image_path',
        'title',
        'description',
        'cta_type',
        'marketplace_id',
        'cta_url',
        'cta_text',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected $appends = [
        'cta_final_url',
        'is_cta_fallback_active',
    ];

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }

    public static function getActiveCampaign(): ?self
    {
        return Cache::remember('active_popup', 300, function () {
            $now = Carbon::now();

            return static::where('is_active', true)
                ->where(function ($q) use ($now) {
                    $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
                })
                ->where(function ($q) use ($now) {
                    $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
                })
                ->latest('updated_at')
                ->first();
        });
    }

    public function activate(): void
    {
        DB::transaction(function () {
            static::where('id', '!=', $this->id)->update(['is_active' => false]);
            $this->update(['is_active' => true]);
        });
    }

    public function incrementView(): void
    {
        $this->increment('view_count');
    }

    public function incrementClick(): void
    {
        $this->increment('click_count');
    }

    public function getConversionRateAttribute(): float
    {
        if ($this->view_count === 0) {
            return 0;
        }

        return round(($this->click_count / $this->view_count) * 100, 2);
    }

    /**
     * Truth table CTA:
     * - marketplace → ambil store_url dari relasi marketplace,
     *   TAPI fallback ke WhatsApp jika marketplace tidak aktif (Smart Sync)
     * - whatsapp → ambil dari BusinessSetting (fallback chain)
     * - custom_url → pakai cta_url langsung
     */
    public function getCtaFinalUrlAttribute(): ?string
    {
        return match ($this->cta_type) {
            'marketplace' => $this->resolveMarketplaceCtaUrl(),
            'whatsapp' => BusinessSetting::getCached()->getWhatsAppUrl(),
            'custom_url' => $this->cta_url,
            default => null,
        };
    }

    /**
     * Resolve URL untuk CTA tipe marketplace.
     * Jika marketplace tidak ditemukan atau sedang maintenance,
     * otomatis fallback ke WhatsApp (Smart Sync).
     */
    private function resolveMarketplaceCtaUrl(): ?string
    {
        if (! $this->marketplace || ! $this->marketplace->is_active) {
            return BusinessSetting::getCached()->getWhatsAppUrl();
        }

        return $this->marketplace->store_url;
    }

    /**
     * Cek apakah CTA marketplace sedang di-fallback ke WhatsApp
     * karena toko tujuan tidak aktif/maintenance.
     * Dipakai frontend untuk menampilkan notifikasi toast
     * ("Toko sedang maintenance, diarahkan ke WhatsApp").
     */
    public function getIsCtaFallbackActiveAttribute(): bool
    {
        return $this->cta_type === 'marketplace'
            && (! $this->marketplace || ! $this->marketplace->is_active);
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('active_popup'));
        static::deleted(fn () => Cache::forget('active_popup'));
    }
}
