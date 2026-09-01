<div class="bg-light text-ink">
    <section class="relative overflow-hidden px-5 pb-14 pt-32 sm:px-8 lg:px-12 lg:pb-20 lg:pt-40">
        <div class="pointer-events-none absolute inset-0 opacity-40" style="background-image: linear-gradient(120deg, transparent 0%, rgba(214,168,61,.08) 50%, transparent 100%);"></div>
        <div class="relative mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full border border-gold/35 bg-white/70 px-4 py-2 text-[10px] font-semibold uppercase tracking-[0.24em] text-gold-dark"><span class="h-1.5 w-1.5 rounded-full bg-gold"></span>{{ $content['hero_badge_text'] }}</span>
            <h1 class="mt-7 font-heading text-4xl font-bold leading-[1.08] tracking-tight text-navy sm:text-6xl lg:text-[64px]">{{ $content['hero_title_line1'] }}<span class="block text-gold-dark">{{ $content['hero_title_line2'] }}</span></h1>
            <p class="mx-auto mt-7 max-w-2xl text-sm leading-7 text-ink-soft sm:text-base">{{ $content['hero_description'] }}</p>
        </div>
    </section>

    <section class="px-5 pb-20 sm:px-8 lg:px-12 lg:pb-28">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-wrap justify-center gap-2.5" role="tablist" aria-label="Filter kategori produk">
                <button type="button" wire:click="setCategory('all')" wire:loading.attr="disabled" class="rounded-full border px-5 py-2.5 text-[10px] font-semibold uppercase tracking-[0.14em] transition {{ $activeCategory === 'all' ? 'border-navy bg-navy text-white' : 'border-navy/15 bg-transparent text-ink-soft hover:border-gold hover:text-navy' }}" aria-selected="{{ $activeCategory === 'all' ? 'true' : 'false' }}">All</button>
                @foreach($categories as $category)
                    <button type="button" wire:key="category-{{ $category->slug }}" wire:click="setCategory('{{ $category->slug }}')" wire:loading.attr="disabled" class="rounded-full border px-5 py-2.5 text-[10px] font-semibold uppercase tracking-[0.14em] transition {{ $activeCategory === $category->slug ? 'border-navy bg-navy text-white' : 'border-navy/15 bg-transparent text-ink-soft hover:border-gold hover:text-navy' }}" aria-selected="{{ $activeCategory === $category->slug ? 'true' : 'false' }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <div class="mt-12 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3" wire:key="product-grid-{{ $activeCategory }}-{{ $products->currentPage() }}">
                @forelse($products as $index => $product)
                    @php
                        $isFeatured = $this->isProductsPage && $products->currentPage() === 1 && $index === 0;
                        $productImage = $product->image_url ?: ($product->coverImage()?->image_url);
                    @endphp
                    <article wire:key="product-{{ $product->id }}" class="group relative min-h-[320px] overflow-hidden rounded-[1.75rem] border border-white/70 bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover hover:border-gold/40 {{ $isFeatured ? 'sm:col-span-2 lg:col-span-2 lg:min-h-[440px]' : '' }}" data-aos="fade-up" data-aos-delay="{{ 80 + ($loop->index * 60) }}">
                        <div class="absolute inset-0 overflow-hidden">
                            @if($productImage)
                                <img src="{{ $productImage }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                <div class="absolute inset-0 hidden flex-col items-center justify-center bg-navy-deep text-center">
                                    <svg class="h-9 w-9 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="mt-3 text-[10px] uppercase tracking-[0.16em] text-white/45">Preview Tidak Tersedia</span>
                                </div>
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-navy-deep text-center">
                                    <svg class="h-9 w-9 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="mt-3 text-[10px] uppercase tracking-[0.16em] text-white/45">Preview Tidak Tersedia</span>
                                </div>
                            @endif
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-navy/95 via-navy/20 to-transparent"></div>
                        @if($product->badge)
                            <div class="absolute left-4 top-4 z-10">
                                <span class="inline-flex items-center rounded-full bg-gold px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.14em] text-navy shadow-soft">{{ $product->badge }}</span>
                            </div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 z-10 p-5 sm:p-6">
                            @if($product->category)
                                <div class="flex items-center gap-3 text-[9px] font-semibold uppercase tracking-[0.18em] text-white/75">
                                    <span>{{ $product->category->name }}</span>
                                </div>
                            @endif
                            <h2 class="mt-2 font-heading text-lg font-bold leading-tight text-white sm:text-xl {{ $isFeatured ? 'lg:text-3xl' : '' }}">{{ $product->name }}</h2>
                            @if($product->short_description || $product->description)
                                <p class="mt-2 max-w-xl text-xs leading-relaxed text-white/70 line-clamp-2 {{ $isFeatured ? 'sm:block' : '' }}">{{ $product->short_description ?? $product->description }}</p>
                            @endif
                            <div class="mt-4 flex items-center gap-2">
                                <a href="{{ route('home', ['product' => $product->slug]) }}#contact"
                                   class="group/btn inline-flex items-center justify-center gap-2 rounded-full bg-gold px-4 py-2.5 text-[10px] font-heading font-semibold text-navy transition-all duration-300 hover:bg-gold-light hover:shadow-button hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50">
                                    <svg class="h-3.5 w-3.5 text-navy" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    <span>Pesan Sekarang</span>
                                    <svg class="h-2.5 w-2.5 text-navy transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full flex min-h-[300px] flex-col items-center justify-center rounded-[1.75rem] bg-navy-deep px-6 text-center text-white">
                        <svg class="h-12 w-12 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="mt-4 text-sm text-white/60">Belum ada produk pada kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 flex flex-col gap-5 border-t border-navy/10 pt-6 text-[10px] font-semibold uppercase tracking-[0.14em] text-ink-soft sm:flex-row sm:items-center sm:justify-between">
                <p>Showing {{ $showingFrom }}-{{ $showingTo }} of {{ $filteredTotal }} products</p>
                <div class="flex items-center gap-3">
                    <button type="button" wire:click="previousPage" @disabled($products->onFirstPage()) aria-label="Halaman sebelumnya" class="flex h-9 w-9 items-center justify-center rounded-full border border-navy/15 text-navy transition hover:border-gold hover:text-gold disabled:cursor-not-allowed disabled:opacity-30">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <span class="min-w-[52px] text-center text-[10px] text-navy">{{ str_pad((string) $products->currentPage(), 2, '0', STR_PAD_LEFT) }} / {{ str_pad((string) $totalPages, 2, '0', STR_PAD_LEFT) }}</span>
                    <button type="button" wire:click="nextPage" @disabled(! $products->hasMorePages()) aria-label="Halaman berikutnya" class="flex h-9 w-9 items-center justify-center rounded-full border border-navy/15 text-navy transition hover:border-gold hover:text-gold disabled:cursor-not-allowed disabled:opacity-30">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-cream px-5 py-24 sm:px-8 lg:px-12 lg:py-32">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <div class="font-heading text-4xl text-gold">{{ $totalProducts }}</div>
            <p class="mt-6 font-heading text-2xl font-bold leading-tight text-navy sm:text-4xl">{{ $content['quote_text'] }}</p>
            <p class="mx-auto mt-6 max-w-xl text-sm leading-7 text-ink-soft">{{ $content['quote_description'] }}</p>
        </div>
    </section>

    <section class="bg-light px-5 pb-24 pt-4 sm:px-8 lg:px-12 lg:pb-32 lg:pt-6">
        <div class="mx-auto max-w-7xl rounded-[2rem] bg-navy-dark px-6 py-14 text-white shadow-card sm:px-10 lg:px-16 lg:py-20">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-center lg:justify-between" data-aos="fade-up">
                <div class="max-w-2xl">
                    <h2 class="font-heading text-3xl font-bold leading-tight sm:text-5xl">{{ $content['cta_title'] }}</h2>
                    <p class="mt-5 max-w-xl text-sm leading-7 text-white/60">{{ $content['cta_description'] }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-3 rounded-full bg-gold px-5 py-3 text-xs font-semibold text-navy transition hover:bg-gold-light hover:shadow-button">{{ $content['cta_button_primary_text'] }}<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg></a>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-full border border-white/25 px-5 py-3 text-xs font-semibold text-white transition hover:border-gold hover:text-gold">{{ $content['cta_button_secondary_text'] }}</a>
                </div>
            </div>
        </div>
    </section>
</div>
