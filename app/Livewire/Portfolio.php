<?php

namespace App\Livewire;

use App\Models\Portfolio as PortfolioModel;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class Portfolio extends Component
{
    use WithPagination;

    public function render()
    {
        $totalPortfolios = PortfolioModel::active()->count();
        $isPortfolioPage = request()->routeIs('portfolio.index');

        $portfoliosQuery = PortfolioModel::active()
            ->ordered()
            ->with(['images']);

        $portfolios = $isPortfolioPage
            ? $portfoliosQuery->paginate(9)
            : $portfoliosQuery->take(6)->get();

        $showPortfolioCta = ! $isPortfolioPage
            && $totalPortfolios > 6
            && (bool) Setting::get('show_portfolio_cta', true);

        return view('livewire.portfolio', compact(
            'portfolios',
            'showPortfolioCta',
            'totalPortfolios',
            'isPortfolioPage'
        ));
    }
}
