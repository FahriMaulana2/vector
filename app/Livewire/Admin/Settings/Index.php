<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Pengaturan Website - Admin OMAH Vector')]
class Index extends Component
{
    use WithFileUploads;

    public $settings = [];

    public $logo;

    public $favicon;

    public function mount()
    {
        // Muat semua pengaturan ke dalam array asosiatif
        $this->settings = Setting::all()->pluck('value', 'key')->toArray();

        // Pastikan key default ada untuk mencegah error undefined array key
        $defaults = [
            'company_name' => 'OMAH Vector',
            'company_email' => '',
            'company_phone' => '',
            'company_whatsapp' => '',
            'company_address' => '',
            'company_description' => '',
            'office_hours' => '',
            'google_maps_embed' => '',
            'facebook_url' => '',
            'instagram_url' => '',
            'tiktok_url' => '',
            'youtube_url' => '',
            'linkedin_url' => '',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            // Toggle CTA Produk (1 = ON, 0 = OFF). Default ON.
            'show_product_cta' => '1',
            // Toggle CTA Portfolio (1 = ON, 0 = OFF). Default ON.
            'show_portfolio_cta' => '1',
        ];

        foreach ($defaults as $key => $value) {
            if (! isset($this->settings[$key])) {
                $this->settings[$key] = $value;
            }
        }
    }

    public function save()
    {
        $this->validate([
            'settings.company_name' => 'required|string|max:255',
            'settings.company_email' => 'nullable|email|max:255',
            'settings.company_phone' => 'nullable|string|max:50',
            'settings.company_whatsapp' => 'nullable|string|max:50',
            'settings.company_address' => 'nullable|string',
            'settings.company_description' => 'nullable|string',
            'settings.office_hours' => 'nullable|string|max:255',
            'settings.google_maps_embed' => 'nullable|string',
            'settings.facebook_url' => 'nullable|url|max:255',
            'settings.instagram_url' => 'nullable|url|max:255',
            'settings.tiktok_url' => 'nullable|url|max:255',
            'settings.youtube_url' => 'nullable|url|max:255',
            'settings.linkedin_url' => 'nullable|url|max:255',
            'settings.seo_title' => 'nullable|string|max:255',
            'settings.seo_description' => 'nullable|string|max:500',
            'settings.seo_keywords' => 'nullable|string|max:500',
            // Toggle CTA Produk
            'settings.show_product_cta' => 'nullable|in:0,1',
            // Toggle CTA Portofolio
            'settings.show_portfolio_cta' => 'nullable|in:0,1',
            // Mendukung PNG, JPG, JPEG, SVG, WebP (Maks 2MB)
            'logo' => 'nullable|mimes:png,jpg,jpeg,svg,webp|max:2048',
            // Mendukung PNG, ICO, SVG (Maks 1MB)
            'favicon' => 'nullable|mimes:png,ico,svg,jpg,jpeg|max:1024',
        ]);
        // Simpan pengaturan teks
        foreach ($this->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $this->getGroupForKey($key)]
            );
        }

        // Handle Upload Logo
        if ($this->logo) {
            $oldLogo = Setting::where('key', 'logo')->value('value');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $this->logo->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path, 'group' => 'branding']);
            $this->logo = null;
        }

        // Handle Upload Favicon
        if ($this->favicon) {
            $oldFavicon = Setting::where('key', 'favicon')->value('value');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $path = $this->favicon->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $path, 'group' => 'branding']);
            $this->favicon = null;
        }

        // Bersihkan cache agar frontend langsung menggunakan data baru
        Setting::forgetCache();

        session()->flash('success', 'Pengaturan website berhasil disimpan.');
    }

    private function getGroupForKey($key)
    {
        if (in_array($key, ['company_name', 'company_email', 'company_phone', 'company_whatsapp', 'company_address', 'company_description', 'office_hours', 'google_maps_embed'])) {
            return 'company';
        }
        if (in_array($key, ['logo', 'favicon'])) {
            return 'branding';
        }
        if (str_contains($key, 'url')) {
            return 'social';
        }
        if (str_contains($key, 'seo_')) {
            return 'seo';
        }

        return 'general';
    }

    public function render()
    {
        return view('livewire.admin.settings.index');
    }
}
