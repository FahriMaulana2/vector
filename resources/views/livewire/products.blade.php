<?php
$featuredProducts = [
    [
        'img' => 'https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Stationery',
        'title' => 'Business Card',
        'desc' => 'Kartu nama premium dengan finishing emboss, spot UV, atau foil stamping.',
        'badge' => 'Best Seller',
        'delay' => 100,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Large Format',
        'title' => 'Event Banner',
        'desc' => 'Cetak banner ukuran besar untuk indoor dan outdoor dengan material tahan cuaca.',
        'badge' => 'Popular',
        'delay' => 200,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Labeling',
        'title' => 'Custom Sticker',
        'desc' => 'Sticker die-cut, vinyl, dan hologram untuk packaging dan branding produk.',
        'badge' => false,
        'delay' => 300,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1561715276-a2d1c7b2cd0a?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Promotional',
        'title' => 'Custom Tumbler',
        'desc' => 'Tumbler stainless custom with logo untuk hadiah perusahaan dan merchandise.',
        'badge' => 'New',
        'delay' => 400,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Wedding',
        'title' => 'Wedding Invitation',
        'desc' => 'Undangan pernikahan custom dengan desain elegan, pilihan kertas premium, dan finishing eksklusif.',
        'badge' => 'Premium',
        'delay' => 500,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1612449091860-4540ab0aeb94?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Packaging',
        'title' => 'Packaging Box',
        'desc' => 'Kemasan produk custom dengan desain unik dan bahan berkualitas.',
        'badge' => false,
        'delay' => 600,
    ],
];
?>

<section id="products" class="relative overflow-hidden bg-white">
    {{-- Single subtle background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/3 w-[400px] h-[400px] bg-gradient-to-br from-[#0B5ED7]/3 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Featured Products</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight text-slate-950 leading-[1.1]">Solusi Cetak <span class="text-[#0B5ED7]">Lengkap</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Dari banner, sticker, undangan, hingga merchandise custom &mdash; semua siap cetak dengan kualitas premium.</p>
        </div>

        {{-- Featured Products Grid (6 items) --}}
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($featuredProducts as $product)
            <div class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card transition-all duration-500 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-[#0B5ED7]/20"
                 data-aos="fade-up"
                 data-aos-delay="{{ $product['delay'] }}">
                <div class="relative overflow-hidden aspect-[4/3]">
                    <img src="{{ $product['img'] }}"
                         alt="{{ $product['title'] }}"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110" />

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    @if($product['badge'])
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-semibold text-slate-700 shadow-lg border border-white/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                            {{ $product['badge'] }}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="p-5">
                    <span class="text-[10px] font-semibold uppercase tracking-[0.15em] text-slate-400">{{ $product['cat'] }}</span>
                    <h3 class="mt-1 text-lg font-semibold text-slate-950">{{ $product['title'] }}</h3>
                    <p class="mt-1 text-sm leading-relaxed text-slate-500 line-clamp-2">{{ $product['desc'] }}</p>
                    <div class="mt-4 flex items-center gap-3">
                        <a href="https://wa.me/6281234567890" target="_blank"
                           class="group/btn inline-flex items-center gap-2 rounded-full bg-[#0B5ED7] px-5 py-2.5 text-xs font-semibold text-white transition-all duration-300 hover:bg-[#0B5ED7]/90 hover:shadow-button active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Order via WhatsApp
                            <svg class="w-3 h-3 transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-14" data-aos="fade-up">
            <div class="relative rounded-2xl bg-gradient-to-br from-slate-50 to-white border border-slate-100 p-10 lg:p-14 text-center">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-2xl lg:text-3xl font-bold text-slate-950">Explore Our Complete Product Catalogue</h3>
                    <p class="mt-3 text-base text-slate-500 leading-relaxed">We provide hundreds of digital printing, promotional, and branding products for businesses, events, and personal needs.</p>
                    <div class="mt-6">
                        <a href="/products"
                           class="group inline-flex items-center gap-2.5 rounded-full bg-[#0B5ED7] px-8 py-3.5 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                            <span>View All Products</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

