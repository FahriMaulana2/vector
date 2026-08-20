<?php
// Slide diisi dari Livewire component (slide #1 dari database, #2-3 fallback desain lama)
$heroTitle = $hero?->title;
$heroDescription = $hero?->description;
?>
<section id="home"
    class="relative overflow-hidden bg-navy"
    style="min-height: 640px;">
{{-- Layered navy gradient background (z-0, behind content) --}}
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-navy-dark via-navy to-navy-deep"></div>

    {{-- Decorative gold glow orbs (behind content, never intercept clicks) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-180px] right-[-120px] w-[520px] h-[520px] rounded-full bg-gold/15 blur-3xl"></div>
        <div class="absolute bottom-[-200px] left-[-120px] w-[460px] h-[460px] rounded-full bg-gold/10 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[820px] h-[820px] rounded-full bg-navy-deep/40 blur-3xl"></div>
    </div>

    {{-- Subtle grid / dot pattern overlay (behind content) --}}
    <div class="absolute inset-0 z-0 opacity-[0.05] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #ffffff 1px, transparent 0); background-size: 38px 38px;"></div>

    {{-- Decorative thin lines (behind content) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute left-0 top-0 h-full w-px bg-gradient-to-b from-transparent via-white/5 to-transparent"></div>
        <div class="absolute right-8 top-0 h-40 w-px bg-gradient-to-b from-transparent via-gold/30 to-transparent"></div>
    </div>

    <div class="relative z-10 flex items-center h-full min-h-[640px] pt-[80px] pb-16 lg:pt-[96px] lg:pb-20">
        <div class="w-full max-w-7xl mx-auto px-5 md:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[0.5fr_0.5fr] gap-14 lg:gap-16 xl:gap-20 items-center">
                {{-- Left Content --}}
                <div class="space-y-8 pt-8 lg:pt-0" data-aos="fade-right" data-aos-delay="100">
                    {{-- Section Label / Badge --}}
                    <div>
                        <span class="inline-flex items-center gap-2.5 rounded-full bg-white/[0.06] px-4 py-2 border border-gold/20 backdrop-blur-sm">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full rounded-full bg-gold opacity-75 animate-ping"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-gold"></span>
                            </span>
                            <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-gold">Digital Printing &amp; Branding</span>
                            <svg class="w-3.5 h-3.5 text-cream/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>

{{-- Heading --}}
                    <div class="space-y-4">
                        <h1 class="font-heading text-4xl md:text-5xl lg:text-[54px] xl:text-[58px] font-bold tracking-tight text-cream leading-[1.08]">
                            {!! $heroTitle ?: 'Cetak Berkualitas<br /> untuk<br /><span class="gradient-text">Bisnis Modern</span>' !!}
                        </h1>
                        <p class="max-w-2xl text-base lg:text-lg font-inter leading-relaxed text-cream/60">
                            {!! $heroDescription ?: 'Dari banner, sticker, undangan, hingga merchandise custom &mdash; solusi digital printing dan branding profesional untuk bisnis Anda.' !!}
                        </p>
                    </div>

{{-- CTAs (relative z-20, always above decorative layers) --}}
                    <div class="relative z-20 flex flex-wrap gap-3">
                        <a href="{{ $primaryCtaLink ?: '#contact' }}"
                           class="group inline-flex items-center justify-center rounded-full bg-gold px-7 py-3.5 text-sm font-heading font-bold text-navy shadow-button transition-all duration-300 hover:bg-gold-light hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                            <span class="flex items-center gap-2">
                                {{ $primaryCta ?: 'Konsultasi Gratis' }}
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </a>
                        <a href="#portfolio"
                           class="group inline-flex items-center justify-center rounded-full border border-cream/20 bg-cream/[0.04] backdrop-blur-sm px-7 py-3.5 text-sm font-heading font-semibold text-cream transition-all duration-300 hover:border-gold/40 hover:bg-cream/[0.08] hover:shadow-soft hover:-translate-y-0.5 active:translate-y-0">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 5h-1.5l-1.707-1.707A1 1 0 0015.172 3H8.828a1 1 0 00-.707.293L6.5 5H5a3 3 0 00-3 3v9a3 3 0 003 3h14a3 3 0 003-3V8a3 3 0 00-3-3zm-7 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/></svg>
                                Lihat Portofolio
                            </span>
                        </a>
                    </div>

                    {{-- Statistics (premium compact cards) --}}
                    @if($statistics->isNotEmpty())
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 pt-6 border-t border-cream/10">
                        @foreach($statistics as $stat)
                        <div class="rounded-2xl border border-cream/10 bg-cream/[0.04] backdrop-blur-sm px-3.5 py-3 transition-all duration-300 hover:border-gold/30 hover:bg-cream/[0.07]" data-aos="fade-up" data-aos-delay="{{ 150 + ($loop->iteration * 50) }}">
                            <p class="font-heading text-xl md:text-2xl font-bold text-gold">{{ $stat->value }}</p>
                            <p class="text-[11px] font-inter text-cream/50 mt-1 uppercase tracking-wider font-medium">{{ $stat->label }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 pt-6 border-t border-cream/10">
                        <div class="rounded-2xl border border-cream/10 bg-cream/[0.04] backdrop-blur-sm px-4 py-3" data-aos="fade-up" data-aos-delay="200">
                            <p class="font-heading text-xl md:text-2xl font-bold text-gold">1.250+</p>
                            <p class="text-[11px] font-inter text-cream/50 mt-1 uppercase tracking-wider font-medium">Projects</p>
                        </div>
                        <div class="rounded-2xl border border-cream/10 bg-cream/[0.04] backdrop-blur-sm px-4 py-3 text-center" data-aos="fade-up" data-aos-delay="300">
                            <p class="font-heading text-xl md:text-2xl font-bold text-cream">980+</p>
                            <p class="text-[11px] font-inter text-cream/50 mt-1 uppercase tracking-wider font-medium">Clients</p>
                        </div>
                        <div class="rounded-2xl border border-gold/20 bg-gold/[0.06] backdrop-blur-sm px-4 py-3 text-right" data-aos="fade-up" data-aos-delay="400">
                            <p class="font-heading text-xl md:text-2xl font-bold text-gold">24-48 Jam</p>
                            <p class="text-[11px] font-inter text-cream/50 mt-1 uppercase tracking-wider font-medium">Delivery</p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Right Content: Single Hero Image from Database/Admin --}}
                <div class="relative z-10 lg:pl-4" data-aos="fade-left" data-aos-delay="200">
                    {{-- Glow behind image --}}
                    <div class="absolute -inset-6 rounded-[2.5rem] bg-gradient-to-br from-gold/20 to-navy-deep/40 blur-2xl opacity-70 pointer-events-none"></div>

                    {{-- Image + Floating Cards wrapper (relative anchor) --}}
                    <div class="relative">
                        {{-- Image Frame --}}
                        <div class="relative rounded-[2rem] overflow-hidden shadow-2xl ring-1 ring-gold/20 bg-navy-deep">
                            <div class="relative aspect-[4/5] lg:aspect-[3/4] w-full overflow-hidden">
                                <img src="{{ $heroImage }}"
                                     alt="{{ $heroImageAlt }}"
                                     class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" />

                                {{-- Bottom gradient overlay --}}
                                <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-navy/80 to-transparent z-20"></div>

                                {{-- Subtitle / Category label --}}
                                <div class="absolute top-5 left-5 z-30">
                                    <span class="inline-flex items-center gap-2 rounded-full bg-navy/60 backdrop-blur-md px-4 py-1.5 text-[11px] font-heading font-semibold text-cream border border-gold/30 shadow-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                                        <span>{{ $heroBadge }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Card: Top Right (Rating) --}}
                        <div class="absolute -top-5 right-2 lg:-right-4 z-30 hidden sm:flex items-center gap-3 rounded-2xl bg-navy/60 backdrop-blur-lg border border-gold/25 px-4 py-3 shadow-xl animate-float-subtle">
                            <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-gold/20 text-gold">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-heading text-sm font-bold text-cream leading-none">4.9/5.0</p>
                                <p class="text-[10px] font-inter text-cream/50 mt-1">980+ Reviews</p>
                            </div>
                        </div>

                        {{-- Floating Card: Bottom Left (Projects) --}}
                        <div class="absolute -bottom-5 left-2 lg:-left-4 z-30 hidden sm:flex items-center gap-3 rounded-2xl bg-navy/70 backdrop-blur-lg border border-gold/25 px-4 py-3 shadow-xl">
                            <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-gold/25 text-gold">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="font-heading text-sm font-bold text-cream leading-none">1.250+</p>
                                <p class="text-[10px] font-inter text-cream/50 mt-1">Projects Done</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
