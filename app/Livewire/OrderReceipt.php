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
                $waMessage = $this->buildWhatsAppMessage($alreadyConfirmed);
                $waUrl = Setting::getWhatsAppLink($waMessage);
                $this->js('window.open('.json_encode($waUrl).", '_blank');");

                return;
            }

            $this->expired = true;

            return;
        }

        $order->update(['status' => 'terkonfirmasi']);
        $this->order = $order->fresh(['orderItems.product']);

        $waMessage = $this->buildWhatsAppMessage($this->order);
        $waUrl = Setting::getWhatsAppLink($waMessage);

        $this->js('window.open('.json_encode($waUrl).", '_blank');");
    }

    public function buildWhatsAppMessage(Order $order): string
    {
        $designStatusLabel = $order->design_file_status === 'ready'
            ? 'File Sudah Siap'
            : 'Belum Ada File / Minta Bantuan Desain';

        // --- Build line items ---
        $itemLines = '';
        foreach ($order->orderItems as $idx => $item) {
            $num = $idx + 1;
            $itemLines .= "{$num}. {$item->product_name} x{$item->qty}\n";

            // Side label + options on a compact detail line
            $details = [];
            if ($item->side_mode) {
                $details[] = $item->side_mode === '2_muka' ? '2 Muka' : '1 Muka';
            }
            if ($item->length_m && $item->width_m) {
                $details[] = "{$item->length_m}m x {$item->width_m}m";
            }
            if (! empty($item->selected_options) && is_array($item->selected_options)) {
                foreach ($item->selected_options as $o) {
                    $details[] = ($o['option_name'] ?? '');
                }
            }
            if ($details !== []) {
                $itemLines .= '   '.implode(', ', array_filter($details))."\n";
            }

            $itemLines .= '   Rp '.number_format((float) $item->line_subtotal, 0, ',', '.')."\n";
        }

        // --- Manual quote warning ---
        $manualQuoteNotice = $order->has_manual_quote_item
            ? "\nPERHATIAN: Ada item perlu konfirmasi harga tambahan\n"
            : '';

        // --- Notes ---
        $notesBlock = $order->notes
            ? "\nCatatan: {$order->notes}\n"
            : '';

        return "*PESANAN BARU - OMAH VECTOR*\n"
            ."No. Pesanan: *{$order->order_number}*\n\n"
            ."*Data Pemesan*\n"
            ."Nama: {$order->customer_name}\n"
            ."WA: {$order->customer_phone}\n"
            ."Email: {$order->customer_email}\n"
            ."Alamat: {$order->shipping_address}\n"
            ."File Desain: {$designStatusLabel}\n\n"
            ."*Rincian Pesanan*\n"
            .trim($itemLines)."\n\n"
            .'*Subtotal: Rp '.number_format((float) $order->subtotal, 0, ',', '.')."*\n"
            .$manualQuoteNotice
            .$notesBlock
            ."\nMohon dicek dan diinfokan kelanjutannya. Terima kasih!";
    }

    public function render()
    {
        return view('livewire.order-receipt');
    }
}
