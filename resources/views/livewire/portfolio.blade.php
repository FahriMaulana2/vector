<?php
$portfolios = [
    [
        'img' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Branding',
        'title' => 'Cafe Branding Identity',
        'desc' => 'Complete visual identity for a local coffee shop — logo, menu, signage, and packaging.',
        'year' => '2025',
        'filter' => 'branding',
        'delay' => 100,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Branding',
        'title' => 'Restaurant Menu Design',
        'desc' => 'Premium menu book with embossed cover and foil-stamped typography.',
        'year' => '2025',
        'filter' => 'branding',
        'delay' => 200,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Invitation',
        'title' => 'Wedding Invitation Suite',
        'desc' => 'Elegant invitation set with laser-cut details, calligraphy, and custom envelope.',
        'year' => '2024',
        'filter' => 'invitation',
        'delay' => 300,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1612449091860-4540ab0aeb94?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Packaging',
        'title' => 'Product Packaging Design',
        'desc' => 'Custom packaging box with spot UV, embossed logo, and premium cardstock.',
        'year' => '2025',
        'filter' => 'packaging',
        'delay' => 400,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1586075010923-2dd4570fb338?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Printing',
        'title' => 'Company Profile Book',
        'desc' => 'Corporate profile book for a tech startup with perfect binding and full-color print.',
        'year' => '2024',
        'filter' => 'printing',
        'delay' => 500,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Printing',
        'title' => 'Event Backdrop Banner',
        'desc' => 'Large-format event backdrop for a product launch with vibrant full-color print.',
        'year' => '2025',
        'filter' => 'printing',
        'delay' => 600,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Printing',
        'title' => 'Store Banner Promotion',
        'desc' => 'Outdoor banner for retail promotion with weather-resistant vinyl and UV ink.',
        'year' => '2024',
        'filter' => 'printing',
        'delay' => 100,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1621544402532-78c290378588?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Signage',
        'title' => 'Acrylic Sign Installation',
        'desc' => 'Custom acrylic signage with LED backlighting for a boutique storefront.',
        'year' => '2025',
        'filter' => 'signage',
        'delay' => 200,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1561715276-a2d1c7b2cd0a?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Merchandise',
        'title' => 'Custom Tumbler Series',
        'desc' => 'Branded stainless steel tumblers with full-color wrap printing for corporate gifts.',
        'year' => '2025',
        'filter' => 'merchandise',
        'delay' => 300,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Printing',
        'title' => 'Business Card Set',
        'desc' => 'Luxury business card set with letterpress, foil stamping, and edge painting.',
        'year' => '2024',
        'filter' => 'printing',
        'delay' => 400,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1598392350678-f3ce2d9939de?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Printing',
        'title' => 'Roll Banner Exhibition',
        'desc' => 'Pop-up roll banner stand with full-color graphics for trade show exhibition.',
        'year' => '2025',
        'filter' => 'printing',
        'delay' => 500,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=800&q=80',
        'cat' => 'Packaging',
        'title' => 'Sticker Label Production',
        'desc' => 'Die-cut sticker labels for product packaging with matte laminate finish.',
        'year' => '2024',
        'filter' => 'packaging',
        'delay' => 600,
    ],
];
?>

<section id="portfolio" class="relative overflow-hidden bg-white py-28 lg:py-32">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-[400px] h-[400px] bg-gradient-to-br from-[#0B5ED7]/4 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/3 w-[350px] h-[350px] bg-gradient-to-tr from-[#FFC107]/4 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-3 rounded-full bg-[#0B5ED7]/5 px-5 py-2 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-sm font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Portofolio</span>
            </div>
            <h2 class="text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl leading-[1.15]">Showcase of Our <span class="gradient-text">Best Works</span></h2>
            <p class="mt-5 text-lg leading-relaxed text-slate-500">Setiap proyek adalah kebanggaan. Lihat hasil karya percetakan dan branding yang telah kami kerjakan untuk berbagai klien.</p>
        </div>

        {{-- Filter Navigation --}}
        <div class="mt-12 flex flex-wrap items-center justify-center gap-2"
             x-data="{ activeFilter: 'all' }"
             data-aos="fade-up" data-aos-delay="100">
            <button @click="activeFilter = 'all'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="activeFilter === 'all' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                All
            </button>
            <button @click="activeFilter = 'branding'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="activeFilter === 'branding' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Branding
            </button>
            <button @click="activeFilter = 'printing'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="activeFilter === 'printing' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Printing
            </button>
            <button @click="activeFilter = 'invitation'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="activeFilter === 'invitation' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Invitation
            </button>
            <button @click="activeFilter = 'merchandise'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="activeFilter === 'merchandise' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Merchandise
            </button>
            <button @click="activeFilter = 'signage'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="activeFilter === 'signage' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Signage
            </button>
            <button @click="activeFilter = 'packaging'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="activeFilter === 'packaging' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Packaging
            </button>
        </div>

        {{-- Portfolio Grid --}}
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
             x-data="{ activeFilter: 'all' }">
            @foreach($portfolios as $item)
            <div class="group relative overflow-hidden rounded-[1.5rem] border border-slate-100 bg-white shadow-premium transition-all duration-500 hover:-translate-y-2 hover:shadow-premium-xl hover:border-[#0B5ED7]/20"
                 data-aos="fade-up"
                 data-aos-delay="{{ $item['delay'] }}"
                 x-show="activeFilter === 'all' || activeFilter === '{{ $item['filter'] }}'"
                 x-transition.opacity.duration.500ms>
                {{-- Image Container --}}
                <div class="relative overflow-hidden aspect-[4/3]">
                    <img src="{{ $item['img'] }}"
                         alt="{{ $item['title'] }}"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110" />

                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    {{-- Category Badge --}}
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-semibold text-slate-700 shadow-lg border border-white/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                            {{ $item['cat'] }}
                        </span>
                    </div>

                    {{-- Year Badge --}}
                    <div class="absolute top-4 right-4 z-10">
                        <span class="inline-flex items-center rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-semibold text-slate-400 shadow-lg border border-white/20">
                            {{ $item['year'] }}
                        </span>
                    </div>

                    {{-- Hover Content --}}
                    <div class="absolute inset-x-0 bottom-0 p-6 z-20 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <a href="#contact"
                           class="inline-flex items-center gap-2 rounded-full bg-white/95 backdrop-blur-sm px-5 py-2.5 text-xs font-semibold text-slate-900 shadow-lg transition-all duration-300 hover:bg-[#0B5ED7] hover:text-white hover:shadow-xl hover:shadow-[#0B5ED7]/30 group/btn">
                            View Project
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Card Content --}}
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-slate-950">{{ $item['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500 line-clamp-2">{{ $item['desc'] }}</p>
                    <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-400">{{ $item['cat'] }} &middot; {{ $item['year'] }}</span>
                        <svg class="w-4 h-4 text-slate-300 transition-all duration-300 group-hover:text-[#0B5ED7] group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
