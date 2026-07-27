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
    class="relative bg-white overflow-hidden"
    style="min-height: 780px;">
    {{-- Single subtle radial gradient --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-200px] right-[-200px] w-[500px] h-[500px] bg-gradient-to-br from-[#0B5ED7]/4 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 flex items-center h-full min-h-[780px] pt-[80px]">
        <div class="w-full max-w-7xl mx-auto px-5 md:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[0.48fr_0.52fr] gap-12 lg:gap-16 xl:gap-20 items-center">
                {{-- Left Content --}}
                <div class="space-y-8 pt-8 lg:pt-0" data-aos="fade-right" data-aos-delay="100">
                    {{-- Section Label --}}
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Digital Printing &amp; Branding</span>
                        </span>
                    </div>

                    {{-- Heading --}}
                    <div class="space-y-4">
                        <h1 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight text-slate-950 leading-[1.1]">
                            Cetak Berkualitas<br />
                            untuk<br />
                            <span class="text-[#0B5ED7]">Bisnis Modern</span>
                        </h1>
                        <p class="max-w-2xl text-base lg:text-lg leading-relaxed text-slate-400">
                            Dari banner, sticker, undangan, hingga merchandise custom &mdash; solusi digital printing dan branding profesional untuk bisnis Anda.
                        </p>
                    </div>

                    {{-- CTAs --}}
                    <div class="flex flex-wrap gap-3">
                        <a href="#contact"
                           class="group inline-flex items-center justify-center rounded-full bg-[#0B5ED7] px-7 py-3.5 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                            <span class="flex items-center gap-2">
                                Konsultasi Gratis
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </a>
                        <a href="#portfolio"
                           class="group inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-slate-600 transition-all duration-300 hover:border-[#0B5ED7]/30 hover:text-[#0B5ED7] hover:shadow-soft hover:-translate-y-0.5 active:translate-y-0">
                            Lihat Portofolio
                        </a>
                    </div>

                    {{-- Statistics --}}
                    <div class="grid grid-cols-3 gap-6 pt-6 border-t border-slate-100">
                        <div data-aos="fade-up" data-aos-delay="200">
                            <p class="text-2xl font-bold text-slate-950">1.250+</p>
                            <p class="text-xs text-slate-400 mt-0.5 uppercase tracking-wider font-medium">Projects</p>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="300">
                            <p class="text-2xl font-bold text-slate-950">980+</p>
                            <p class="text-xs text-slate-400 mt-0.5 uppercase tracking-wider font-medium">Clients</p>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="400">
                            <p class="text-2xl font-bold text-slate-950">24-48 Jam</p>
                            <p class="text-xs text-slate-400 mt-0.5 uppercase tracking-wider font-medium">Delivery</p>
                        </div>
                    </div>
                </div>

                {{-- Right Content --}}
                <div class="relative" data-aos="fade-left" data-aos-delay="200"
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

                    {{-- Image Frame --}}
                    <div class="relative rounded-[2rem] overflow-hidden shadow-card-hover bg-slate-50">
                        <div class="relative aspect-[4/5] lg:aspect-[3/4] w-full overflow-hidden">
                            @foreach($slides as $index => $slide)
                            <img src="{{ $slide['img'] }}"
                                 alt="{{ $slide['alt'] }}"
                                 class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 ease-in-out"
                                 :class="{ 'opacity-100 scale-100 z-10': current === {{ $index }}, 'opacity-0 scale-105 z-0': current !== {{ $index }} }" />
                            @endforeach
                        </div>
                    </div>

                    {{-- Slider Controls --}}
                    <div class="mt-5 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            @foreach($slides as $index => $slide)
                            <button @click="goTo({{ $index }})"
                                    class="h-2 rounded-full transition-all duration-300"
                                    :class="current === {{ $index }} ? 'w-6 bg-[#0B5ED7]' : 'w-2 bg-slate-300 hover:bg-slate-400'">
                            </button>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="prev()"
                                    class="flex items-center justify-center w-9 h-9 rounded-full border border-slate-200 bg-white text-slate-400 transition-all duration-200 hover:bg-[#0B5ED7] hover:text-white hover:border-[#0B5ED7] active:scale-90">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="next()"
                                    class="flex items-center justify-center w-9 h-9 rounded-full border border-slate-200 bg-white text-slate-400 transition-all duration-200 hover:bg-[#0B5ED7] hover:text-white hover:border-[#0B5ED7] active:scale-90">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

