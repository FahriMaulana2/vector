<?php
use App\Models\Setting;

$companyEmail = Setting::getEmail();
$companyWhatsapp = Setting::getWhatsAppNumber();
$whatsappLink = Setting::getWhatsAppLink();
$companyPhone = Setting::getPhone();
$companyAddress = Setting::getAddress();
$officeHoursRaw = Setting::getOfficeHours();

// Parse office_hours string into array if it contains explicit separator.
// Example formats:
//   "Senin - Sabtu: 08.00 - 17.00 WIB"
//   "Senin-Jumat:08:00-18:00|Sabtu:09:00-15:00"
$businessHours = [];
if ($officeHoursRaw) {
    if (str_contains($officeHoursRaw, '|')) {
        foreach (explode('|', $officeHoursRaw) as $item) {
            if (str_contains($item, ':')) {
                [$day, $hours] = array_map('trim', explode(':', $item, 2));
                $businessHours[] = ['day' => $day, 'hours' => $hours];
            }
        }
    } else {
        $businessHours[] = ['day' => 'Jam Operasional', 'hours' => $officeHoursRaw];
    }
} else {
    $businessHours = [
        ['day' => 'Senin – Jumat', 'hours' => '08:00 – 18:00'],
        ['day' => 'Sabtu', 'hours' => '09:00 – 15:00'],
        ['day' => 'Minggu', 'hours' => '<span class="text-gold">Tutup</span>'],
    ];
}
?>

