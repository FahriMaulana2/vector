<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Portfolios;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Halaman Portfolio - Admin OMAH Vector')]
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
            $value = Setting::get($key);
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
            Setting::set($key, $this->{$key}, 'portfolio_page');
        }

        session()->flash('success', 'Konten halaman portfolio berhasil disimpan.');
    }

    /**
     * @return array<string, string>
     */
    private function defaults(): array
    {
        return [
            'hero_badge_text' => 'PORTFOLIO',
            'hero_title_line1' => 'Jelajahi Semua Hasil Karya',
            'hero_title_line2' => 'Tampil Lebih Berkesan',
            'hero_description' => 'Setiap proyek adalah kebanggaan. Lihat hasil karya percetakan dan branding yang kami kerjakan untuk membuat ide tampil lebih berkesan.',
            'quote_text' => 'Setiap detail memiliki cerita. Kami membantu membuatnya terlihat lebih berkesan.',
            'quote_description' => 'Mulai dari identitas brand, packaging, hingga kebutuhan cetak untuk bisnis dan berbagai kebutuhan personal.',
            'cta_title' => 'Punya Project yang Ingin Dibuat Lebih Berkesan?',
            'cta_description' => 'Ceritakan kebutuhan desain dan percetakan Anda. Kami siap membantu mewujudkan ide menjadi hasil yang nyata.',
            'cta_button_primary_text' => 'Konsultasikan Project',
            'cta_button_secondary_text' => 'Hubungi Kami',
        ];
    }

    public function render()
    {
        return view('livewire.admin.portfolios.page-content');
    }
}
