<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Portfolio as PortfolioModel;
use App\Models\Setting;

class Portfolio extends Component
{
    public function render()
    {
        // Ambil portfolio aktif, urut sesuai sort_order, maksimal 6.
        // Hanya eager load images karena kategori sudah tidak digunakan di frontend.
        $portfolios = PortfolioModel::active()
            ->ordered()
            ->with(['images'])
            ->take(6)
            ->get();

        // CTA "Lihat Semua Portofolio" dikontrol admin melalui setting.
        // Default ON jika setting belum tersedia.
        $showPortfolioCta = (bool) Setting::get('show_portfolio_cta', true);

        return view('livewire.portfolio', compact(
            'portfolios',
            'showPortfolioCta'
        ));
    }
}