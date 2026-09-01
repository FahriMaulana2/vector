<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Halaman Produk - Admin OMH Vector')]
class PageContent extends Component
{
    public string $hero_badge_text = '';

    public string $hero_title_line1 = '';

    public string $hero_title_line2 = '';

    public string $hero_description = '';

    public string $quote_text = '';

    public string $quote_description = '';

    public string $cta_title = '';

    public string $cta_description = '';

    public string $cta_button_primary_text = '';

    public string $cta_button_secondary_text = '';

    public function mount(): void
    {
        foreach ($this->defaults() as $key => $default) {
            $value = Setting::get($key, $default);
            $this->{$key} = is_string($value) && trim($value) !== ''
                ? $value
                : $default;
        }
    }

    public function save(): void
    {
        $this->validate([
            'hero_badge_text' => ['required', 'string', 'max:100'],
            'hero_title_line1' => ['required', 'string', 'max:255'],
            'hero_title_line2' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string', 'max:1000'],
            'quote_text' => ['required', 'string', 'max:1000'],
            'quote_description' => ['required', 'string', 'max:1000'],
            'cta_title' => ['required', 'string', 'max:255'],
            'cta_description' => ['required', 'string', 'max:1000'],
            'cta_button_primary_text' => ['required', 'string', 'max:100'],
            'cta_button_secondary_text' => ['required', 'string', 'max:100'],
        ]);

        foreach (array_keys($this->defaults()) as $key) {
            Setting::set($key, $this->{$key}, 'products_page');
        }

        session()->flash('success', 'Konten halaman produk berhasil disimpan.');
    }

    /**
     * @return array<string, string>
     */
    private function defaults(): array
    {
        return [
            'hero_badge_text' => 'PRODUK',
            'hero_title_line1' => 'Solusi Produk Cetak',
            'hero_title_line2' => 'Untuk Brand Anda',
            'hero_description' => 'Temukan produk custom pilihan kami untuk kebutuhan branding, event, retail, dan promosi yang tampil lebih profesional.',
            'quote_text' => 'Setiap produk dibuat untuk membantu brand Anda tampil lebih kuat, lebih siap, dan lebih berdampak.',
            'quote_description' => 'Dari kebutuhan bisnis hingga event personal, kami membantu mewujudkan ide Anda ke dalam produk berkualitas tinggi.',
            'cta_title' => 'Siap Wujudkan Produk Custom yang Cocok untuk Bisnis Anda?',
            'cta_description' => 'Ceritakan kebutuhan Anda. Kami akan bantu memilih produk terbaik dan menyiapkan estimasi yang tepat.',
            'cta_button_primary_text' => 'Konsultasikan Pesanan',
            'cta_button_secondary_text' => 'Lihat Katalog Lengkap',
        ];
    }

    public function render()
    {
        return view('livewire.admin.products.page-content');
    }
}
