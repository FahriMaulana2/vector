@php
    $showPortfolioCta = (bool) App\Models\Setting::get('show_portfolio_cta', true);
    $showProductCta = (bool) App\Models\Setting::get('show_product_cta', true);
    $ctaVisible = $showPortfolioCta || $showProductCta;
@endphp

@if($ctaVisible)
<section id="cta-final" class="relative overflow-hidden bg-gradient-to-br from-navy-dark via-navy to-navy-deep py-16 sm:py-20 lg:py-24">
    <div class="absolute inset-0 opacity-[0.05] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #ffffff 1px, transparent 0); background-size: 34px 34px;"></div>
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] right-[-60px] w-[260px] h-[260px] rounded-full bg-gold/15 blur-3xl"></div>
        <div class="absolute bottom-[-80px] left-[-60px] w-[220px] h-[220px] rounded-full bg-gold/10 blur-3xl"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-4xl px-5 text-center sm:px-6 lg:px-8">
        <span class="inline-flex items-center gap-2 rounded-full border border-gold/20 bg-white/[0.04] px-4 py-1.5 text-[10px] font-heading font-semibold uppercase tracking-[0.22em] text-gold">
            <span class="h-1.5 w-1.5 rounded-full bg-gold"></span>
            Konsultasi Gratis
        </span>

        <h2 class="mt-6 font-heading text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
            See More Creative Projects
        </h2>

        <p class="mx-auto mt-4 max-w-2xl text-sm font-inter leading-relaxed text-white/70 sm:text-base lg:text-lg">
            Discover hundreds of branding and printing projects completed for businesses across Indonesia.
        </p>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('portfolio.index') }}"
               class="group inline-flex items-center justify-center gap-2.5 rounded-full border-2 border-gold bg-transparent px-7 py-3.5 text-sm font-heading font-semibold text-gold transition-all duration-300 hover:bg-gold hover:text-navy hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50 sm:px-8 sm:text-base">
                <svg class="h-4 w-4 text-gold transition-transform duration-300 group-hover:-rotate-6 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Lihat Semua Portofolio</span>
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif
