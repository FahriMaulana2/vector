<?php
$services = [
    [
        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
        'title' => 'Digital Printing',
        'desc' => 'Cetak digital cepat untuk brosur, flyer, kartu nama, sticker, dan materi promosi dengan hasil tajam dan warna akurat.',
        'delay' => 100,
    ],
    [
        'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
        'title' => 'Graphic Design',
        'desc' => 'Jasa desain grafis profesional untuk logo, banner, konten media sosial, dan materi branding sesuai identitas merek Anda.',
        'delay' => 200,
    ],
    [
        'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485z',
        'title' => 'Branding',
        'desc' => 'Layanan branding lengkap dari desain logo, brand guideline, stationery set, hingga identitas visual yang konsisten.',
        'delay' => 300,
    ],
    [
        'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
        'title' => 'Large Format Printing',
        'desc' => 'Cetak ukuran besar untuk banner, backdrop event, billboard, dan signage outdoor dengan material tahan cuaca.',
        'delay' => 400,
    ],
    [
        'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
        'title' => 'Merchandise',
        'desc' => 'Produk merchandise custom seperti mug, kaos, tote bag, dan lainnya untuk kebutuhan campaign dan promosi brand.',
        'delay' => 500,
    ],
    [
        'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
        'title' => 'Custom Orders',
        'desc' => 'Pemesanan khusus untuk kebutuhan unik Anda. Tim kami siap berdiskusi dan merealisasikan ide cetak apapun.',
        'delay' => 600,
    ],
];
?>

<section id="services" class="relative overflow-hidden bg-[#F8FBFF]">
    {{-- Subtle blue glow background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/3 left-0 w-[450px] h-[450px] bg-gradient-to-r from-[#0B5ED7]/5 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-gradient-to-l from-[#FBBF24]/4 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Very light decorative dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B5ED7 1px, transparent 0); background-size: 32px 32px;"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 py-20 lg:py-24 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Layanan Kami</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight text-[#0B1E3D] leading-[1.1]">Solusi Cetak &amp; Branding <span class="text-[#0B5ED7]">Lengkap</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Dari kebutuhan cetak harian hingga branding korporat, kami siap mewujudkannya dengan hasil terbaik.</p>
        </div>

        {{-- 6 Service Cards Grid --}}
        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
            <div class="group relative rounded-3xl border border-slate-100 bg-white p-8 shadow-card transition-all duration-500 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-[#0B5ED7]/20 flex flex-col overflow-hidden"
                 data-aos="fade-up" data-aos-delay="{{ $service['delay'] }}">

                {{-- Top accent line on hover --}}
                <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-[#0B5ED7] to-[#F59E0B] transition-all duration-500 group-hover:w-full"></div>

                <div class="flex flex-col flex-1">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#0B5ED7]/10 text-[#0B5ED7] transition-all duration-500 group-hover:bg-[#0B5ED7] group-hover:text-white group-hover:scale-105 group-hover:shadow-button">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-[#0B1E3D]">{{ $service['title'] }}</h3>
                    <p class="mt-2.5 text-sm leading-relaxed text-slate-500 flex-1">{{ $service['desc'] }}</p>

                    {{-- Existing link to contact --}}
                    <a href="#contact" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#0B5ED7] transition-all duration-300 group-hover:text-[#0B1E3D] group-hover:gap-3">
                        <span class="inline-flex items-center gap-2">
                            Selengkapnya
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-[#0B5ED7]/10 transition-all duration-300 group-hover:bg-[#0B5ED7] group-hover:text-white">
                                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
