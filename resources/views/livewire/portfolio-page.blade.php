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
            <div class="flex flex-wrap justify-center gap-2.5" role="tablist" aria-label="Filter kategori portfolio">
                <button type="button" wire:click="setCategory('all')" wire:loading.attr="disabled" class="rounded-full border px-5 py-2.5 text-[10px] font-semibold uppercase tracking-[0.14em] transition {{ $activeCategory === 'all' ? 'border-navy bg-navy text-white' : 'border-navy/15 bg-transparent text-ink-soft hover:border-gold hover:text-navy' }}" aria-selected="{{ $activeCategory === 'all' ? 'true' : 'false' }}">All</button>
                @foreach($categories as $category)
                    <button type="button" wire:key="category-{{ $category->slug }}" wire:click="setCategory('{{ $category->slug }}')" wire:loading.attr="disabled" class="rounded-full border px-5 py-2.5 text-[10px] font-semibold uppercase tracking-[0.14em] transition {{ $activeCategory === $category->slug ? 'border-navy bg-navy text-white' : 'border-navy/15 bg-transparent text-ink-soft hover:border-gold hover:text-navy' }}" aria-selected="{{ $activeCategory === $category->slug ? 'true' : 'false' }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <div class="mt-12 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3" wire:key="portfolio-grid-{{ $activeCategory }}-{{ $portfolios->currentPage() }}">
                @forelse($portfolios as $index => $portfolio)
                    @php($portfolioYear = $portfolio->project_date?->format('Y'))
                    <article wire:key="portfolio-{{ $portfolio->id }}" class="group relative min-h-[300px] overflow-hidden rounded-2xl bg-navy-deep {{ $loop->first ? 'sm:col-span-2 lg:col-span-2 lg:min-h-[460px]' : '' }}" data-aos="fade-up" data-aos-delay="{{ 80 + ($loop->index * 55) }}">
                        @if($portfolio->image_url)
                            <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                            <div class="absolute inset-0 hidden flex-col items-center justify-center bg-navy-deep text-center"><span class="text-[10px] uppercase tracking-[0.16em] text-white/50">Preview Tidak Tersedia</span></div>
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-navy-deep text-center"><svg class="h-9 w-9 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg><span class="mt-3 text-[10px] uppercase tracking-[0.16em] text-white/45">Preview Tidak Tersedia</span></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-navy/95 via-navy/25 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-5 sm:p-6">
                            <div class="flex items-center gap-3 text-[9px] font-semibold uppercase tracking-[0.18em] text-white/75">@if($portfolio->category)<span>{{ $portfolio->category->name }}</span>@endif @if($portfolioYear)<span>· {{ $portfolioYear }}</span>@endif</div>
                            <h2 class="mt-2 font-heading text-lg font-bold leading-tight text-white sm:text-xl {{ $loop->first ? 'lg:text-3xl' : '' }}">{{ $portfolio->title }}</h2>
                            @if($portfolio->description)<p class="mt-2 max-w-xl text-xs leading-relaxed text-white/70 line-clamp-2">{{ $portfolio->description }}</p>@endif
                        </div>
                    </article>
                @empty
                    <div class="col-span-full flex min-h-[300px] flex-col items-center justify-center rounded-2xl bg-navy-deep px-6 text-center"><p class="text-sm text-white/60">Belum ada project pada kategori ini.</p></div>
                @endforelse
            </div>

            <div class="mt-10 flex flex-col gap-5 border-t border-navy/10 pt-6 text-[10px] font-semibold uppercase tracking-[0.14em] text-ink-soft sm:flex-row sm:items-center sm:justify-between"><p>Showing {{ $showingFrom }}-{{ $showingTo }} of {{ $filteredTotal }} projects</p><div class="flex items-center gap-3"><button type="button" wire:click="previousPage" @disabled($portfolios->onFirstPage()) aria-label="Halaman sebelumnya" class="flex h-9 w-9 items-center justify-center rounded-full border border-navy/15 text-navy transition hover:border-gold hover:text-gold disabled:cursor-not-allowed disabled:opacity-30"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg></button><span class="min-w-[52px] text-center text-[10px] text-navy">{{ str_pad((string) $portfolios->currentPage(), 2, '0', STR_PAD_LEFT) }} / {{ str_pad((string) $totalPages, 2, '0', STR_PAD_LEFT) }}</span><button type="button" wire:click="nextPage" @disabled(! $portfolios->hasMorePages()) aria-label="Halaman berikutnya" class="flex h-9 w-9 items-center justify-center rounded-full border border-navy/15 text-navy transition hover:border-gold hover:text-gold disabled:cursor-not-allowed disabled:opacity-30"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></button></div></div>
        </div>
    </section>

    <section class="bg-cream px-5 py-24 sm:px-8 lg:px-12 lg:py-32"><div class="mx-auto max-w-3xl text-center" data-aos="fade-up"><div class="font-heading text-4xl text-gold">{{ $totalPortfolios }}</div><p class="mt-6 font-heading text-2xl font-bold leading-tight text-navy sm:text-4xl">{{ $quoteTextBeforeAccent }}@if($quoteTextAccent)<span class="text-gold-dark">{{ $quoteTextAccent }}</span>@endif</p><p class="mx-auto mt-6 max-w-xl text-sm leading-7 text-ink-soft">{{ $content['quote_description'] }}</p></div></section>

    <section class="bg-light px-5 py-16 sm:px-8 lg:px-12 lg:py-20">
        <div class="mx-auto max-w-7xl rounded-3xl bg-navy-dark px-6 py-14 text-white shadow-card sm:px-10 lg:px-16 lg:py-20">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-center lg:justify-between" data-aos="fade-up">
                <div class="max-w-2xl">
                    <h2 class="font-heading text-3xl font-bold leading-tight sm:text-5xl">{{ $content['cta_title'] }}</h2>
                    <p class="mt-5 max-w-xl text-sm leading-7 text-white/60">{{ $content['cta_description'] }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-3 rounded-full bg-gold px-5 py-3 text-xs font-semibold text-navy transition hover:bg-gold-light hover:shadow-button">{{ $content['cta_button_primary_text'] }}<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg></a>
                    <a href="#contact" class="inline-flex items-center rounded-full border border-white/25 px-5 py-3 text-xs font-semibold text-white transition hover:border-gold hover:text-gold">{{ $content['cta_button_secondary_text'] }}</a>
                </div>
            </div>
        </div>
    </section>
</div>
