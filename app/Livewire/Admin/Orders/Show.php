<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Order;

#[Layout('components.layouts.admin')]
#[Title('Detail Pesanan - Admin OMH Vector')]
class Show extends Component
{
    public Order $order;

    public function mount($order)
    {
        $this->order = Order::with(['product', 'statusHistories'])->findOrFail($order);
    }

    public function updateStatus($status)
    {
        $this->order->changeStatus($status, 'Status diubah via admin');
        session()->flash('success', 'Status pesanan berhasil diperbarui.');
        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
