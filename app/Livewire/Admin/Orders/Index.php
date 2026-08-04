<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Order;

#[Layout('components.layouts.admin')]
#[Title('Pesanan - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    public function render()
    {
        return view('livewire.admin.orders.index', [
            'items' => Order::with('product')
                ->when($this->search, fn($q) => $q->where(function($q) {
                    $q->where('order_number', 'like', '%'.$this->search.'%')
                      ->orWhere('customer_name', 'like', '%'.$this->search.'%');
                }))
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->latest()
                ->paginate(10),
        ]);
    }
}
