<?php
$reasons = $reasons ?? [];
?>

<section id="why-choose-us" class="relative overflow-hidden bg-navy text-white">
    {{-- Layered dark navy background (z-0, behind content) --}}
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-navy-dark via-navy to-navy-deep"></div>

    {{-- Depth glows (behind content) - scaled for mobile --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-80px] right-[-60px] w-[300px] h-[300px] md:w-[520px] md:h-[520px] rounded-full bg-gold/8 blur-3xl"></div>
        <div class="absolute bottom-[-100px] left-[-60px] w-[280px] h-[280px] md:w-[460px] md:h-[460px] rounded-full bg-gold/6 blur-3xl"></div>
        <div class="hidden md:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[760px] h-[760px] rounded-full bg-navy-deep/40 blur-3xl"></div>
    </div>

    {{-- Faint gold dot pattern (behind content) --}}
    <div class="absolute inset-0 z-0 opacity-[0.05] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #D6A83D 1px, transparent 0); background-size: 40px 40px;"></div>

    {{-- Thin decorative gold lines (behind content) - hidden on mobile --}}
    <div class="absolute inset-0 z-0 pointer-events-none hidden md:block">
        <div class="absolute top-0 left-0 h-px w-full bg-gradient-to-r from-transparent via-gold/40 to-transparent"></div>
        <div class="absolute left-0 top-0 h-40 w-px bg-gradient-to-b from-transparent via-gold/20 to-transparent"></div>
        <div class="absolute right-0 top-0 h-40 w-px bg-gradient-to-b from-transparent via-gold/20 to-transparent"></div>
    </div>

    <div class="mx-auto px-4 md:px-6 lg:px-8 py-12 md:py-20 lg:py-28 relative z-10 md:max-w-7xl">
        {{-- Section Header (centered) --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/[0.06] px-3 py-1.5 md:px-4 md:py-1.5 border border-gold/25 backdrop-blur-sm">
                <span class="w-1 h-1 md:w-1.5 md:h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.15em] md:tracking-[0.22em] text-gold">Mengapa Memilih Kami</span>
            </span>
            <h2 class="font-heading mt-4 md:mt-6 text-xl md:text-4xl lg:text-5xl font-bold tracking-tight leading-tight md:leading-[1.1] text-cream">Alasan Tepat Memilih OMH Vector sebagai <span class="gradient-text">Partner Kreatif Anda</span></h2>
            <p class="mt-3 md:mt-5 max-w-2xl mx-auto text-sm md:text-base lg:text-lg font-inter leading-relaxed text-white/60">Kami berkomitmen memberikan layanan percetakan dan branding terbaik untuk setiap klien.</p>
        </div>

        {{-- Advantage Cards Grid (3-col desktop / 2-col tablet / 1-col mobile) --}}
        <div class="mt-8 md:mt-16 grid gap-3 md:gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($reasons as $reason)
            <div class="group relative flex flex-col rounded-lg md:rounded-[1.75rem] border border-white/10 bg-white/[0.05] p-4 md:p-8 backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.08] hover:border-gold/30 hover:shadow-card-hover"
                 data-aos="fade-up"
                 data-aos-delay="{{ $reason['delay'] }}">

                {{-- Icon container - smaller on mobile --}}
                <div class="flex h-10 w-10 md:h-14 md:w-14 items-center justify-center rounded-lg md:rounded-2xl bg-gold/10 border border-gold/20 text-gold transition-all duration-300 group-hover:bg-gold group-hover:text-navy group-hover:scale-105 group-hover:shadow-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $reason['icon'] }}"/>
                    </svg>
                </div>

                {{-- Content --}}
                <div class="mt-4 md:mt-6 flex-1">
                    <h3 class="font-heading text-sm md:text-lg font-bold text-cream">{{ $reason['title'] }}</h3>
                    <p class="mt-2 md:mt-2.5 text-xs md:text-sm font-inter leading-relaxed text-white/60">{{ $reason['desc'] }}</p>
                </div>

                {{-- Gold decorative line (expands on hover) --}}
                <div class="mt-4 md:mt-6 h-0.5 w-8 md:w-10 rounded-full bg-gold/40 transition-all duration-300 group-hover:w-12 md:group-hover:w-16 group-hover:bg-gold"></div>
            </div>
            @endforeach
        </div>

        {{-- Trust Strip (preserved statistics) --}}
        <div class="mt-8 md:mt-16 rounded-lg md:rounded-[1.75rem] border border-white/10 bg-white/[0.04] backdrop-blur-sm p-6 md:p-10 lg:p-10" data-aos="fade-up">
            <div class="h-0.5 w-10 md:w-12 rounded-full bg-gradient-to-r from-gold to-gold-light mb-6 md:mb-8"></div>
            <div class="grid grid-cols-2 gap-4 md:gap-8 sm:grid-cols-4">
                <div class="text-center sm:text-left">
                    <p class="font-heading text-lg sm:text-2xl md:text-3xl font-bold text-cream">980+</p>
                    <p class="mt-1 text-[10px] sm:text-xs font-inter text-white/40 uppercase tracking-wider">Satisfied Clients</p>
                </div>
                <div class="text-center sm:text-left">
                    <p class="font-heading text-lg sm:text-2xl md:text-3xl font-bold text-cream">1.250+</p>
                    <p class="mt-1 text-[10px] sm:text-xs font-inter text-white/40 uppercase tracking-wider">Completed Projects</p>
                </div>
                <div class="text-center sm:text-left">
                    <p class="font-heading text-lg sm:text-2xl md:text-3xl font-bold text-gold">6+</p>
                    <p class="mt-1 text-[10px] sm:text-xs font-inter text-white/40 uppercase tracking-wider">Years Experience</p>
                </div>
                <div class="text-center sm:text-left">
                    <p class="font-heading text-lg sm:text-2xl md:text-3xl font-bold text-cream">99%</p>
                    <p class="mt-1 text-[10px] sm:text-xs font-inter text-white/40 uppercase tracking-wider">On-time Delivery</p>
                </div>
            </div>
        </div>
    </div>
</section>
