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

<section id="portfolio" class="relative overflow-hidden bg-white">
    {{-- Single subtle background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-[400px] h-[400px] bg-gradient-to-br from-[#0B5ED7]/3 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Portofolio</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight text-slate-950 leading-[1.1]">Featured <span class="text-[#0B5ED7]">Projects</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Setiap proyek adalah kebanggaan. Lihat hasil karya percetakan dan branding yang telah kami kerjakan untuk berbagai klien.</p>
        </div>

        {{-- Portfolio Grid --}}
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($portfolios as $item)
            <div class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card transition-all duration-500 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-[#0B5ED7]/20"
                 data-aos="fade-up"
                 data-aos-delay="{{ $item['delay'] }}">
                {{-- Image Container --}}
                <div class="relative overflow-hidden aspect-[4/3]">
                    <img src="{{ $item['img'] }}"
                         alt="{{ $item['title'] }}"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110" />

                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    {{-- Category Badge --}}
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-semibold text-slate-700 shadow-lg border border-white/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                            {{ $item['cat'] }}
                        </span>
                    </div>

                    {{-- Hover Content --}}
                    <div class="absolute inset-x-0 bottom-0 p-6 z-20 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <a href="#contact"
                           class="inline-flex items-center gap-2 rounded-full bg-white/95 backdrop-blur-sm px-5 py-2.5 text-xs font-semibold text-slate-900 transition-all duration-300 hover:bg-[#0B5ED7] hover:text-white hover:shadow-button group/btn">
                            View Project
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Card Content --}}
                <div class="p-5">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.15em] text-slate-400">{{ $item['cat'] }}</span>
                        <span class="text-[10px] font-semibold text-slate-400">{{ $item['year'] }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-950">{{ $item['title'] }}</h3>
                    <p class="mt-1 text-sm leading-relaxed text-slate-500 line-clamp-2">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-14" data-aos="fade-up">
            <div class="relative rounded-2xl bg-gradient-to-br from-slate-50 to-white border border-slate-100 p-10 lg:p-14 text-center">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-2xl lg:text-3xl font-bold text-slate-950">See More Creative Projects</h3>
                    <p class="mt-3 text-base text-slate-500 leading-relaxed">Discover hundreds of branding and printing projects completed for businesses across Indonesia.</p>
                    <div class="mt-6">
                        <a href="/portfolio"
                           class="group inline-flex items-center gap-2.5 rounded-full bg-[#0B5ED7] px-8 py-3.5 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                            <span>View Full Portfolio</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

