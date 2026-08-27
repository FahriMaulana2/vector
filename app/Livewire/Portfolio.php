<?php

namespace App\Livewire;

use App\Models\Portfolio as PortfolioModel;
use App\Models\PortfolioCategory;
use App\Models\Setting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Portfolio extends Component
{
    use WithPagination;

    public bool $isPortfolioPage = false;

    public string $activeCategory = 'all';

    public function mount(): void
    {
        $this->isPortfolioPage = request()->routeIs('portfolio.index');
    }

    public function setCategory(string $category): void
    {
        $this->activeCategory = PortfolioCategory::query()
            ->active()
            ->where('slug', $category)
            ->exists()
            ? $category
            : 'all';

        $this->resetPage();
    }

    public function render()
    {
        $content = $this->contentDefaults();

        foreach ($content as $key => $default) {
            $value = Setting::get($key);

            if (is_string($value) && trim($value) !== '') {
                $content[$key] = $value;
            }
        }
        $quoteTextBeforeAccent = $content['quote_text'];
        $quoteTextAccent = '';

        if (preg_match('/(lebih berkesan\.?)/i', $content['quote_text'], $matches, PREG_OFFSET_CAPTURE)) {
            $accentOffset = $matches[1][1];
            $quoteTextBeforeAccent = substr($content['quote_text'], 0, $accentOffset);
            $quoteTextAccent = substr($content['quote_text'], $accentOffset);
        }
        $totalPortfolios = PortfolioModel::active()->count();
        $whatsappLink = Setting::getWhatsAppLink(
            'Halo, saya tertarik untuk konsultasi project percetakan/desain.'
        );

        $portfoliosQuery = PortfolioModel::active()
            ->when(
                $this->activeCategory !== 'all',
                fn ($query) => $query->whereHas(
                    'category',
                    fn ($categoryQuery) => $categoryQuery
                        ->where('slug', $this->activeCategory)
                        ->where('is_active', true)
                )
            )
            ->ordered()
            ->with(['images', 'category']);

        $filteredTotal = (clone $portfoliosQuery)->count();

        $portfolios = $this->isPortfolioPage
            ? $portfoliosQuery->paginate(9)
            : $portfoliosQuery->take(6)->get();

        $categories = PortfolioCategory::query()
            ->active()
            ->whereHas(
                'portfolios',
                fn (Builder $query) => $query->where('is_active', true)
            )
            ->ordered()
            ->get(['name', 'slug']);

        $showingFrom = $portfolios instanceof LengthAwarePaginator
            ? $portfolios->firstItem() ?? 0
            : ($filteredTotal > 0 ? 1 : 0);
        $showingTo = $portfolios instanceof LengthAwarePaginator
            ? $portfolios->lastItem() ?? 0
            : min($filteredTotal, 6);
        $totalPages = $portfolios instanceof LengthAwarePaginator
            ? $portfolios->lastPage()
            : 1;

        $showPortfolioCta = ! $this->isPortfolioPage
            && $totalPortfolios > 6
            && (bool) Setting::get('show_portfolio_cta', true);

        $view = view($this->isPortfolioPage ? 'livewire.portfolio-page' : 'livewire.portfolio', [
            'portfolios' => $portfolios,
            'showPortfolioCta' => $showPortfolioCta,
            'totalPortfolios' => $totalPortfolios,
            'filteredTotal' => $filteredTotal,
            'content' => $content,
            'whatsappLink' => $whatsappLink,
            'quoteTextBeforeAccent' => $quoteTextBeforeAccent,
            'quoteTextAccent' => $quoteTextAccent,
            'categories' => $categories,
            'showingFrom' => $showingFrom,
            'showingTo' => $showingTo,
            'totalPages' => $totalPages,
            'isPortfolioPage' => $this->isPortfolioPage,
        ]);

        return $this->isPortfolioPage
            ? $view->layout('components.layouts.app')
            : $view;
    }

    /**
     * @return array<string, string>
     */
    private function contentDefaults(): array
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
}
