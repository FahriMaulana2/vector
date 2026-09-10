<?php
use App\Models\Marketplace;
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

$hasMarketplaces = Marketplace::exists();
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
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-14" data-aos="fade-up" wire:ignore.self>
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.18em] text-navy">Hubungi Kami & Official Store</span>
            </span>
            <h2 class="font-heading mt-4 md:mt-5 text-2xl md:text-4xl lg:text-5xl font-bold tracking-tight text-navy leading-tight">
                Mari Wujudkan Ide Kreatif <span class="gradient-text">Bersama OMH Vector</span>
            </h2>
            <p class="mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base font-inter leading-relaxed text-ink-soft">
                Konsultasikan kebutuhan cetak langsung bersama tim kami atau pesan produk dengan mudah melalui official marketplace store pilihan Anda.
            </p>
        </div>

        {{-- Contact + Marketplace Cohesive Grid --}}
        @if($hasMarketplaces)
            <div class="grid lg:grid-cols-12 gap-8 items-stretch" data-aos="fade-up" wire:ignore.self>
                {{-- Left Column: Contact Section (Desktop: Kiri, Mobile: Atas) --}}
                <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
                    {{-- Contact Info Cards Grid --}}
                    <div class="grid sm:grid-cols-2 gap-4">
                        {{-- WhatsApp Card --}}
                        <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">WhatsApp</p>
                                        <h4 class="font-heading text-sm font-semibold text-navy">Customer Care</h4>
                                    </div>
                                </div>
                                <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" class="block font-inter text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
                                    {{ $companyWhatsapp ?: '-' }}
                                </a>
                            </div>
                            <p class="text-[11px] font-inter text-ink-soft mt-3">Respon instan konsultasi cetak & pemesanan</p>
                        </div>

                        {{-- Email Card --}}
                        <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gold/15 text-gold-dark">
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
                                    {{ $companyEmail ?: '-' }}
                                </a>
                            </div>
                            <p class="text-[11px] font-inter text-ink-soft mt-3">Respon cepat dalam 1×24 jam kerja</p>
                        </div>

                        {{-- Address Card --}}
                        <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-navy/10 text-navy">
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
                                <p class="font-inter text-xs text-navy leading-relaxed">
                                    {{ $companyAddress ?: '-' }}
                                </p>
                            </div>
                            @if($companyPhone)
                                <p class="text-[11px] font-inter text-ink-soft mt-2">Telp: {{ $companyPhone }}</p>
                            @endif
                        </div>

                        {{-- Business Hours Card --}}
                        <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gold text-navy">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">Jam Operasional</p>
                                        <h4 class="font-heading text-sm font-semibold text-navy">Buka Workshop</h4>
                                    </div>
                                </div>
                                <div class="space-y-1 text-xs font-inter">
                                    @foreach($businessHours as $hours)
                                        <div class="flex items-center justify-between py-0.5 border-b border-navy/5 last:border-b-0">
                                            <span class="text-ink-soft">{{ $hours['day'] }}</span>
                                            <span class="font-medium text-navy">{!! $hours['hours'] !!}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Direct WhatsApp Consultation Banner --}}
                    <div class="rounded-2xl bg-gradient-to-br from-navy to-navy-deep p-6 text-white shadow-card relative overflow-hidden border border-white/10">
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-0.5 text-[10px] font-heading font-semibold text-gold border border-gold/20">
                                    Konsultasi Cepat
                                </span>
                                <span class="text-[11px] text-cream/60">Respon 5-15 Menit</span>
                            </div>
                            <h3 class="font-heading text-base md:text-lg font-bold leading-snug">
                                Butuh Rekomendasi Cetak atau Desain Custom?
                            </h3>
                            <p class="text-xs font-inter text-cream/80 leading-relaxed">
                                Hubungi kami langsung via WhatsApp untuk rekomendasi material terbaik, pengecekan format desain, dan penawaran biaya instan.
                            </p>
                            <div class="pt-2">
                                <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center justify-center gap-2.5 w-full rounded-xl bg-gold px-5 py-3 text-xs md:text-sm font-heading font-semibold text-navy shadow-button transition-all duration-300 hover:bg-gold-light hover:shadow-button-hover hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 text-navy fill-current" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    <span>Chat Langsung via WhatsApp</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Marketplace Section (Desktop: Kanan, Mobile: Bawah) --}}
                <div class="lg:col-span-6 min-w-0 flex flex-col justify-between">
                    <livewire:marketplaces />
                </div>
            </div>
        @else
            {{-- When no marketplaces exist, center contact section --}}
            <div class="max-w-4xl mx-auto space-y-6" data-aos="fade-up" wire:ignore.self>
                <div class="grid sm:grid-cols-2 gap-4">
                    {{-- WhatsApp Card --}}
                    <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">WhatsApp</p>
                                    <h4 class="font-heading text-sm font-semibold text-navy">Customer Care</h4>
                                </div>
                            </div>
                            <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" class="block font-inter text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
                                {{ $companyWhatsapp ?: '-' }}
                            </a>
                        </div>
                        <p class="text-[11px] font-inter text-ink-soft mt-3">Respon instan konsultasi cetak & pemesanan</p>
                    </div>

                    {{-- Email Card --}}
                    <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gold/15 text-gold-dark">
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
                                {{ $companyEmail ?: '-' }}
                            </a>
                        </div>
                        <p class="text-[11px] font-inter text-ink-soft mt-3">Respon cepat dalam 1×24 jam kerja</p>
                    </div>

                    {{-- Address Card --}}
                    <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-navy/10 text-navy">
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
                            <p class="font-inter text-xs text-navy leading-relaxed">
                                {{ $companyAddress ?: '-' }}
                            </p>
                        </div>
                        @if($companyPhone)
                            <p class="text-[11px] font-inter text-ink-soft mt-2">Telp: {{ $companyPhone }}</p>
                        @endif
                    </div>

                    {{-- Business Hours Card --}}
                    <div class="rounded-2xl border border-navy/10 bg-white p-5 shadow-card transition-all duration-300 hover:shadow-card-hover hover:border-gold/40 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gold text-navy">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-heading text-[10px] uppercase font-bold tracking-wider text-ink-soft">Jam Operasional</p>
                                    <h4 class="font-heading text-sm font-semibold text-navy">Buka Workshop</h4>
                                </div>
                            </div>
                            <div class="space-y-1 text-xs font-inter">
                                @foreach($businessHours as $hours)
                                    <div class="flex items-center justify-between py-0.5 border-b border-navy/5 last:border-b-0">
                                        <span class="text-ink-soft">{{ $hours['day'] }}</span>
                                        <span class="font-medium text-navy">{!! $hours['hours'] !!}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Direct WhatsApp Consultation Banner --}}
                <div class="rounded-2xl bg-gradient-to-br from-navy to-navy-deep p-6 text-white shadow-card relative overflow-hidden border border-white/10">
                    <div class="relative z-10 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-0.5 text-[10px] font-heading font-semibold text-gold border border-gold/20">
                                Konsultasi Cepat
                            </span>
                            <span class="text-[11px] text-cream/60">Respon 5-15 Menit</span>
                        </div>
                        <h3 class="font-heading text-base md:text-lg font-bold leading-snug">
                            Butuh Rekomendasi Cetak atau Desain Custom?
                        </h3>
                        <p class="text-xs font-inter text-cream/80 leading-relaxed">
                            Hubungi kami langsung via WhatsApp untuk rekomendasi material terbaik, pengecekan format desain, dan penawaran biaya instan.
                        </p>
                        <div class="pt-2">
                            <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2.5 w-full rounded-xl bg-gold px-5 py-3 text-xs md:text-sm font-heading font-semibold text-navy shadow-button transition-all duration-300 hover:bg-gold-light hover:shadow-button-hover hover:-translate-y-0.5">
                                <svg class="w-4 h-4 text-navy fill-current" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                <span>Chat Langsung via WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
