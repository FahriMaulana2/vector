<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public function render()
    {
        $totalProducts = Product::active()->count();
        $isCataloguePage = request()->routeIs('products.index');
        $showProductCta = ! $isCataloguePage && $totalProducts > 6;

        // Ambil maksimal 6 produk aktif sesuai urutan yang sudah ditentukan,
        // dengan eager loading images untuk menghindari N+1 query.
        $productsQuery = Product::active()
            ->ordered()
            ->with(['images']);

        $products = $isCataloguePage
            ? $productsQuery->paginate(9)
            : $productsQuery->take(6)->get();

        // Ambil link WhatsApp dari Settings (STEP 2) agar tidak hardcode di Blade.
        $whatsappLink = Setting::getWhatsAppLink();

        return view('livewire.products', compact(
            'products',
            'whatsappLink',
            'totalProducts',
            'isCataloguePage',
            'showProductCta'
        ));
    }
}
