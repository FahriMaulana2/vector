<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Services\CartService;
use App\Services\PricingEngine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $shipping_address = '';

    public string $design_file_status = 'ready';

    public string $notes = '';

    public bool $isSubmitting = false;

    #[On('cart-updated')]
    public function refreshCart(): void
    {
        // Triggers re-render to reflect updated cart items from session
    }

    public function removeItem(string $uuid, CartService $cartService): void
    {
        $cartService->removeItem($uuid);
        $this->dispatch('cart-updated');
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
                    'status' => 'pending',
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

            // 4. Build WhatsApp URL
            $adminWhatsapp = Setting::getWhatsAppNumber();
            $normalizedAdminPhone = Setting::normalizePhoneNumber($adminWhatsapp);

            if ($normalizedAdminPhone) {
                $whatsappMessage = $this->buildWhatsAppMessage($order);
                $whatsappUrl = 'https://wa.me/'.$normalizedAdminPhone.'?text='.rawurlencode($whatsappMessage);
                $this->js('window.open('.json_encode($whatsappUrl).", '_blank');");
            }

            // 5. Reset Form State
            $this->reset(['name', 'phone', 'email', 'shipping_address', 'notes']);
            $this->design_file_status = 'ready';
            $this->dispatch('cart-updated');

            session()->flash('success', "Pesanan {$order->order_number} berhasil dibuat! Mengalihkan ke WhatsApp...");
        } catch (\Throwable $e) {
            Log::error('Order checkout error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            $this->addError('general', 'Terjadi kendala saat memproses pesanan: '.$e->getMessage());
        } finally {
            $this->isSubmitting = false;
        }
    }

    protected function buildWhatsAppMessage(Order $order): string
    {
        $separator = "\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81";
        $designStatusLabel = $order->design_file_status === 'ready' ? 'File Sudah Siap' : 'Belum Ada File / Minta Bantuan Desain';

        $itemsSummary = '';
        foreach ($order->orderItems as $idx => $item) {
            $num = $idx + 1;
            $itemsSummary .= "{$num}. *{$item->product_name}* (Qty: {$item->qty})\n";

            if ($item->side_mode) {
                $sideLabel = $item->side_mode === '2_muka' ? '2 Muka (Bolak-balik)' : '1 Muka';
                $itemsSummary .= "   - Sisi: {$sideLabel}\n";
            }

            if ($item->length_m && $item->width_m) {
                $itemsSummary .= "   - Ukuran: {$item->length_m}m x {$item->width_m}m\n";
            }

            if (! empty($item->selected_options) && is_array($item->selected_options)) {
                $opts = array_map(fn ($o) => ($o['group_name'] ?? '').': '.($o['option_name'] ?? ''), $item->selected_options);
                $itemsSummary .= '   - Opsi: '.implode(', ', $opts)."\n";
            }

            $itemsSummary .= '   - Subtotal: Rp '.number_format((float) $item->line_subtotal, 0, ',', '.')."\n\n";
        }

        $manualQuoteNotice = $order->has_manual_quote_item
            ? "\n\xE2\x9A\xA0\xEF\xB8\x8F *Catatan*: Terdapat item dengan opsi yang memerlukan konfirmasi harga tambahan dari admin.\n"
            : '';

        $notesBlock = $order->notes
            ? "{$separator}\n\xF0\x9F\x92\xAC *CATATAN TAMBAHAN*\n{$order->notes}\n\n"
            : '';

        return "Halo Admin OMAH Vector \xF0\x9F\x91\x8B\n\n"
            ."Saya ingin memesan cetak dengan nomor pesanan: *{$order->order_number}*\n\n"
            ."{$separator}\n"
            ."\xF0\x9F\x93\x8B *DATA PEMESAN*\n"
            ."{$separator}\n"
            ."\xF0\x9F\x91\xA4 Nama: {$order->customer_name}\n"
            ."\xF0\x9F\x93\xB1 No. WA: {$order->customer_phone}\n"
            ."\xF0\x9F\x93\xA7 Email: {$order->customer_email}\n"
            ."\xF0\x9F\x93\x8D Alamat Pengiriman:\n{$order->shipping_address}\n"
            ."\xF0\x9F\x93\x81 Status File: {$designStatusLabel}\n\n"
            ."{$separator}\n"
            ."\xF0\x9F\x9B\x92 *RINCIAN ITEM PESANAN*\n"
            ."{$separator}\n"
            .trim($itemsSummary)."\n\n"
            .'*TOTAL ESTIMASI SUBTOTAL*: Rp '.number_format((float) $order->subtotal, 0, ',', '.')."\n"
            .$manualQuoteNotice
            .$notesBlock
            ."{$separator}\n"
            ."Mohon dicek dan diinformasikan kelanjutannya.\n"
            .'Terima kasih!';
    }

    public function render(CartService $cartService)
    {
        return view('livewire.contact', [
            'cartItems' => $cartService->getItems(),
            'cartSubtotal' => $cartService->getSubtotal(),
            'hasManualQuote' => $cartService->hasManualQuoteItem(),
            'cartCount' => $cartService->count(),
        ]);
    }
}
