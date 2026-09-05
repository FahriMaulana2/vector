<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Marketplace extends Model
{
    protected $fillable = [
        'platform',
        'store_name',
        'store_url',
        'logo_url',
        'is_active',
        'maintenance_message',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Daftar platform yang tersedia untuk dropdown Admin Panel.
     * Tambah platform baru cukup tambah 1 baris di sini, TANPA migration.
     */
    public static function getAvailablePlatforms(): array
    {
        return [
            'shopee' => 'Shopee',
            'tokopedia' => 'Tokopedia',
            'tiktok' => 'TikTok Shop',
            'blibli' => 'Blibli',
            'lazada' => 'Lazada',
            'bukalapak' => 'Bukalapak',
        ];
    }

    public static function getActiveOrdered()
    {
        return Cache::remember('marketplaces.active_ordered', 3600, function () {
            return static::where('is_active', true)
                ->orderBy('display_order')
                ->get();
        });
    }

    public function popupCampaigns()
    {
        return $this->hasMany(PopupCampaign::class);
    }

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('marketplaces.active_ordered');
            Cache::forget('marketplaces.frontend_ordered');
        });
        static::deleted(function () {
            Cache::forget('marketplaces.active_ordered');
            Cache::forget('marketplaces.frontend_ordered');
        });
    }
}
