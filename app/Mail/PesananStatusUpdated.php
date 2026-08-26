<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Route;

class PesananStatusUpdated extends Mailable
{
    use SerializesModels;

    public function __construct(public Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembaruan Status Pesanan '.$this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pesanan-status-updated',
            with: [
                'trackingUrl' => Route::has('orders.track')
                    ? route('orders.track', ['order' => $this->order->order_number])
                    : url('/lacak-pesanan'),
            ],
        );
    }
}
