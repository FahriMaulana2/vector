<?php
use App\Models\Setting;

$companyEmail = Setting::getEmail();
$companyWhatsapp = Setting::getWhatsAppNumber();
$whatsappLink = Setting::getWhatsAppLink();
$companyPhone = Setting::getPhone();
$companyAddress = Setting::getAddress();
$officeHoursRaw = Setting::getOfficeHours();

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
        ['day' => 'Minggu', 'hours' => '<span class="text-gold-dark font-semibold">Tutup</span>'],
    ];
}
?>

<section id="kontak" class="relative overflow-hidden bg-cream py-14 md:py-20 lg:py-24">
    <div id="contact" class="sr-only"></div>

    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[280px] h-[280px] md:w-[420px] md:h-[420px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-tl from-navy/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Faint dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

    <div class="mx-auto px-4 md:px-6 lg:px-8 relative z-10 max-w-7xl">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-16" data-aos="fade-up" wire:ignore.self>
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.18em] text-navy">Hubungi Kami</span>
            </span>
            <h2 class="font-heading mt-4 md:mt-5 text-2xl md:text-4xl lg:text-5xl font-bold tracking-tight text-navy leading-tight">
                Mari Wujudkan Ide Kreatif Anda <span class="gradient-text">Bersama OMH Vector</span>
            </h2>
            <p class="mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base font-inter leading-relaxed text-ink-soft">
                Tim kami siap membantu konsultasi cetak, pemilihan bahan, estimasi biaya, hingga pengiriman untuk kebutuhan bisnis Anda.
            </p>
        </div>

        {{-- Contact Info Grid --}}
        <div class="grid lg:grid-cols-12 gap-8 items-start mb-12 md:mb-16" data-aos="fade-up" wire:ignore.self>
            {{-- Left Column: 4 Contact Cards (7 cols) --}}
            <div class="lg:col-span-7 grid sm:grid-cols-2 gap-4 md:gap-5">
                {{-- Email Card --}}
                <div class="rounded-2xl border border-navy/10 bg-white p-5 md:p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gold/15 text-gold-dark">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">Email Resmi</p>
                            <h4 class="font-heading text-sm font-semibold text-navy">Kirim Penawaran</h4>
                        </div>
                    </div>
                    <a href="mailto:{{ $companyEmail }}" class="block font-inter text-sm font-medium text-navy hover:text-gold-dark transition-colors break-all">
                        {{ $companyEmail }}
                    </a>
                    <p class="text-[11px] font-inter text-ink-soft mt-1.5">Respon cepat dalam 1×24 jam kerja</p>
                </div>

                {{-- WhatsApp Card --}}
                <div class="rounded-2xl border border-navy/10 bg-white p-5 md:p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">Konsultasi Chat</p>
                            <h4 class="font-heading text-sm font-semibold text-navy">WhatsApp Customer Care</h4>
                        </div>
                    </div>
                    <a href="{{ $whatsappLink }}" target="_blank" class="block font-inter text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
                        {{ $companyWhatsapp }}
                    </a>
                    <p class="text-[11px] font-inter text-ink-soft mt-1.5">Respon instan untuk konsultasi & order</p>
                </div>

                {{-- Address Card --}}
                <div class="rounded-2xl border border-navy/10 bg-white p-5 md:p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-navy/10 text-navy">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">Lokasi Studio</p>
                            <h4 class="font-heading text-sm font-semibold text-navy">Workshop OMH</h4>
                        </div>
                    </div>
                    <p class="font-inter text-xs md:text-sm text-navy leading-relaxed">
                        {{ $companyAddress }}
                    </p>
                </div>

                {{-- Business Hours Card --}}
                <div class="rounded-2xl border border-navy/10 bg-white p-5 md:p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gold text-navy">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">Waktu Operasional</p>
                            <h4 class="font-heading text-sm font-semibold text-navy">Jam Buka Workshop</h4>
                        </div>
                    </div>
                    <div class="space-y-1.5 text-xs font-inter">
                        @foreach($businessHours as $hours)
                            <div class="flex items-center justify-between py-0.5 border-b border-navy/5 last:border-b-0">
                                <span class="text-ink-soft">{{ $hours['day'] }}</span>
                                <span class="font-medium text-navy">{!! $hours['hours'] !!}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right Column: Interactive WhatsApp & Action Banner (5 cols) --}}
            <div class="lg:col-span-5 h-full flex flex-col">
                <div class="h-full rounded-2xl md:rounded-3xl bg-gradient-to-br from-navy to-navy-deep p-6 md:p-8 text-white shadow-xl flex flex-col justify-between relative overflow-hidden border border-white/10">
                    {{-- Glow effects --}}
                    <div class="absolute -top-12 -right-12 w-48 h-48 bg-gold/15 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-navy-light/20 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1 text-[11px] font-heading font-semibold text-gold border border-gold/20">
                            Konsultasi Gratis
                        </span>
                        <h3 class="font-heading text-xl md:text-2xl font-bold leading-tight">
                            Punya Pertanyaan Spesifik Mengenai Desain atau Cetak?
                        </h3>
                        <p class="text-xs md:text-sm font-inter text-cream/70 leading-relaxed">
                            Hubungi kami melalui WhatsApp sekarang. Tim teknis dan desainer kami siap memberikan rekomendasi bahan, format file terbaik, hingga penawaran khusus untuk pesanan skala besar.
                        </p>
                    </div>

                    <div class="relative z-10 pt-6 mt-6 border-t border-white/10 space-y-4">
                        <a href="{{ $whatsappLink }}" target="_blank"
                           class="group flex items-center justify-center gap-3 w-full rounded-full bg-gold px-6 py-4 text-sm font-heading font-semibold text-navy shadow-button transition-all duration-300 hover:bg-gold-light hover:shadow-button-hover hover:-translate-y-0.5">
                            <svg class="w-5 h-5 text-navy fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Chat Langsung via WhatsApp</span>
                        </a>
                        <div class="flex items-center justify-between text-[11px] text-cream/50 px-1">
                            <span>Estimasi respon: 5-15 Menit</span>
                            <span>Konsultasi: Gratis</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Official Marketplace Section Embedded Seamlessly --}}
        <div class="pt-6">
            <livewire:marketplaces />
        </div>
    </div>
</section>
