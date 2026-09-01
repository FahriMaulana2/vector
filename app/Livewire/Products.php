<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public bool $isProductsPage = false;

    public string $activeCategory = 'all';

    public function mount(): void
    {
        $this->isProductsPage = request()->routeIs('products.index');
    }

    public function setCategory(string $category): void
    {
        $this->activeCategory = ProductCategory::query()
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
            $value = Setting::get($key, $default);

            if (is_string($value) && trim($value) !== '') {
                $content[$key] = $value;
            }
        }

        $totalProducts = Product::active()->count();
        $whatsappLink = Setting::getWhatsAppLink(
            'Halo, saya tertarik untuk konsultasi produk custom.'
        );

        $productsQuery = Product::active()
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
            ->with(['category', 'images']);

        $filteredTotal = (clone $productsQuery)->count();

        $products = $this->isProductsPage
            ? $productsQuery->paginate(9)
            : $productsQuery->take(6)->get();

        $categories = ProductCategory::query()
            ->active()
            ->whereHas(
                'products',
                fn (Builder $query) => $query->where('is_active', true)
            )
            ->ordered()
            ->get(['name', 'slug']);

        $showingFrom = $products instanceof LengthAwarePaginator
            ? ($products->total() > 0 ? $products->firstItem() ?? 0 : 0)
            : ($filteredTotal > 0 ? 1 : 0);

        $showingTo = $products instanceof LengthAwarePaginator
            ? ($products->total() > 0 ? $products->lastItem() ?? 0 : 0)
            : min($filteredTotal, 6);

        $totalPages = $products instanceof LengthAwarePaginator
            ? $products->lastPage()
            : 1;

        $showProductCta = ! $this->isProductsPage
            && $totalProducts > 6
            && (bool) Setting::get('show_products_cta', true);

        $view = view($this->isProductsPage ? 'livewire.products-page' : 'livewire.products', [
            'products' => $products,
            'showProductCta' => $showProductCta,
            'totalProducts' => $totalProducts,
            'filteredTotal' => $filteredTotal,
            'content' => $content,
            'whatsappLink' => $whatsappLink,
            'categories' => $categories,
            'showingFrom' => $showingFrom,
            'showingTo' => $showingTo,
            'totalPages' => $totalPages,
            'isProductsPage' => $this->isProductsPage,
            'isCataloguePage' => $this->isProductsPage,
        ]);

        return $this->isProductsPage
            ? $view->layout('components.layouts.app')
            : $view;
    }

    /**
     * @return array<string, string>
     */
    private function contentDefaults(): array
    {
        return [
            'hero_badge_text' => 'PRODUK',
            'hero_title_line1' => 'Solusi Produk Cetak',
            'hero_title_line2' => 'Untuk Brand Anda',
            'hero_description' => 'Dari kebutuhan branding, promosi, hingga kebutuhan event dan pernikahan, temukan produk custom berkualitas yang siap membantu bisnis Anda tampil lebih kuat.',
            'quote_text' => 'Setiap produk dibuat untuk membantu brand Anda tampil lebih kuat, lebih rapi, dan lebih berkesan.',
            'quote_description' => 'Kami menyediakan berbagai kebutuhan cetak dan merchandise untuk bisnis, event, maupun kebutuhan personal.',
            'cta_title' => 'Siap Wujudkan Produk Custom yang Cocok untuk Bisnis Anda?',
            'cta_description' => 'Ceritakan kebutuhan Anda. Tim kami siap membantu memilih produk terbaik dan merancang solusi yang paling efisien.',
            'cta_button_primary_text' => 'Konsultasikan Pesanan',
            'cta_button_secondary_text' => 'Lihat Katalog Lengkap',
        ];
    }
}