<section id="contact" class="relative overflow-hidden bg-cream py-12 md:py-20 lg:py-28">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[280px] h-[280px] md:w-[420px] md:h-[420px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-tl from-navy/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Very faint navy dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

    <div class="mx-auto px-4 md:px-6 lg:px-8 relative z-10 md:max-w-7xl">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up" wire:ignore.self>
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 md:px-4 md:py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1 h-1 md:w-1.5 md:h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.15em] md:tracking-[0.22em] text-navy">Hubungi Kami</span>
            </span>
            <h2 class="font-heading mt-4 md:mt-6 text-xl md:text-3xl lg:text-4xl xl:text-5xl font-bold tracking-tight text-navy leading-tight md:leading-[1.12]">Mari Wujudkan Ide Kreatif Anda <span class="gradient-text">Bersama OMH Vector</span></h2>
            <p class="mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Tim kami siap membantu konsultasi, pemilihan bahan, desain, hingga pengiriman untuk kebutuhan cetak dan branding bisnis Anda.</p>
        </div>

        <div class="mt-8 md:mt-14 grid gap-6 md:gap-10 lg:grid-cols-[1fr_1.1fr] lg:items-stretch">
            {{-- Left: Premium Navy Contact Panel --}}
            <div class="relative overflow-hidden rounded-lg md:rounded-[1.75rem] bg-gradient-to-br from-navy-dark via-navy to-navy-deep p-4 md:p-8 lg:p-10 text-cream border border-gold/20 shadow-card-hover" data-aos="fade-right" wire:ignore.self>
                {{-- Panel decorations --}}
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-[-60px] right-[-40px] w-[220px] h-[220px] md:w-[280px] md:h-[280px] rounded-full bg-gold/15 blur-3xl"></div>
                    <div class="hidden md:block absolute bottom-[-60px] left-[-60px] w-[240px] h-[240px] rounded-full bg-navy-deep/40 blur-3xl"></div>
                </div>
                <div class="absolute top-0 left-0 h-px w-full bg-gradient-to-r from-transparent via-gold/40 to-transparent"></div>
                <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
                     style="background-image: radial-gradient(circle at 1px 1px, #ffffff 1px, transparent 0); background-size: 32px 32px;"></div>

                <div class="relative flex flex-col h-full">
                    <div class="space-y-3 md:space-y-4">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/[0.06] px-3 py-1.5 md:px-4 md:py-1.5 border border-gold/20">
                            <span class="w-1 h-1 md:w-1.5 md:h-1.5 rounded-full bg-gold"></span>
                            <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.12em] md:tracking-[0.22em] text-gold">Kontak Kami</span>
                        </span>
                        <h3 class="font-heading text-lg md:text-2xl lg:text-3xl font-bold text-cream leading-tight">Hubungi Kami untuk Solusi Terbaik</h3>
                        <p class="text-xs md:text-sm font-inter leading-relaxed text-cream/60">Tim kami siap membantu kebutuhan cetak dan branding Anda.</p>
                    </div>

                    {{-- Contact info list (all existing data preserved) --}}
                    <div class="mt-6 md:mt-8 space-y-3 md:space-y-4">
                        {{-- Email Card --}}
                        <div class="flex items-start gap-3 md:gap-4 rounded-lg md:rounded-2xl border border-gold/15 bg-white/[0.04] p-3 md:p-4 transition-all duration-300 hover:bg-white/[0.08] hover:border-gold/30">
                            <div class="flex h-9 w-9 md:h-11 md:w-11 shrink-0 items-center justify-center rounded-lg md:rounded-xl bg-gold/20 text-gold">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-wider text-cream/40">Email</p>
                                <a href="mailto:{{ $companyEmail }}" class="mt-0.5 block font-heading text-xs md:font-semibold md:text-sm text-cream transition-colors duration-200 hover:text-gold">{{ $companyEmail }}</a>
                                <p class="text-[10px] font-inter text-cream/40 mt-0.5">Kami akan merespon dalam 1×24 jam</p>
                            </div>
                        </div>

                        {{-- WhatsApp Card --}}
                        <div class="flex items-start gap-3 md:gap-4 rounded-lg md:rounded-2xl border border-gold/15 bg-white/[0.04] p-3 md:p-4 transition-all duration-300 hover:bg-white/[0.08] hover:border-gold/30">
                            <div class="flex h-9 w-9 md:h-11 md:w-11 shrink-0 items-center justify-center rounded-lg md:rounded-xl bg-gold/20 text-gold">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-gold" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <div>
                                <p class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-wider text-cream/40">WhatsApp</p>
                                <a href="{{ $whatsappLink }}" target="_blank" class="mt-0.5 block font-heading text-xs md:font-semibold md:text-sm text-cream transition-colors duration-200 hover:text-gold">{{ $companyWhatsapp }}</a>
                                <p class="text-[10px] font-inter text-cream/40 mt-0.5">Respons cepat via chat</p>
                            </div>
                        </div>

                        {{-- Address Card --}}
                        <div class="flex items-start gap-3 md:gap-4 rounded-lg md:rounded-2xl border border-gold/15 bg-white/[0.04] p-3 md:p-4 transition-all duration-300 hover:bg-white/[0.08] hover:border-gold/30">
                            <div class="flex h-9 w-9 md:h-11 md:w-11 shrink-0 items-center justify-center rounded-lg md:rounded-xl bg-gold/20 text-gold">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-wider text-cream/40">Alamat</p>
                                <p class="mt-0.5 font-heading text-xs md:font-semibold md:text-sm text-cream">{{ $companyAddress }}</p>
                            </div>
                        </div>

                        {{-- Business Hours Card --}}
                        <div class="flex items-start gap-3 md:gap-4 rounded-lg md:rounded-2xl border border-gold/15 bg-white/[0.04] p-3 md:p-4 transition-all duration-300 hover:bg-white/[0.08] hover:border-gold/30">
                            <div class="flex h-9 w-9 md:h-11 md:w-11 shrink-0 items-center justify-center rounded-lg md:rounded-xl bg-gold text-navy">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-wider text-cream/40">Jam Operasional</p>
                                <div class="mt-2 space-y-1 md:space-y-2">
                                    @foreach($businessHours as $hours)
                                    <div class="flex items-center justify-between text-[10px] md:text-sm font-inter">
                                        <span class="text-cream/60">{{ $hours['day'] }}</span>
                                        <span class="font-medium text-cream">{!! $hours['hours'] !!}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Maps Placeholder (preserved) --}}
                    <div class="mt-4 md:mt-6 rounded-lg md:rounded-2xl overflow-hidden border border-gold/15 shadow-soft">
                        <div class="bg-navy-deep/60 h-[120px] md:h-[160px] flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-6 h-6 md:w-9 md:h-9 mx-auto text-gold/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                                </svg>
                                <p class="mt-1 md:mt-2 text-[10px] md:text-sm font-heading text-cream/60 font-medium">Google Maps</p>
                                <p class="text-[8px] md:text-xs font-inter text-cream/40">{{ $companyAddress }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Large WhatsApp CTA (preserved) --}}
                    <div class="mt-4 md:mt-6">
                        <a href="{{ $whatsappLink }}" target="_blank"
                           class="group flex items-center justify-center gap-2 md:gap-3 rounded-full bg-gold px-4 md:px-8 py-3 md:py-4 text-xs md:text-sm font-heading font-semibold text-navy shadow-button transition-all duration-300 hover:bg-gold-light hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-navy" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span>Chat via WhatsApp</span>
                            <svg class="w-3 h-3 md:w-4 md:h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right: Premium Warm-White Contact Form --}}
            <div class="rounded-lg md:rounded-[1.75rem] border border-gold/20 bg-white p-4 md:p-8 lg:p-10 shadow-card transition-all duration-300 hover:shadow-card-hover flex flex-col" data-aos="fade-left" wire:ignore.self>
                <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-6">
                    <div class="flex h-8 w-8 md:h-10 md:w-10 items-center justify-center rounded-lg md:rounded-xl bg-gold/15 text-navy shrink-0">
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.12em] md:tracking-[0.2em] text-gold-dark">Form Pemesanan</p>
                        <h3 class="font-heading text-sm md:text-xl font-bold text-navy">Konfirmasi Pesanan Anda</h3>
                        <p class="text-[10px] md:text-sm font-inter text-ink-soft">Lengkapi data untuk terhubung langsung ke WhatsApp Admin</p>
                    </div>
                </div>

                <form wire:submit="submit" class="space-y-4 md:space-y-5 flex-1">
                    @error('general')
                    <div class="rounded-lg md:rounded-xl border border-red-400/30 bg-red-50 p-3 text-[10px] md:text-xs font-inter text-red-600">
                        {{ $message }}
                    </div>
                    @enderror

                    @error('cart')
                    <div class="rounded-lg md:rounded-xl border border-red-400/30 bg-red-50 p-3 text-[10px] md:text-xs font-inter text-red-600">
                        {{ $message }}
                    </div>
                    @enderror

                    @if (session()->has('success'))
                    <div class="rounded-lg md:rounded-xl border border-gold/40 bg-gold/10 p-3 text-[10px] md:text-xs font-inter text-navy font-medium">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- 1. Cart Items Summary --}}
                    <div class="rounded-xl md:rounded-2xl border border-slate-200 bg-slate-50/70 p-3.5 md:p-5">
                        <div class="flex items-center justify-between mb-3 border-b border-slate-200/80 pb-2.5">
                            <span class="font-heading text-xs md:text-sm font-bold text-navy uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Rincian Keranjang Pesanan
                            </span>
                            <span class="rounded-full bg-navy/10 px-2.5 py-0.5 text-[10px] font-semibold text-navy">
                                {{ $cartCount }} Item
                            </span>
                        </div>

                        @if(empty($cartItems))
                            <div class="py-6 text-center space-y-3">
                                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/70 text-slate-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-slate-700">Keranjang pesanan masih kosong</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Pilih produk dari katalog untuk mulai memesan</p>
                                </div>
                                <a href="#products"
                                   class="inline-flex items-center gap-1.5 rounded-full border border-gold bg-white px-4 py-2 text-[11px] font-heading font-semibold text-navy hover:bg-cream transition-colors shadow-sm">
                                    <span>Pilih Produk dari Katalog</span>
                                    <svg class="w-3 h-3 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </a>
                            </div>
                        @else
                            <div class="divide-y divide-slate-200/80 space-y-3">
                                @foreach($cartItems as $uuid => $item)
                                <div class="pt-3 first:pt-0 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                                    <div class="space-y-1 flex-1">
                                        <div class="flex items-center gap-2">
                                            <h4 class="font-heading text-xs sm:text-sm font-bold text-navy">{{ $item['product_name'] ?? 'Produk' }}</h4>
                                            <span class="rounded bg-slate-200/80 px-1.5 py-0.5 text-[10px] font-semibold text-slate-700">x{{ $item['qty'] }}</span>
                                        </div>

                                        {{-- Spesifikasi & Opsi Ringkas --}}
                                        <div class="flex flex-wrap gap-1.5 text-[10px] text-slate-600">
                                            @if(!empty($item['side_mode']))
                                                <span class="rounded bg-white border border-slate-200 px-1.5 py-0.5">
                                                    {{ $item['side_mode'] === '2_muka' ? '2 Sisi (Bolak-balik)' : '1 Sisi' }}
                                                </span>
                                            @endif
                                            @if(!empty($item['length_m']) && !empty($item['width_m']))
                                                <span class="rounded bg-white border border-slate-200 px-1.5 py-0.5">
                                                    {{ $item['length_m'] }}m x {{ $item['width_m'] }}m
                                                </span>
                                            @endif
                                            @if(!empty($item['selected_options']) && is_array($item['selected_options']))
                                                @foreach($item['selected_options'] as $opt)
                                                    <span class="rounded bg-white border border-slate-200 px-1.5 py-0.5">
                                                        {{ $opt['group_name'] ?? '' }}: {{ $opt['option_name'] ?? '' }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>

                                        @if(!empty($item['manual_quote_flag']))
                                            <p class="text-[10px] text-amber-700 font-medium flex items-center gap-1">
                                                <span>* {{ $item['manual_quote_note'] ?: 'Perlu konfirmasi harga admin' }}</span>
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Subtotal & Tombol Aksi --}}
                                    <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 shrink-0">
                                        <span class="font-heading text-xs sm:text-sm font-bold text-navy">
                                            Rp {{ number_format((float)($item['line_subtotal'] ?? 0), 0, ',', '.') }}
                                        </span>
                                        <div class="flex items-center gap-2">
                                            <button type="button"
                                                    wire:click.prevent="$dispatch('open-configurator', { productId: {{ $item['product_id'] }}, cartItemUuid: '{{ $uuid }}' })"
                                                    class="text-[11px] font-medium text-navy hover:text-gold transition-colors underline cursor-pointer">
                                                Ubah
                                            </button>
                                            <span class="text-slate-300">|</span>
                                            <button type="button"
                                                    wire:click.prevent="removeItem('{{ $uuid }}')"
                                                    class="text-[11px] font-medium text-red-500 hover:text-red-700 transition-colors underline cursor-pointer">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- Subtotal Card --}}
                            <div class="mt-4 pt-3 border-t border-slate-200/80 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="font-heading text-xs sm:text-sm font-bold text-navy uppercase tracking-wider">Subtotal:</span>
                                    <span class="font-heading text-sm sm:text-base font-bold text-navy">
                                        Rp {{ number_format((float)$cartSubtotal, 0, ',', '.') }}
                                    </span>
                                </div>
                                @if($hasManualQuote)
                                    <div class="rounded-lg bg-amber-50 border border-amber-200 p-2 text-[11px] text-amber-800">
                                        Beberapa item perlu konfirmasi harga tambahan dari admin, akan diinfokan via WhatsApp.
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- 2. Data Pemesan (Disabled jika cart kosong) --}}
                    <div class="@if(empty($cartItems)) opacity-50 pointer-events-none @endif space-y-4 md:space-y-5">
                        {{-- Name + Phone Row --}}
                        <div class="grid gap-3 md:gap-5 sm:grid-cols-2">
                            <div>
                                <label for="contact-name" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Nama Lengkap</label>
                                <input id="contact-name" type="text" wire:model="name" placeholder="Masukkan nama Anda"
                                       @disabled(empty($cartItems))
                                       class="w-full rounded-lg md:rounded-xl border @error('name') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3.5 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40" />
                                @error('name')
                                <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="contact-phone" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">No. WhatsApp</label>
                                <input id="contact-phone" type="tel" wire:model="phone" placeholder="+62 812-xxxx-xxxx"
                                       @disabled(empty($cartItems))
                                       class="w-full rounded-lg md:rounded-xl border @error('phone') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3.5 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40" />
                                @error('phone')
                                <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="contact-email" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Email</label>
                            <input id="contact-email" type="email" wire:model="email" placeholder="contoh@email.com"
                                   @disabled(empty($cartItems))
                                   class="w-full rounded-lg md:rounded-xl border @error('email') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3.5 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40" />
                            @error('email')
                            <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Alamat Pengiriman --}}
                        <div>
                            <label for="contact-shipping" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Alamat Lengkap Pengiriman</label>
                            <textarea id="contact-shipping" rows="2" wire:model="shipping_address" placeholder="Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos..."
                                      @disabled(empty($cartItems))
                                      class="w-full rounded-lg md:rounded-xl border @error('shipping_address') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40 resize-none"></textarea>
                            @error('shipping_address')
                            <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Status File Desain --}}
                        <div>
                            <label class="block text-xs md:text-sm font-heading font-semibold text-navy mb-2">Status File Desain</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <label class="flex items-center gap-2.5 rounded-lg md:rounded-xl border @if($design_file_status === 'ready') border-gold bg-white shadow-sm ring-1 ring-gold @else border-gold/25 bg-cream @endif p-2.5 sm:p-3 cursor-pointer transition-all hover:bg-white">
                                    <input type="radio" wire:model.live="design_file_status" value="ready" class="h-3.5 w-3.5 accent-gold" @disabled(empty($cartItems))>
                                    <div>
                                        <span class="block text-xs font-semibold text-navy">File Sudah Siap</span>
                                        <span class="block text-[10px] text-ink-soft">File siap cetak (PDF/TIFF/CDR)</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2.5 rounded-lg md:rounded-xl border @if($design_file_status === 'need_design_help') border-gold bg-white shadow-sm ring-1 ring-gold @else border-gold/25 bg-cream @endif p-2.5 sm:p-3 cursor-pointer transition-all hover:bg-white">
                                    <input type="radio" wire:model.live="design_file_status" value="need_design_help" class="h-3.5 w-3.5 accent-gold" @disabled(empty($cartItems))>
                                    <div>
                                        <span class="block text-xs font-semibold text-navy">Belum Ada File</span>
                                        <span class="block text-[10px] text-ink-soft">Minta bantuan desain tim OMAH Vector</span>
                                    </div>
                                </label>
                            </div>
                            @error('design_file_status')
                            <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Catatan Tambahan --}}
                        <div>
                            <label for="contact-notes" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Catatan Tambahan (Opsional)</label>
                            <textarea id="contact-notes" rows="2" wire:model="notes" placeholder="Catatan khusus mengenai pesanan, finishing, atau instruksi pengiriman..."
                                      @disabled(empty($cartItems))
                                      class="w-full rounded-lg md:rounded-xl border border-gold/25 bg-cream px-3 md:px-4 py-2.5 md:py-3 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40 resize-none"></textarea>
                            @error('notes')
                            <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            wire:loading.attr="disabled"
                            @disabled(empty($cartItems) || $isSubmitting)
                            class="group relative w-full rounded-full bg-navy px-4 md:px-6 py-3 md:py-4 text-xs md:text-sm font-heading font-semibold text-cream shadow-button transition-all duration-300 hover:bg-navy-deep hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-50 disabled:cursor-not-allowed overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-1.5 md:gap-2">
                            <span wire:loading.remove>Kirim Pesan & Checkout WhatsApp</span>
                            <span wire:loading>Memproses Pesanan...</span>
                            <svg class="w-3 h-3 md:w-4 md:h-4 text-gold transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-gold/15 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    </button>

                    <p class="text-center text-[10px] md:text-xs font-inter text-ink-soft">Data pesanan Anda aman dan langsung terhubung dengan layanan admin resmi OMAH Vector.</p>
                </form>
            </div>
        </div>
    </div>
</section>
