<section id="products" class="relative overflow-hidden bg-cream">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/3 w-[400px] h-[400px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[380px] h-[380px] bg-gradient-to-l from-white/60 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Very faint navy dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 34px 34px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 py-20 lg:py-24 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-navy">{{ $isCataloguePage ? 'Katalog Produk' : 'Produk Unggulan' }}</span>
            </span>
            <h2 class="font-heading text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight text-navy leading-[1.1]">{{ $isCataloguePage ? 'Semua Produk untuk Mendukung' : 'Produk Berkualitas untuk Mendukung' }} <span class="gradient-text">Bisnis Anda</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Dari banner, sticker, undangan, hingga merchandise custom &mdash; semua siap cetak dengan kualitas premium.</p>
        </div>

        {{-- Products Grid --}}
        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($products as $product)
            <div class="group relative flex flex-col overflow-hidden rounded-[1.75rem] border border-white/70 bg-white shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-gold/40"
                 data-aos="fade-up"
                 data-aos-delay="{{ 100 + ($loop->index * 100) }}">

                {{-- Image --}}
                <div class="relative overflow-hidden aspect-[4/3]">
                    @if(!empty($product->image_url))
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         onerror="this.style.display='none'; this.parentElement.classList.add('has-fallback');"
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 z-0 hidden product-fallback items-center justify-center flex-col bg-navy-deep">
                        <svg class="w-10 h-10 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span class="mt-2 text-xs font-inter font-medium text-white/50">Gambar Produk Belum Tersedia</span>
                    </div>
                    @else
                    <div class="absolute inset-0 z-0 flex flex-col items-center justify-center bg-navy-deep">
                        <svg class="w-10 h-10 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span class="mt-2 text-xs font-inter font-medium text-white/50">Gambar Produk Belum Tersedia</span>
                    </div>
                    @endif

                    {{-- Dark navy gradient overlay at bottom --}}
                    <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-navy/70 via-navy/15 to-transparent pointer-events-none"></div>

                    {{-- Badge --}}
                    @if($product->badge)
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gold px-3 py-1.5 text-[10px] font-heading font-bold text-navy shadow-card">
                            <span class="w-1.5 h-1.5 rounded-full bg-navy/50"></span>
                            {{ $product->badge }}
                        </span>
                    </div>
                    @endif

                </div>

                {{-- Content --}}
                <div class="flex flex-col flex-1 p-6">
                    <h3 class="font-heading text-lg font-bold text-navy">{{ $product->name }}</h3>
                    <p class="mt-1.5 text-sm font-inter leading-relaxed text-ink-soft line-clamp-2 flex-1">{{ $product->short_description ?: $product->description }}</p>

                    {{-- Gold decorative line --}}
                    <div class="my-4 h-px w-full bg-white/80"></div>
                    <div class="my-4 -mt-4 h-0.5 w-10 rounded-full bg-gold/40 transition-all duration-300 group-hover:w-16 group-hover:bg-gold"></div>

                    {{-- CTA --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ $whatsappLink }}" target="_blank"
                           class="group/btn inline-flex w-full items-center justify-center gap-2 rounded-full bg-navy px-5 py-3 text-xs font-heading font-semibold text-white transition-all duration-300 hover:bg-navy-deep hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50">
                            <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span>Pesan via WhatsApp</span>
                            <svg class="w-3 h-3 text-gold transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-sm font-inter text-ink-soft col-span-full">Belum ada produk yang tersedia.</p>
            @endforelse

            @if($showProductCta)
            <div class="group relative flex flex-col justify-center overflow-hidden rounded-[1.75rem] border border-white/70 bg-white p-8 text-center shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-gold/40 lg:p-10" data-aos="fade-up">
                <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-gold via-gold-light to-gold opacity-70 pointer-events-none"></div>
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-[-80px] right-[-60px] w-[260px] h-[260px] rounded-full bg-gold/8 blur-3xl"></div>
                </div>
                <div class="relative z-10 flex flex-col items-center">
                    <h3 class="font-heading text-xl font-bold text-navy lg:text-2xl">Explore Our Complete Product Catalogue</h3>
                    <p class="mt-3 text-sm font-inter leading-relaxed text-ink-soft">We provide hundreds of digital printing, promotional, and branding products for businesses, events, and personal needs.</p>
                    <a href="{{ route('products.index') }}"
                       class="group/btn mt-6 inline-flex items-center gap-2.5 rounded-full border-2 border-navy bg-transparent px-6 py-3.5 text-sm font-heading font-semibold text-navy transition-all duration-300 hover:bg-gold hover:border-gold hover:text-navy hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50">
                        <span>Lihat Semua Produk</span>
                        <svg class="w-4 h-4 text-gold-dark transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @endif
        </div>

        @if($isCataloguePage)
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</section>
