<?php
// Map nama icon dari database ke SVG path (stroke) untuk dirender di icon container.
// Admin menyimpan ikon sebagai nama (printer, pen-tool, dll) atau path gambar.
$serviceIcons = [
    'printer' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
    'pen-tool' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
    'award' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485z',
    'layers' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
    'image' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
    'shopping-bag' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
    'message-circle' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
    'package' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
];

// Fallback icon jika nama icon tidak dikenal atau kosong.
$serviceIcons['default'] = 'M12 6v6m0 0v6m0-6h6m-6 0H6';
?>

<section id="services" class="relative overflow-hidden bg-light">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/3 left-0 w-[450px] h-[450px] bg-gradient-to-r from-gold/8 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-gradient-to-l from-white/50 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Very subtle dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 32px 32px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 py-20 lg:py-24 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 border border-gold/30 shadow-soft mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-navy">Layanan Kami</span>
            </span>
            <h2 class="font-heading text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight text-navy leading-[1.1]">Solusi Kreatif untuk Kebutuhan <span class="gradient-text">Bisnis Anda</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Dari kebutuhan cetak harian hingga branding korporat, kami siap mewujudkannya dengan hasil terbaik.</p>
        </div>

{{-- Service Cards Grid --}}
        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($services as $service)
            @php
                // Dukung icon sebagai nama (dari seeder) ATAU path gambar (jika admin upload).
                $iconIsImage = $service->icon && !isset($serviceIcons[$service->icon]) && (str_contains($service->icon, '/') || str_contains($service->icon, '.'));
                $iconPath = $serviceIcons[$service->icon] ?? $serviceIcons['default'];
                $delay = 100 + ($loop->index * 100);
            @endphp
            <div class="group relative rounded-[1.75rem] border border-white/70 bg-white p-8 shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-gold/40 flex flex-col overflow-hidden"
                 data-aos="fade-up" data-aos-delay="{{ $delay }}">

                {{-- Top gold accent line on hover --}}
                <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-gold to-gold-light transition-all duration-500 group-hover:w-full"></div>

                <div class="flex flex-col flex-1">
                    {{-- Icon area --}}
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gold/15 text-gold-dark transition-all duration-300 group-hover:bg-gold group-hover:text-white group-hover:scale-110 group-hover:shadow-button">
                        @if($iconIsImage)
                        <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}" class="w-7 h-7 object-contain">
                        @else
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}"/>
                        </svg>
                        @endif
                    </div>
                    <h3 class="mt-6 font-heading text-lg font-semibold text-navy">{{ $service->title }}</h3>
                    <p class="mt-2.5 text-sm font-inter leading-relaxed text-ink-soft flex-1">{{ $service->description }}</p>

                    {{-- Decorative gold detail + link to contact --}}
                    <div class="mt-6 flex items-center justify-between">
                        <span class="h-1 w-8 rounded-full bg-gold/30 transition-all duration-300 group-hover:w-12 group-hover:bg-gold"></span>
                        <a href="#contact" class="inline-flex items-center gap-2 text-sm font-heading font-semibold text-navy transition-all duration-300 group-hover:text-gold-dark group-hover:gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50 rounded-lg">
                            <span>Pelajari Layanan</span>
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-gold/10 transition-colors duration-300 group-hover:bg-gold group-hover:text-white">
                                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-sm font-inter text-ink-soft col-span-full">Belum ada layanan yang tersedia.</p>
            @endforelse
        </div>
    </div>
</section>
