<?php

declare(strict_types=1);

namespace App\Observers;

use App\Mail\PesananStatusUpdated;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    public function updating(Order $order): void
    {
        if (! $order->isDirty('status') || blank($order->customer_email)) {
            return;
        }

        Mail::to($order->customer_email)->send(new PesananStatusUpdated($order));
    }
}
