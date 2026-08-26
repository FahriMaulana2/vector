<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Lacak Pesanan - OMH Vector')]
class OrderTracking extends Component
{
    public string $orderNumber = '';

    public string $email = '';

    public ?Order $trackedOrder = null;

    public string $lookupError = '';

    public bool $rateLimited = false;

    public function mount(?string $order = null): void
    {
        $this->orderNumber = $order ?? '';
    }

    public function trackOrder(): void
    {
        $this->trackedOrder = null;
        $this->lookupError = '';
        $this->rateLimited = false;

        $key = 'order-tracking:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->rateLimited = true;

            return;
        }

        RateLimiter::hit($key, 60);

        $this->validate([
            'orderNumber' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $this->trackedOrder = Order::query()
            ->with('statusHistories')
            ->where('order_number', trim($this->orderNumber))
            ->whereRaw('LOWER(customer_email) = ?', [strtolower(trim($this->email))])
            ->first();

        if ($this->trackedOrder === null) {
            $this->lookupError = 'Nomor pesanan atau email tidak ditemukan.';
        }
    }

    public function formatStatus(?string $status): string
    {
        return match ($status) {
            'design_process' => 'Design Process',
            'ready_for_pickup' => 'Ready for Pickup',
            default => ucfirst(str_replace('_', ' ', $status ?? 'Dibuat')),
        };
    }

    public function render()
    {
        return view('livewire.order-tracking');
    }
}
