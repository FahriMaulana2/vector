<?php
$slides = [
    [
        'img' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=900&q=80',
        'alt' => 'Digital printing equipment in modern office',
        'label' => 'Offset & Digital Printing',
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1566491561884-8969e5bb19d9?auto=format&fit=crop&w=900&q=80',
        'alt' => 'Creative studio workspace with design tools',
        'label' => 'Creative Studio Workspace',
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1516387938699-a93567ec168e?auto=format&fit=crop&w=900&q=80',
        'alt' => 'Premium custom packaging products',
        'label' => 'Premium Packaging',
    ],
];
?>

<section id="home"
    class="relative overflow-hidden bg-[#0B1E3D]"
    style="min-height: 640px;">
{{-- Layered navy background (z-0, behind content) --}}
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-[#0B1E3D] via-[#0F2646] to-[#0B5ED7]/20"></div>

    {{-- Decorative glow orbs (behind content, never intercept clicks) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-180px] right-[-120px] w-[520px] h-[520px] rounded-full bg-[#0B5ED7]/25 blur-3xl"></div>
        <div class="absolute bottom-[-200px] left-[-120px] w-[460px] h-[460px] rounded-full bg-[#FBBF24]/10 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[820px] h-[820px] rounded-full bg-[#2563EB]/10 blur-3xl"></div>
    </div>

    {{-- Subtle grid / dot pattern overlay (behind content) --}}
    <div class="absolute inset-0 z-0 opacity-[0.05] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #ffffff 1px, transparent 0); background-size: 38px 38px;"></div>

    {{-- Decorative thin lines (behind content) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute left-0 top-0 h-full w-px bg-gradient-to-b from-transparent via-white/5 to-transparent"></div>
        <div class="absolute right-8 top-0 h-40 w-px bg-gradient-to-b from-transparent via-[#FBBF24]/30 to-transparent"></div>
    </div>

<div class="relative z-10 flex items-center h-full min-h-[640px] pt-[80px] lg:pt-[96px]">
        <div class="w-full max-w-7xl mx-auto px-5 md:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[0.5fr_0.5fr] gap-14 lg:gap-16 xl:gap-20 items-center">
                {{-- Left Content --}}
                <div class="space-y-8 pt-8 lg:pt-0" data-aos="fade-right" data-aos-delay="100">
                    {{-- Section Label / Badge --}}
                    <div>
                        <span class="inline-flex items-center gap-2.5 rounded-full bg-white/[0.06] px-4 py-2 border border-white/10 backdrop-blur-sm">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full rounded-full bg-[#FBBF24] opacity-75 animate-ping"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#FBBF24]"></span>
                            </span>
                            <span class="text-xs font-semibold uppercase tracking-[0.22em] text-[#FBBF24]">Digital Printing &amp; Branding</span>
                            <svg class="w-3.5 h-3.5 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>

                    {{-- Heading --}}
                    <div class="space-y-4">
                        <h1 class="text-4xl md:text-5xl lg:text-[54px] xl:text-[58px] font-bold tracking-tight text-white leading-[1.08]">
                            Cetak Berkualitas<br />
                            untuk<br />
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FBBF24] via-[#FCD34D] to-[#F59E0B]">Bisnis Modern</span>
                        </h1>
                        <p class="max-w-2xl text-base lg:text-lg leading-relaxed text-white/55">
                            Dari banner, sticker, undangan, hingga merchandise custom &mdash; solusi digital printing dan branding profesional untuk bisnis Anda.
                        </p>
                    </div>

{{-- CTAs (relative z-20, always above decorative layers) --}}
                    <div class="relative z-20 flex flex-wrap gap-3">
                        <a href="#contact"
                           class="group inline-flex items-center justify-center rounded-full bg-gradient-to-r from-[#FBBF24] to-[#F59E0B] px-7 py-3.5 text-sm font-bold text-[#0B1E3D] shadow-[0_10px_30px_rgba(251,191,36,0.35)] transition-all duration-300 hover:shadow-[0_14px_40px_rgba(251,191,36,0.45)] hover:-translate-y-0.5 active:translate-y-0">
                            <span class="flex items-center gap-2">
                                Konsultasi Gratis
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </a>
                        <a href="#portfolio"
                           class="group inline-flex items-center justify-center rounded-full border border-white/15 bg-white/[0.04] backdrop-blur-sm px-7 py-3.5 text-sm font-semibold text-white transition-all duration-300 hover:border-[#FBBF24]/40 hover:bg-white/[0.08] hover:shadow-soft hover:-translate-y-0.5 active:translate-y-0">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#FBBF24]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 5h-1.5l-1.707-1.707A1 1 0 0015.172 3H8.828a1 1 0 00-.707.293L6.5 5H5a3 3 0 00-3 3v9a3 3 0 003 3h14a3 3 0 003-3V8a3 3 0 00-3-3zm-7 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/></svg>
                                Lihat Portofolio
                            </span>
                        </a>
                    </div>

                    {{-- Statistics --}}
                    <div class="grid grid-cols-3 gap-6 pt-6 border-t border-white/10">
                        <div data-aos="fade-up" data-aos-delay="200">
                            <p class="text-2xl font-bold text-white">1.250+</p>
                            <p class="text-xs text-white/40 mt-1 uppercase tracking-wider font-medium">Projects</p>
                        </div>
                        <div class="hidden sm:block text-center" data-aos="fade-up" data-aos-delay="300">
                            <p class="text-2xl font-bold text-white">980+</p>
                            <p class="text-xs text-white/40 mt-1 uppercase tracking-wider font-medium">Clients</p>
                        </div>
                        <div class="text-right" data-aos="fade-up" data-aos-delay="400">
                            <p class="text-2xl font-bold text-[#FBBF24]">24-48 Jam</p>
                            <p class="text-xs text-white/40 mt-1 uppercase tracking-wider font-medium">Delivery</p>
                        </div>
                    </div>
                </div>

{{-- Right Content --}}
                <div class="relative z-10 lg:pl-4" data-aos="fade-left" data-aos-delay="200"
                     x-data="{
                        current: 0,
                        images: {{ json_encode(array_column($slides, 'img')) }},
                        interval: null,
                        init() { this.start(); },
                        start() { this.interval = setInterval(() => { this.next(); }, 5000); },
                        stop() { clearInterval(this.interval); },
                        next() { this.current = (this.current + 1) % this.images.length; },
                        prev() { this.current = (this.current - 1 + this.images.length) % this.images.length; },
                        goTo(i) { this.current = i; }
                     }"
                     @mouseenter="stop()"
                     @mouseleave="start()">

{{-- Glow behind image --}}
                    <div class="absolute -inset-6 rounded-[2.5rem] bg-gradient-to-br from-[#0B5ED7]/30 to-[#FBBF24]/10 blur-2xl opacity-70 pointer-events-none"></div>

                    {{-- Image + Floating Cards wrapper (relative anchor) --}}
                    <div class="relative">
                        {{-- Image Frame --}}
                        <div class="relative rounded-[2rem] overflow-hidden shadow-2xl ring-1 ring-white/10 bg-[#0F2646]">
                            <div class="relative aspect-[4/5] lg:aspect-[3/4] w-full overflow-hidden">
                                @foreach($slides as $index => $slide)
                                <img src="{{ $slide['img'] }}"
                                     alt="{{ $slide['alt'] }}"
                                     class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 ease-in-out"
                                     :class="{ 'opacity-100 scale-100 z-10': current === {{ $index }}, 'opacity-0 scale-105 z-0': current !== {{ $index }} }" />
                                @endforeach

                                {{-- Bottom gradient overlay --}}
                                <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-[#0B1E3D]/80 to-transparent z-20"></div>

                                {{-- Slide label --}}
                                <div class="absolute bottom-5 left-5 z-30">
                                    <span x-text="images.length ? '{{ $slides[0]['label'] }}' : ''"
                                          class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur-md px-4 py-1.5 text-[11px] font-semibold text-white border border-white/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#FBBF24]"></span>
                                        <span>Digital Printing</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Card: Top Right (Rating) --}}
                        <div class="absolute -top-5 right-2 lg:-right-4 z-30 hidden sm:flex items-center gap-3 rounded-2xl bg-white/[0.08] backdrop-blur-lg border border-white/15 px-4 py-3 shadow-xl animate-float-subtle">
                            <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-[#FBBF24]/15 text-[#FBBF24]">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white leading-none">4.9/5.0</p>
                                <p class="text-[10px] text-white/50 mt-1">980+ Reviews</p>
                            </div>
                        </div>

                        {{-- Floating Card: Bottom Left (Projects) --}}
                        <div class="absolute -bottom-6 left-2 lg:-left-4 z-30 hidden sm:flex items-center gap-3 rounded-2xl bg-white/[0.08] backdrop-blur-lg border border-white/15 px-4 py-3 shadow-xl">
                            <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-[#0B5ED7]/40 text-white">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white leading-none">1.250+</p>
                                <p class="text-[10px] text-white/50 mt-1">Projects Done</p>
                            </div>
                        </div>
                    </div>

{{-- Slider Controls (relative z-20, above glow + floating cards) --}}
                    <div class="relative z-20 mt-6 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            @foreach($slides as $index => $slide)
                            <button @click="goTo({{ $index }})"
                                    class="h-2 rounded-full transition-all duration-300"
                                    :class="current === {{ $index }} ? 'w-7 bg-[#FBBF24]' : 'w-2 bg-white/20 hover:bg-white/40'">
                            </button>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="prev()"
                                    class="flex items-center justify-center w-9 h-9 rounded-full border border-white/15 bg-white/[0.06] text-white/60 transition-all duration-200 hover:bg-[#FBBF24] hover:text-[#0B1E3D] hover:border-[#FBBF24] active:scale-90">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="next()"
                                    class="flex items-center justify-center w-9 h-9 rounded-full border border-white/15 bg-white/[0.06] text-white/60 transition-all duration-200 hover:bg-[#FBBF24] hover:text-[#0B1E3D] hover:border-[#FBBF24] active:scale-90">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
