<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Faq;
use App\Models\Order;
use App\Models\Portfolio;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Dashboard - Admin OMAH Vector')]
class Dashboard extends Component
{
    public function render()
    {
        // Statistik menggunakan query count yang efisien
        $stats = [
            'total_products' => Product::count(),
            'total_portfolios' => Portfolio::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_faqs' => Faq::count(),
        ];

        // Eager loading untuk mencegah N+1 query
        $recentOrders = Order::with('product')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', compact('stats', 'recentOrders'));
    }
}
