<?php
$products = [
    [
        'img' => 'https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Stationery',
        'title' => 'Business Card',
        'desc' => 'Kartu nama premium dengan finishing emboss, spot UV, atau foil stamping.',
        'badge' => 'Best Seller',
        'delay' => 100,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Large Format',
        'title' => 'Event Banner',
        'desc' => 'Cetak banner ukuran besar untuk indoor dan outdoor dengan material tahan cuaca.',
        'badge' => 'Popular',
        'delay' => 200,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Labeling',
        'title' => 'Custom Sticker',
        'desc' => 'Sticker die-cut, vinyl, dan hologram untuk packaging dan branding produk.',
        'badge' => false,
        'delay' => 300,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1561715276-a2d1c7b2cd0a?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Promotional',
        'title' => 'Custom Tumbler',
        'desc' => 'Tumbler stainless custom with logo untuk hadiah perusahaan dan merchandise.',
        'badge' => 'New',
        'delay' => 400,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1586339949916-3e5457d58f1c?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Promotional',
        'title' => 'Custom Mug',
        'desc' => 'Mug keramik custom dengan logo atau desain full-color untuk campaign brand.',
        'badge' => false,
        'delay' => 500,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1602584329770-70d8a44de8cb?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Merchandise',
        'title' => 'Totebag Printing',
        'desc' => 'Totebag kanvas custom dengan desain eksklusif untuk packaging dan promosi.',
        'badge' => 'Eco',
        'delay' => 600,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1605615562235-29f61499f16e?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Stationery',
        'title' => 'Brosur & Flyer',
        'desc' => 'Brosur dan flyer full color dengan kertas art paper 150gsm, laminasi doff/glossy.',
        'badge' => false,
        'delay' => 100,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1598392350678-f3ce2d9939de?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Large Format',
        'title' => 'X-Banner & Roll Banner',
        'desc' => 'Stand banner portable untuk event, pameran, dan promosi indoor.',
        'badge' => 'Popular',
        'delay' => 200,
        'span' => true,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Wedding',
        'title' => 'Wedding Invitation',
        'desc' => 'Undangan pernikahan custom dengan desain elegan, pilihan kertas premium, dan finishing eksklusif.',
        'badge' => 'Premium',
        'delay' => 300,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1612449091860-4540ab0aeb94?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Packaging',
        'title' => 'Packaging Box',
        'desc' => 'Kemasan produk custom dengan desain unik dan bahan berkualitas.',
        'badge' => false,
        'delay' => 400,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1621544402532-78c290378588?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Signage',
        'title' => 'Neon Box',
        'desc' => 'Neon box custom untuk signage toko, cafe, dan brand dengan pencahayaan LED.',
        'badge' => false,
        'delay' => 500,
        'span' => false,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1586075010923-2dd4570fb338?auto=format&fit=crop&w=900&q=80',
        'cat' => 'Corporate',
        'title' => 'Company Profile',
        'desc' => 'Buku company profile cetak dengan desain profesional untuk presentasi korporat.',
        'badge' => false,
        'delay' => 600,
        'span' => false,
    ],
];
?>

<section id="products" class="relative overflow-hidden bg-white py-28 lg:py-32">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/3 w-[400px] h-[400px] bg-gradient-to-br from-[#0B5ED7]/4 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/3 right-1/4 w-[350px] h-[350px] bg-gradient-to-tr from-[#FFC107]/4 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-3 rounded-full bg-[#0B5ED7]/5 px-5 py-2 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-sm font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Produk Unggulan</span>
            </div>
            <h2 class="text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl leading-[1.15]">Solusi Cetak <span class="gradient-text">Lengkap</span></h2>
            <p class="mt-5 text-lg leading-relaxed text-slate-500">Dari banner, sticker, undangan, hingga merchandise custom &mdash; semua siap cetak dengan kualitas premium.</p>
        </div>

        {{-- Filter Categories --}}
        <div class="mt-12 flex flex-wrap items-center justify-center gap-2" data-aos="fade-up" data-aos-delay="100"
             x-data="{ active: 'all' }">
            <button @click="active = 'all'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="active === 'all' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Semua
            </button>
            <button @click="active = 'stationery'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="active === 'stationery' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Stationery
            </button>
            <button @click="active = 'large-format'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="active === 'large-format' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Large Format
            </button>
            <button @click="active = 'merchandise'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="active === 'merchandise' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Merchandise
            </button>
            <button @click="active = 'signage'"
                    class="rounded-full px-5 py-2 text-xs font-semibold transition-all duration-300"
                    :class="active === 'signage' ? 'bg-[#0B5ED7] text-white shadow-lg shadow-[#0B5ED7]/20' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200'">
                Signage
            </button>
        </div>

        {{-- Products Grid --}}
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
             x-data="{ active: 'all' }">
            @foreach($products as $product)
            <div class="group relative overflow-hidden rounded-[1.5rem] border border-slate-100 bg-white shadow-premium transition-all duration-500 hover:-translate-y-2 hover:shadow-premium-xl hover:border-[#0B5ED7]/20"
                 data-aos="fade-up"
                 data-aos-delay="{{ $product['delay'] }}"
                 x-show="active === 'all' || active === '{{ $product['cat'] === 'Stationery' ? 'stationery' : ($product['cat'] === 'Large Format' ? 'large-format' : ($product['cat'] === 'Promotional' || $product['cat'] === 'Merchandise' || $product['cat'] === 'Wedding' || $product['cat'] === 'Labeling' || $product['cat'] === 'Packaging' ? 'merchandise' : 'signage')) }}'"
                 x-transition.opacity.duration.500ms>
                <div class="relative overflow-hidden aspect-[4/3]">
                    {{-- Image --}}
                    <img src="{{ $product['img'] }}"
                         alt="{{ $product['title'] }}"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110" />

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    {{-- Badge --}}
                    @if($product['badge'])
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-semibold text-slate-700 shadow-lg border border-white/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                            {{ $product['badge'] }}
                        </span>
                    </div>
                    @endif

                    {{-- Category --}}
                    <div class="absolute top-4 right-4 z-10">
                        <span class="inline-flex items-center rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-semibold text-slate-500 shadow-lg border border-white/20">
                            {{ $product['cat'] }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-lg font-semibold text-slate-950">{{ $product['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500 line-clamp-2">{{ $product['desc'] }}</p>
                    <div class="mt-5 flex items-center gap-3">
                        <a href="https://wa.me/6281234567890" target="_blank"
                           class="group/btn inline-flex items-center gap-2 rounded-full bg-[#0B5ED7] px-5 py-2.5 text-xs font-semibold text-white transition-all duration-300 hover:bg-[#0B5ED7]/90 hover:shadow-lg hover:shadow-[#0B5ED7]/20 active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Order via WhatsApp
                            <svg class="w-3 h-3 transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
