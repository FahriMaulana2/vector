<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Attributes\On;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $service = 'Banner Printing';

    public string $message = '';

    public function mount(): void
    {
        if ($productSlug = request()->query('product')) {
            $product = Product::where('slug', $productSlug)->first();
            if ($product) {
                $this->service = Product::resolveServiceForContact($product->name);
                $this->message = 'Halo, saya tertarik untuk memesan produk '.$product->name.'. Mohon informasi lebih lanjut.';

                $this->js("setTimeout(() => { document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 350);");
            }
        }
    }

    public array $servicesList = [
        'Banner Printing',
        'Sticker Printing',
        'Wedding Invitation',
        'Business Card',
        'Custom Tumbler',
        'Merchandise',
        'Graphic Design',
        'Lainnya',
    ];

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:8|max:30',
            'email' => 'required|email|max:255',
            'service' => 'required|string|max:255',
            'message' => 'required|string|min:3|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap minimal 2 karakter.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.min' => 'Nomor WhatsApp minimal 8 karakter.',
            'phone.max' => 'Nomor WhatsApp maksimal 30 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'service.required' => 'Silakan pilih jenis layanan.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 3 karakter.',
            'message.max' => 'Pesan maksimal 5000 karakter.',
        ];
    }

    #[On('product-selected')]
    public function handleProductSelected(string $productName): void
    {
        $this->setProductService($productName);
    }

    public function setProductService(string $productName): void
    {
        $this->service = Product::resolveServiceForContact($productName);

        $this->js("document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth', block: 'start' });");
    }

    public function submit(): void
    {
        $validated = $this->validate();

        // 1. Save contact submission to existing Order system
        Order::create([
            'customer_name' => $validated['name'],
            'customer_phone' => $validated['phone'],
            'customer_email' => $validated['email'],
            'product_id' => null,
            'quantity' => 1,
            'notes' => "Layanan: {$validated['service']}\n\n{$validated['message']}",
            'status' => 'pending',
        ]);

        // 2. Get admin WhatsApp number from Website Settings
        $adminWhatsapp = Setting::getWhatsAppNumber();
        $normalizedAdminPhone = Setting::normalizePhoneNumber($adminWhatsapp);

        if (! $normalizedAdminPhone) {
            $this->addError('general', 'Nomor WhatsApp admin belum dikonfigurasi di Pengaturan Website.');

            return;
        }

        // 3. Format pesan WhatsApp sesuai spesifikasi
        $separator = "\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81\xE2\x94\x81";

        $whatsappMessage = "Halo Admin OMAH Vector \xF0\x9F\x91\x8B\n\n"
            ."Saya ingin menghubungi OMAH Vector terkait layanan digital printing.\n\n"
            ."{$separator}\n"
            ."\xF0\x9F\x93\x8B DATA KONTAK\n"
            ."{$separator}\n\n"
            ."\xF0\x9F\x91\xA4 Nama:\n{$validated['name']}\n\n"
            ."\xF0\x9F\x93\xB1 No. WhatsApp:\n{$validated['phone']}\n\n"
            ."\xF0\x9F\x93\xA7 Email:\n{$validated['email']}\n\n"
            ."\xF0\x9F\x96\xA8\xEF\xB8\x8F Layanan:\n{$validated['service']}\n\n"
            ."{$separator}\n"
            ."\xF0\x9F\x92\xAC PESAN\n"
            ."{$separator}\n\n"
            ."{$validated['message']}\n\n"
            ."{$separator}\n\n"
            ."Mohon informasi dan bantuannya.\n\n"
            .'Terima kasih.';

        $whatsappUrl = "https://wa.me/{$normalizedAdminPhone}?text=".rawurlencode($whatsappMessage);

        // 4. Reset input form
        $this->reset(['name', 'phone', 'email', 'message']);
        $this->service = 'Banner Printing';

        session()->flash('success', 'Pesan berhasil dikirim! Membuka WhatsApp...');

        // 5. Buka WhatsApp di tab baru secara seamless tanpa me-refresh landing page
        $this->js('window.open('.json_encode($whatsappUrl).", '_blank');");
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
