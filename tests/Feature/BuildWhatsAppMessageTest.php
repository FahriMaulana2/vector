<?php

declare(strict_types=1);

use App\Livewire\OrderReceipt;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;

it('builds the WhatsApp message in plain ASCII without emoji', function () {
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'wa-test'],
        ['name' => 'WA Test', 'is_active' => true]
    );

    $product = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Sablon DTF',
        'slug' => 'sablon-dtf-wa',
        'price' => 50000,
        'pricing_mode' => 'flat',
        'base_price_unit' => 'lembar',
        'is_active' => true,
    ]);

    $order = Order::create([
        'customer_name' => 'Fahri Maulana',
        'customer_phone' => '08123456789',
        'customer_email' => 'fahri@test.com',
        'shipping_address' => 'Jl. Merdeka No.1, Jakarta',
        'design_file_status' => 'need_design_help',
        'subtotal' => 50000,
        'has_manual_quote_item' => false,
        'notes' => '1233213',
        'status' => 'menunggu_konfirmasi',
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'product_name' => 'Sablon DTF',
        'base_price_snapshot' => 50000,
        'selected_options' => null,
        'options_total' => 0,
        'unit_price' => 50000,
        'qty' => 1,
        'line_subtotal' => 50000,
        'side_mode' => null,
        'manual_quote_flag' => false,
    ]);

    $order->load('orderItems');

    $component = new OrderReceipt;
    $message = $component->buildWhatsAppMessage($order);

    // No emoji anywhere in the message
    expect($message)->not->toMatch('/[\x{1F000}-\x{1FFFF}]/u');
    expect($message)->not->toMatch('/[\x{2600}-\x{27BF}]/u');
    expect($message)->not->toMatch('/[\x{FE00}-\x{FE0F}]/u');

    // Header
    expect($message)->toContain('*PESANAN BARU - OMAH VECTOR*');
    expect($message)->toContain("No. Pesanan: *{$order->order_number}*");

    // Customer data (no emoji prefixes)
    expect($message)->toContain('*Data Pemesan*');
    expect($message)->toContain('Nama: Fahri Maulana');
    expect($message)->toContain('WA: 08123456789');
    expect($message)->toContain('Email: fahri@test.com');
    expect($message)->toContain('Alamat: Jl. Merdeka No.1, Jakarta');
    expect($message)->toContain('Belum Ada File / Minta Bantuan Desain');

    // Line items
    expect($message)->toContain('*Rincian Pesanan*');
    expect($message)->toContain('1. Sablon DTF x1');
    expect($message)->toContain('Rp 50.000');

    // Subtotal
    expect($message)->toContain('*Subtotal: Rp 50.000*');

    // No manual quote warning for this order
    expect($message)->not->toContain('PERHATIAN');

    // Notes present
    expect($message)->toContain('Catatan: 1233213');

    // Closing
    expect($message)->toContain('Mohon dicek dan diinfokan kelanjutannya. Terima kasih!');
});

it('includes manual quote warning in plain ASCII', function () {
    $category = ProductCategory::firstOrCreate(
        ['slug' => 'wa-test-2'],
        ['name' => 'WA Test 2', 'is_active' => true]
    );

    $product = Product::create([
        'product_category_id' => $category->id,
        'name' => 'Spanduk Flexi',
        'slug' => 'spanduk-flexi-wa',
        'price' => 150000,
        'pricing_mode' => 'flat',
        'base_price_unit' => 'lembar',
        'is_active' => true,
    ]);

    $order = Order::create([
        'customer_name' => 'Test User',
        'customer_phone' => '08111111111',
        'customer_email' => 'test@example.com',
        'shipping_address' => 'Jl. Test',
        'design_file_status' => 'ready',
        'subtotal' => 150000,
        'has_manual_quote_item' => true,
        'notes' => null,
        'status' => 'menunggu_konfirmasi',
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'product_name' => 'Spanduk Flexi',
        'base_price_snapshot' => 150000,
        'selected_options' => [
            ['group_name' => 'Bahan', 'option_name' => 'Flexi Korea'],
        ],
        'options_total' => 0,
        'unit_price' => 150000,
        'qty' => 1,
        'line_subtotal' => 150000,
        'side_mode' => '2_muka',
        'length_m' => 2.00,
        'width_m' => 1.50,
        'manual_quote_flag' => true,
    ]);

    $order->load('orderItems');

    $component = new OrderReceipt;
    $message = $component->buildWhatsAppMessage($order);

    // No emoji
    expect($message)->not->toMatch('/[\x{1F000}-\x{1FFFF}]/u');

    expect($message)->toContain('File Sudah Siap');
    expect($message)->toContain('PERHATIAN: Ada item perlu konfirmasi harga tambahan');
    expect($message)->toContain('2 Muka, 2.00m x 1.50m, Flexi Korea');
    expect($message)->not->toContain('Catatan:');
});
