<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Order;
use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Struk Pesanan - OMAH Vector')]
class OrderReceipt extends Component
{
    public string $orderNumber = '';

    public ?Order $order = null;

    public bool $expired = false;

    public function mount(string $orderNumber): void
    {
        $this->orderNumber = trim($orderNumber);

        $this->order = Order::with(['orderItems.product'])
            ->where('order_number', $this->orderNumber)
            ->first();

        if (! $this->order) {
            abort(404, 'Pesanan tidak ditemukan.');
        }

        if ($this->order->status === 'kedaluwarsa') {
            $this->expired = true;
        }
    }

    public function confirmAndRedirect(): void
    {
        $order = Order::where('order_number', $this->orderNumber)
            ->where('status', 'menunggu_konfirmasi')
            ->first();

        if (! $order) {
            // Jika sudah terkonfirmasi sebelumnya, tetap izinkan buka WA tanpa ubah status
            $alreadyConfirmed = Order::where('order_number', $this->orderNumber)
                ->where('status', '!=', 'kedaluwarsa')
                ->first();

            if ($alreadyConfirmed && $alreadyConfirmed->status !== 'menunggu_konfirmasi') {
                $waNumber = Setting::normalizePhoneNumber(Setting::getWhatsAppNumber());
                $waMessage = $this->buildWhatsAppMessage($alreadyConfirmed);
                $waUrl = 'https://wa.me/'.$waNumber.'?text='.rawurlencode($waMessage);
                $this->js('window.open('.json_encode($waUrl).", '_blank');");

                return;
            }

            $this->expired = true;

            return;
        }

        $order->update(['status' => 'terkonfirmasi']);
        $this->order = $order->fresh(['orderItems.product']);

        $waNumber = Setting::normalizePhoneNumber(Setting::getWhatsAppNumber());
        $waMessage = $this->buildWhatsAppMessage($this->order);
        $waUrl = 'https://wa.me/'.$waNumber.'?text='.rawurlencode($waMessage);

        $this->js('window.open('.json_encode($waUrl).", '_blank');");
    }

    public function buildWhatsAppMessage(Order $order): string
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

    public function render()
    {
        return view('livewire.order-receipt');
    }
}
