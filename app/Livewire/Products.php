<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Setting;

class Products extends Component
{
    public function render()
    {
        // Ambil produk aktif + featured + urut,
        // dengan eager loading images untuk menghindari N+1 query.
        $products = Product::active()
            ->featured()
            ->ordered()
            ->with(['images'])
            ->take(6)
            ->get();

        // Ambil link WhatsApp dari Settings (STEP 2) agar tidak hardcode di Blade.
        $whatsappLink = Setting::getWhatsAppLink();

        // CTA "Lihat Semua Produk" dikontrol admin via setting.
        // Default ON jika setting belum tersedia.
        $showProductCta = (bool) Setting::get('show_product_cta', true);

        return view('livewire.products', compact(
            'products',
            'whatsappLink',
            'showProductCta'
        ));
    }
}