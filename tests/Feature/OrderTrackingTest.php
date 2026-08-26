<?php

use App\Livewire\OrderTracking;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;

it('shows the public tracking page and pre-fills an order number without exposing details', function () {
    Livewire::test(OrderTracking::class, ['order' => 'ORD-20260825-ABC123'])
        ->assertSet('orderNumber', 'ORD-20260825-ABC123')
        ->assertSet('trackedOrder', null)
        ->assertSee('Lacak Pesanan');
});

it('tracks an order with a case-insensitive email and shows its history', function () {
    $order = Order::create([
        'order_number' => 'ORD-20260825-ABC123',
        'customer_name' => 'Customer Example',
        'customer_phone' => '08123456789',
        'customer_email' => 'customer@example.com',
        'quantity' => 1,
        'status' => 'printing',
    ]);

    OrderStatusHistory::create([
        'order_id' => $order->id,
        'previous_status' => 'confirmed',
        'new_status' => 'printing',
        'notes' => 'Pesanan sedang dicetak.',
        'created_at' => now(),
    ]);

    Livewire::test(OrderTracking::class)
        ->set('orderNumber', $order->order_number)
        ->set('email', 'CUSTOMER@EXAMPLE.COM')
        ->call('trackOrder')
        ->assertSet('trackedOrder.id', $order->id)
        ->assertSee('Customer Example')
        ->assertSee('Pesanan sedang dicetak.');
});

it('uses a generic error for invalid tracking credentials', function () {
    Livewire::test(OrderTracking::class)
        ->set('orderNumber', 'ORD-DOES-NOT-EXIST')
        ->set('email', 'wrong@example.com')
        ->call('trackOrder')
        ->assertSet('trackedOrder', null)
        ->assertSee('Nomor pesanan atau email tidak ditemukan.');
});

it('limits public tracking attempts to five per minute per ip address', function () {
    RateLimiter::clear('order-tracking:127.0.0.1');

    $component = Livewire::test(OrderTracking::class)
        ->set('orderNumber', 'ORD-DOES-NOT-EXIST')
        ->set('email', 'wrong@example.com');

    $component->call('trackOrder')->call('trackOrder')->call('trackOrder')->call('trackOrder')->call('trackOrder');

    $component->call('trackOrder')
        ->assertSet('rateLimited', true)
        ->assertSee('Terlalu banyak percobaan. Silakan coba lagi dalam beberapa saat.');
});
