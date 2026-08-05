<?php
$portfolios = [
    [
        'img' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Branding',
        'title' => 'Cafe Branding Identity',
        'desc' => 'Complete visual identity for a local coffee shop — logo, menu, signage, and packaging.',
        'year' => '2025',
        'delay' => 100,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Branding',
        'title' => 'Restaurant Menu Design',
        'desc' => 'Premium menu book with embossed cover and foil-stamped typography.',
        'year' => '2025',
        'delay' => 200,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Invitation',
        'title' => 'Wedding Invitation Suite',
        'desc' => 'Elegant invitation set with laser-cut details, calligraphy, and custom envelope.',
        'year' => '2024',
        'delay' => 300,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1612449091860-4540ab0aeb94?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Packaging',
        'title' => 'Product Packaging Design',
        'desc' => 'Custom packaging box with spot UV, embossed logo, and premium cardstock.',
        'year' => '2025',
        'delay' => 400,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1586075010923-2dd4570fb338?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Printing',
        'title' => 'Company Profile Book',
        'desc' => 'Corporate profile book for a tech startup with perfect binding and full-color print.',
        'year' => '2024',
        'delay' => 500,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1621544402532-78c290378588?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Signage',
        'title' => 'Acrylic Sign Installation',
        'desc' => 'Custom acrylic signage with LED backlighting for a boutique storefront.',
        'year' => '2025',
        'delay' => 600,
    ],
];
?>

<section id="portfolio" class="relative overflow-hidden bg-[#F8FAFC]">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-[420px] h-[420px] bg-gradient-to-br from-[#0B5ED7]/6 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[380px] h-[380px] bg-gradient-to-l from-[#FBBF24]/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Very light geometric dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B5ED7 1px, transparent 0); background-size: 36px 36px;"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 py-20 lg:py-24 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white border border-[#0B5ED7]/10 px-4 py-1.5 mb-6 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Portofolio Kami</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight text-[#0B1E3D] leading-[1.1]">Featured <span class="text-[#0B5ED7]">Projects</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Setiap proyek adalah kebanggaan. Lihat hasil karya percetakan dan branding yang telah kami kerjakan untuk berbagai klien.</p>
        </div>

        {{-- Editorial Mosaic Grid --}}
        <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-[280px] sm:auto-rows-[300px]">
            @foreach($portfolios as $index => $item)
            @php $isFeatured = $index === 0; @endphp
            <div class="group relative {{ $isFeatured ? 'sm:col-span-2 sm:row-span-2' : '' }} overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-card transition-all duration-500 hover:shadow-card-hover hover:border-[#0B5ED7]/20"
                 data-aos="fade-up"
                 data-aos-delay="{{ $item['delay'] }}"
                 @if($isFeatured) data-aos-duration="700" @endif>

                {{-- Image --}}
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ $item['img'] }}"
                         alt="{{ $item['title'] }}"
                         class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105" />
                </div>

                {{-- Dark navy gradient overlay for readability --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#0B1E3D]/90 via-[#0B1E3D]/25 to-transparent transition-opacity duration-500"></div>

                {{-- Category badge (top-left) --}}
                <div class="absolute top-4 left-4 z-10">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-bold text-[#0B1E3D] shadow-lg border border-white/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B]"></span>
                        {{ $item['cat'] }}
                    </span>
                </div>

                {{-- Year (top-right) --}}
                @if($item['year'])
                <div class="absolute top-4 right-4 z-10">
                    <span class="inline-flex items-center rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-bold text-[#0B5ED7] shadow-lg border border-white/30">
                        {{ $item['year'] }}
                    </span>
                </div>
                @endif

                {{-- Info overlay (bottom) --}}
                <div class="absolute inset-x-0 bottom-0 p-6 z-20">
                    <div class="translate-y-1 transition-transform duration-500 group-hover:translate-y-0">
                        <h3 class="text-lg {{ $isFeatured ? 'lg:text-2xl' : '' }} font-bold text-white">{{ $item['title'] }}</h3>
                        <p class="mt-1.5 text-xs sm:text-sm text-white/70 leading-relaxed line-clamp-2 {{ $isFeatured ? 'hidden sm:block' : '' }}">{{ $item['desc'] }}</p>
                    </div>

                    {{-- View project link (preserved destination #contact) --}}
                    <div class="mt-3 flex items-center gap-2 opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                        <a href="#contact"
                           class="inline-flex items-center gap-2 rounded-full bg-white text-[#0B1E3D] px-4 py-2 text-xs font-semibold transition-all duration-300 hover:bg-[#FBBF24] hover:shadow-lg">
                            Lihat Proyek
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-14" data-aos="fade-up">
            <div class="relative rounded-3xl bg-white border border-slate-100 p-10 lg:p-14 text-center shadow-card overflow-hidden">
                <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-[#0B5ED7] via-[#FBBF24] to-[#0B5ED7] opacity-70"></div>
                <div class="max-w-xl mx-auto">
                    <h3 class="text-2xl lg:text-3xl font-bold text-[#0B1E3D]">See More Creative Projects</h3>
                    <p class="mt-3 text-base text-slate-500 leading-relaxed">Discover hundreds of branding and printing projects completed for businesses across Indonesia.</p>
                    <div class="mt-6">
                        <a href="/portfolio"
                           class="group inline-flex items-center gap-2.5 rounded-full border-2 border-[#0B1E3D] px-8 py-3.5 text-sm font-semibold text-[#0B1E3D] transition-all duration-300 hover:bg-[#0B1E3D] hover:text-white hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                            <svg class="w-4 h-4 text-[#F59E0B] transition-transform duration-300 group-hover:rotate-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>View Full Portfolio</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
