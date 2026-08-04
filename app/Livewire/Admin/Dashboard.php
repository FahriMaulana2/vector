<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;
use App\Models\Portfolio;
use App\Models\Order;
use App\Models\ContactMessage;

#[Layout('components.layouts.admin')]
#[Title('Dashboard - Admin OMH Vector')]
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
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('status', 'unread')->count(),
        ];

        // Eager loading untuk mencegah N+1 query
        $recentOrders = Order::with('product')
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', compact('stats', 'recentOrders', 'recentMessages'));
    }
}