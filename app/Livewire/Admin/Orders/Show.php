<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Detail Pesanan - Admin OMAH Vector')]
class Show extends Component
{
    public Order $order;

    public $new_status = '';

    public $status_notes = '';

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->new_status = $order->status;
    }

    public function updateStatus()
    {
        $this->validate([
            'new_status' => 'required|string',
            'status_notes' => 'nullable|string|max:500',
        ]);

        if ($this->new_status === $this->order->status) {
            return;
        }

        DB::transaction(function () {
            $oldStatus = $this->order->status;

            $this->order->update([
                'status' => $this->new_status,
                'completed_at' => $this->new_status === 'completed' ? now() : $this->order->completed_at,
            ]);

            OrderStatusHistory::create([
                'order_id' => $this->order->id,
                'previous_status' => $oldStatus,
                'new_status' => $this->new_status,
                'changed_by' => Auth::id(),
                'notes' => $this->status_notes,
            ]);
        });

        session()->flash('success', 'Status pesanan berhasil diperbarui.');
        $this->status_notes = '';
    }

    public function render()
    {
        return view('livewire.admin.orders.show', [
            'histories' => $this->order->statusHistories()->with('changedByUser')->latest()->get(),
        ]);
    }
}
