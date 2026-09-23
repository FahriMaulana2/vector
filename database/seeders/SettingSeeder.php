<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Company Info
            ['key' => 'company_name', 'value' => 'OMAH Vector', 'group' => 'company'],
            ['key' => 'company_email', 'value' => 'info@OMAHvector.com', 'group' => 'company'],
            ['key' => 'company_phone', 'value' => '+62 21 1234 5678', 'group' => 'company'],
            ['key' => 'company_whatsapp', 'value' => '6281234567890', 'group' => 'company'],
            ['key' => 'company_address', 'value' => 'Jl. Percetakan Negara No. 123, Jakarta Pusat, 10510', 'group' => 'company'],
            ['key' => 'company_description', 'value' => 'Solusi Cetak & Branding Terpercaya untuk Bisnis Anda.', 'group' => 'company'],
            ['key' => 'office_hours', 'value' => 'Senin - Sabtu: 08.00 - 17.00 WIB', 'group' => 'company'],
            ['key' => 'google_maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28337775945!2d106.75963558832717!3d-6.229569452097722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e49fe3abc5%3A0x2877a56012351d54!2sJakarta%20Pusat%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid', 'group' => 'company'],

            // Branding
            ['key' => 'logo', 'value' => 'images/logo.png', 'group' => 'branding'],
            ['key' => 'favicon', 'value' => 'images/favicon.ico', 'group' => 'branding'],

            // Social Media
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/OMAHvector', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/OMAHvector', 'group' => 'social'],
            ['key' => 'tiktok_url', 'value' => 'https://tiktok.com/@OMAHvector', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@OMAHvector', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/OMAHvector', 'group' => 'social'],

            // SEO
            ['key' => 'seo_title', 'value' => 'OMAH Vector - Digital Printing & Branding Agency', 'group' => 'seo'],
            ['key' => 'seo_description', 'value' => 'Jasa digital printing, packaging, merchandise, dan corporate branding terbaik di Jakarta.', 'group' => 'seo'],
            ['key' => 'seo_keywords', 'value' => 'digital printing, packaging, branding, merchandise, cetak jakarta', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
