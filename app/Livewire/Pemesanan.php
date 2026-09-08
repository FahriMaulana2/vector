<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use App\Services\PricingEngine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Pemesanan extends Component
{
    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $shipping_address = '';

    public string $design_file_status = 'ready';

    public string $notes = '';

    public bool $isSubmitting = false;

    /**
     * Guard the order form: it may only be reached with a valid cart state.
     */
    public function mount(CartService $cartService): void
    {
        if ($cartService->count() === 0) {
            $this->redirect(route('products.index'), navigate: true);
        }
    }

    #[On('cart-updated')]
    public function refreshCart(): void
    {
        // Triggers re-render to reflect updated cart items from session
    }

    public function removeItem(string $uuid, CartService $cartService): void
    {
        $cartService->removeItem($uuid);
        $this->dispatch('cart-updated');

        if ($cartService->count() === 0) {
            $this->redirect(route('products.index'), navigate: true);
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:8|max:30',
            'email' => 'required|email|max:255',
            'shipping_address' => 'required|string|min:5|max:1000',
            'design_file_status' => 'required|in:ready,need_design_help',
            'notes' => 'nullable|string|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap minimal 2 karakter.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.min' => 'Nomor WhatsApp minimal 8 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'shipping_address.required' => 'Alamat lengkap pengiriman wajib diisi.',
            'shipping_address.min' => 'Alamat pengiriman minimal 5 karakter.',
            'design_file_status.required' => 'Pilih status kesiapan file desain.',
            'design_file_status.in' => 'Status file desain tidak valid.',
        ];
    }

    public function submit(CartService $cartService, PricingEngine $pricingEngine): void
    {
        if ($this->isSubmitting) {
            return;
        }

        $cartItems = $cartService->getItems();
        if (empty($cartItems)) {
            $this->addError('cart', 'Keranjang pesanan masih kosong. Silakan pilih produk dari katalog terlebih dahulu.');

            return;
        }

        $validated = $this->validate();
        $this->isSubmitting = true;

        try {
            /** @var Order $order */
            $order = DB::transaction(function () use ($cartItems, $pricingEngine, $validated) {
                $recalculatedItems = [];
                $orderSubtotal = 0.0;
                $hasManualQuote = false;

                foreach ($cartItems as $item) {
                    $productId = (int) $item['product_id'];
                    $qty = (int) ($item['qty'] ?? 1);
                    $sideMode = (string) ($item['side_mode'] ?? '1_muka');
                    $lengthM = isset($item['length_m']) ? (float) $item['length_m'] : null;
                    $widthM = isset($item['width_m']) ? (float) $item['width_m'] : null;

                    // Extract selected option IDs
                    $selectedOptionIds = [];
                    if (! empty($item['selected_options']) && is_array($item['selected_options'])) {
                        foreach ($item['selected_options'] as $opt) {
                            if (isset($opt['group_id'], $opt['option_id'])) {
                                $selectedOptionIds[(int) $opt['group_id']] = (int) $opt['option_id'];
                            }
                        }
                    }

                    $product = Product::findOrFail($productId);
                    $freshCalculated = $pricingEngine->calculate(
                        $product,
                        $qty,
                        $selectedOptionIds,
                        $sideMode,
                        $lengthM,
                        $widthM
                    );

                    // Price verification log
                    if (isset($item['line_subtotal']) && abs((float) $item['line_subtotal'] - (float) $freshCalculated['line_subtotal']) > 0.01) {
                        Log::warning("Order cart price mismatch detected for product {$product->id}. Session: {$item['line_subtotal']}, Fresh: {$freshCalculated['line_subtotal']}. Using recalculated price.");
                    }

                    $orderSubtotal += (float) $freshCalculated['line_subtotal'];
                    if (! empty($freshCalculated['manual_quote_flag'])) {
                        $hasManualQuote = true;
                    }

                    $recalculatedItems[] = $freshCalculated;
                }

                // 1. Create Order row (product_id and quantity are kept null for all new orders)
                $order = Order::create([
                    'customer_name' => $validated['name'],
                    'customer_phone' => $validated['phone'],
                    'customer_email' => $validated['email'],
                    'shipping_address' => $validated['shipping_address'],
                    'design_file_status' => $validated['design_file_status'],
                    'subtotal' => $orderSubtotal,
                    'has_manual_quote_item' => $hasManualQuote,
                    'notes' => $validated['notes'] ?: null,
                    'status' => 'menunggu_konfirmasi',
                    'product_id' => null,
                    'quantity' => null,
                ]);

                // 2. Insert OrderItem rows
                foreach ($recalculatedItems as $recalc) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $recalc['product_id'],
                        'product_name' => $recalc['product_name'],
                        'base_price_snapshot' => $recalc['base_price_snapshot'],
                        'selected_options' => $recalc['selected_options'],
                        'options_total' => $recalc['options_total'],
                        'unit_price' => $recalc['unit_price'],
                        'qty' => $recalc['qty'],
                        'line_subtotal' => $recalc['line_subtotal'],
                        'side_mode' => $recalc['side_mode'] ?? null,
                        'length_m' => $recalc['length_m'] ?? null,
                        'width_m' => $recalc['width_m'] ?? null,
                        'manual_quote_flag' => (bool) ($recalc['manual_quote_flag'] ?? false),
                        'manual_quote_note' => $recalc['manual_quote_note'] ?? null,
                        'manual_quote_amount' => null,
                    ]);
                }

                return $order;
            });

            // 3. Clear Cart Session
            $cartService->clear();

            // Redirect to digital receipt page
            $this->redirect(route('order.receipt', ['orderNumber' => $order->order_number]), navigate: true);

            return;
        } catch (\Throwable $e) {
            Log::error('Order checkout error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            $this->addError('general', 'Terjadi kendala saat memproses pesanan: '.$e->getMessage());
        } finally {
            $this->isSubmitting = false;
        }
    }

    public function render(CartService $cartService)
    {
        return view('livewire.pemesanan', [
            'cartItems' => $cartService->getItems(),
            'cartSubtotal' => $cartService->getSubtotal(),
            'hasManualQuote' => $cartService->hasManualQuoteItem(),
            'cartCount' => $cartService->count(),
        ])->layout('components.layouts.app');
    }
}
