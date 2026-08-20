<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $service = 'Banner Printing';

    public string $message = '';

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
            'name' => 'required|string|min:2|max:100',
            'phone' => 'required|string|min:8|max:25',
            'email' => 'required|email|max:100',
            'service' => 'required|string|max:100',
            'message' => 'required|string|min:3|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap minimal 2 karakter.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.min' => 'Nomor WhatsApp minimal 8 karakter.',
            'phone.max' => 'Nomor WhatsApp maksimal 25 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'service.required' => 'Silakan pilih jenis layanan.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 3 karakter.',
            'message.max' => 'Pesan maksimal 2000 karakter.',
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        $adminWhatsapp = Setting::getWhatsAppNumber();
        $normalizedAdminPhone = Setting::normalizePhoneNumber($adminWhatsapp);

        if (! $normalizedAdminPhone) {
            $this->addError('general', 'Nomor WhatsApp admin belum dikonfigurasi di Pengaturan Website.');

            return;
        }

        // Format pesan WhatsApp sesuai spesifikasi
        $whatsappMessage = "Halo Admin OMH Vector 👋\n\n"
            ."Saya ingin menghubungi OMH Vector terkait layanan digital printing.\n\n"
            ."📋 *DATA KONTAK*\n\n"
            ."👤 *Nama:* {$validated['name']}\n"
            ."📱 *No. WhatsApp:* {$validated['phone']}\n"
            ."📧 *Email:* {$validated['email']}\n"
            ."🖨️ *Layanan:* {$validated['service']}\n\n"
            ."💬 *PESAN*\n\n"
            ."{$validated['message']}\n\n"
            ."Mohon informasi dan bantuannya.\n\n"
            .'Terima kasih 🙏';

        $whatsappUrl = "https://wa.me/{$normalizedAdminPhone}?text=".rawurlencode($whatsappMessage);

        // Reset input form
        $this->reset(['name', 'phone', 'email', 'message']);
        $this->service = 'Banner Printing';

        session()->flash('success', 'Pesan berhasil disiapkan. Membuka WhatsApp...');

        // Buka WhatsApp di tab baru secara seamless tanpa me-refresh landing page
        $this->js('window.open('.json_encode($whatsappUrl).", '_blank');");
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
