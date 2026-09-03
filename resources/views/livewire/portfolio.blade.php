<section id="portfolio" class="relative overflow-hidden bg-white">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-[280px] h-[280px] md:w-[420px] md:h-[420px] bg-gradient-to-br from-navy/4 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-l from-gold/8 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Faint navy geometric dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

<div class="mx-auto px-4 md:px-6 lg:px-8 py-12 md:py-20 lg:py-24 relative z-10 md:max-w-7xl">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 md:px-4 md:py-1.5 border border-gold/30 shadow-soft mb-4 md:mb-6">
                <span class="w-1 h-1 md:w-1.5 md:h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.15em] md:tracking-[0.22em] text-navy">{{ $isPortfolioPage ? 'Semua Portfolio' : 'Portfolio Kami' }}</span>
            </span>
            <h2 class="font-heading text-xl md:text-4xl lg:text-5xl font-bold tracking-tight text-navy leading-tight md:leading-[1.1]">{{ $isPortfolioPage ? 'Jelajahi Semua Hasil Karya' : 'Hasil Karya yang Membantu Brand' }} <span class="gradient-text">Tampil Lebih Berkesan</span></h2>
            <p class="mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Setiap proyek adalah kebanggaan. Lihat hasil karya percetakan dan branding yang telah kami kerjakan untuk berbagai klien.</p>
        </div>

        {{-- Editorial Mosaic Grid --}}
        <div class="mt-8 md:mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6 auto-rows-[200px] md:auto-rows-[280px] sm:auto-rows-[240px] lg:auto-rows-[300px]" wire:key="portfolio-grid-{{ $isPortfolioPage ? 'page' : 'home' }}">
            @forelse($portfolios as $index => $portfolio)
            @php
                // Tahun proyek dari project_date (atau null jika kosong).
                $portfolioYear = $portfolio->project_date?->format('Y');
                // Featured card HANYA berlaku di section Home (bukan di halaman /portfolio berpagination),
                // dan hanya untuk item pertama secara global (bukan per-halaman).
                $isFeatured = !$isPortfolioPage && $index === 0;
                // Delay animasi dihitung berdasarkan urutan dalam halaman saat ini (aman, cuma pengaruh visual).
                $delay = 100 + ($loop->index * 100);
            @endphp
            <div wire:key="portfolio-{{ $portfolio->id }}"
                 class="group relative {{ $isFeatured ? 'sm:col-span-2 sm:row-span-2' : '' }} overflow-hidden rounded-[1.75rem] border border-white/70 bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover hover:border-gold/40"
                 data-aos="fade-up"
                 data-aos-delay="{{ $delay }}"
                 @if($isFeatured) data-aos-duration="700" @endif>

                {{-- Image --}}
                <div class="absolute inset-0 overflow-hidden">
                    @if(!empty($portfolio->image_url))
                    <img src="{{ $portfolio->image_url }}"
                         alt="{{ $portfolio->title }}"
                         onerror="this.style.display='none'; this.parentElement.classList.add('has-portfolio-fallback');"
                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 z-0 hidden portfolio-fallback items-center justify-center flex-col bg-navy-deep">
                        <svg class="w-10 h-10 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="mt-2 text-xs font-inter font-medium text-white/50">Visual Portofolio Belum Tersedia</span>
                    </div>
                    @else
                    <div class="absolute inset-0 z-0 flex flex-col items-center justify-center bg-navy-deep">
                        <svg class="w-10 h-10 text-gold/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="mt-2 text-xs font-inter font-medium text-white/50">Visual Portofolio Belum Tersedia</span>
                    </div>
                    @endif
                </div>

                {{-- Dark navy gradient overlay for readability (more visible on hover) --}}
                <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/25 to-transparent transition-opacity duration-500"></div>

                {{-- Year (top-right) --}}
                @if($portfolioYear)
                <div class="absolute top-4 right-4 z-10">
                    <span class="inline-flex items-center rounded-full bg-white/90 backdrop-blur-sm px-3 py-1.5 text-[10px] font-heading font-bold text-navy shadow-soft border border-white/40">
                        {{ $portfolioYear }}
                    </span>
                </div>
                @endif

                {{-- Info overlay (bottom) --}}
                <div class="absolute inset-x-0 bottom-0 p-6 z-20">
                    <div class="translate-y-1 transition-transform duration-500 group-hover:translate-y-0">
                        <h3 class="font-heading text-lg {{ $isFeatured ? 'lg:text-2xl' : '' }} font-bold text-white">{{ $portfolio->title }}</h3>
                        <p class="mt-1.5 text-xs sm:text-sm font-inter text-white/70 leading-relaxed line-clamp-2 {{ $isFeatured ? 'hidden sm:block' : '' }}">{{ $portfolio->description }}</p>
                    </div>

                    {{-- Gold accent line + View project link (preserved destination #contact) --}}
                    <div class="mt-3 flex items-center justify-between gap-3">
                        <span class="h-0.5 w-8 rounded-full bg-gold opacity-0 translate-y-2 transition-all duration-500 group-hover:opacity-100 group-hover:translate-y-0"></span>
                        <a href="#contact"
                           class="inline-flex items-center gap-2 rounded-full bg-gold text-navy px-4 py-2 text-xs font-heading font-semibold transition-all duration-300 hover:bg-gold-light hover:shadow-button opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                            Lihat Proyek
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full rounded-[1.75rem] border border-white/70 bg-white p-10 text-center shadow-card">
                <svg class="mx-auto h-14 w-14 text-gold/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="mt-4 text-sm font-medium text-ink-soft">Belum ada portofolio yang tersedia.</p>
            </div>
            @endforelse
        </div>

        @if($isPortfolioPage)
            <div class="mt-10">
                {{ $portfolios->links() }}
            </div>
        @endif

{{-- Bottom CTA (dikontrol admin via setting show_portfolio_cta) --}}
        @if($showPortfolioCta)
        <div class="mt-14" data-aos="fade-up">
            <div class="relative rounded-[1.75rem] bg-white border border-white/70 p-10 lg:p-14 text-center shadow-card overflow-hidden">
                <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-gold via-gold-light to-gold opacity-70 pointer-events-none"></div>
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-[-80px] right-[-60px] w-[260px] h-[260px] rounded-full bg-gold/8 blur-3xl"></div>
                </div>
                <div class="max-w-xl mx-auto relative z-10">
                    <h3 class="font-heading text-2xl lg:text-3xl font-bold text-navy">See More Creative Projects</h3>
                    <p class="mt-3 text-base font-inter text-ink-soft leading-relaxed">Discover hundreds of branding and printing projects completed for businesses across Indonesia.</p>
                    <div class="mt-6">
                        <a href="/portfolio"
                           class="group inline-flex items-center gap-2.5 rounded-full border-2 border-navy bg-transparent px-8 py-3.5 text-sm font-heading font-semibold text-navy transition-all duration-300 hover:bg-gold hover:border-gold hover:text-navy hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50">
                            <svg class="w-4 h-4 text-gold-dark transition-transform duration-300 group-hover:-rotate-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Lihat Semua Portofolio</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>