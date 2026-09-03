@php
    $heroicons = config('heroicons.icons', []);
    $defaultDurations = ['1–2 Hours', '1–3 Days', '3–7 Days', '1–2 Days'];

    $steps = collect($steps ?? [])->map(function ($step, $index) use ($heroicons, $defaultDurations) {
        $step = is_object($step) ? $step : (object) $step;

        $iconKey = $step->icon ?? null;
        $iconSvg = null;

        if ($iconKey && isset($heroicons[$iconKey])) {
            $iconSvg = $heroicons[$iconKey]['svg'];
        } elseif (is_string($step->icon) && str_starts_with(trim($step->icon), 'M')) {
            // legacy: stored raw path d string
            $iconSvg = '<path stroke-linecap="round" stroke-linejoin="round" d="' . e($step->icon) . '" />';
        } else {
            // fallback: first default path
            $iconSvg = '<path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />';
        }

        return [
            'num' => str_pad((string) ($step->step_number ?? $index + 1), 2, '0', STR_PAD_LEFT),
            'title' => $step->title ?? 'Workflow',
            'desc' => $step->description ?? '',
            'duration' => $step->duration ?? $defaultDurations[$index] ?? 'Custom',
            'icon_svg' => $iconSvg,
            'delay' => 100 + ($index * 100),
        ];
    })->values();
@endphp

<div>
@if($steps->isNotEmpty())
<section id="workflow" class="relative overflow-hidden bg-white py-12 md:py-20 lg:py-28">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[280px] h-[280px] md:w-[420px] md:h-[420px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-tl from-navy/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Faint navy dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

<div class="mx-auto px-4 md:px-6 lg:px-8 relative z-10 md:max-w-7xl">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-cream px-3 py-1.5 md:px-4 md:py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1 h-1 md:w-1.5 md:h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.15em] md:tracking-[0.22em] text-navy">Alur Kerja</span>
            </span>
            <h2 class="font-heading mt-4 md:mt-6 text-xl md:text-3xl lg:text-4xl xl:text-5xl font-bold tracking-tight text-navy leading-tight md:leading-[1.12]">Proses Mudah dari Ide <span class="gradient-text">hingga Hasil</span></h2>
            <p class="mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Empat langkah sederhana untuk mewujudkan proyek percetakan dan branding Anda dengan hasil maksimal.</p>
        </div>

        {{-- Workflow Carousel --}}
        <div class="relative mt-8 md:mt-16" x-data="workflowScroll()">
            <div class="hidden lg:block absolute -inset-4 border-2 border-dashed border-gold/30 rounded-[2rem] pointer-events-none"></div>

            <div class="pointer-events-none absolute inset-y-0 left-0 z-20 hidden w-16 md:w-20 bg-gradient-to-r from-white to-transparent lg:block" x-show="canScrollLeft" x-transition></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 z-20 hidden w-16 md:w-20 bg-gradient-to-l from-white to-transparent lg:block" x-show="canScrollRight" x-transition></div>

            <div class="absolute right-2 md:right-4 top-0 z-30 hidden lg:block" x-show="showHint" x-transition>
                <span class="inline-flex items-center rounded-full border border-gold/30 bg-white/80 px-3 py-1.5 text-[10px] font-heading font-semibold uppercase tracking-[0.2em] text-navy shadow-soft backdrop-blur-sm">Geser untuk melihat</span>
            </div>

            <div class="absolute inset-y-0 left-0 z-30 hidden items-center lg:flex">
                <button type="button" x-show="canScrollLeft" x-transition aria-label="Geser ke kiri" @click="scroll(-420)" class="pointer-events-auto flex h-10 w-10 md:h-12 md:w-12 items-center justify-center rounded-full border border-gold/30 bg-white/90 text-navy shadow-soft transition-all duration-300 hover:bg-gold hover:text-navy hover:shadow-button">
                    <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            <div class="absolute inset-y-0 right-0 z-30 hidden items-center lg:flex">
                <button type="button" x-show="canScrollRight" x-transition aria-label="Geser ke kanan" @click="scroll(420)" class="pointer-events-auto flex h-10 w-10 md:h-12 md:w-12 items-center justify-center rounded-full border border-gold/30 bg-white/90 text-navy shadow-soft transition-all duration-300 hover:bg-gold hover:text-navy hover:shadow-button">
                    <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            <div x-ref="scrollContainer" @scroll="updateScrollState()" class="flex gap-3 md:gap-6 overflow-x-auto overflow-y-hidden pb-6 md:pb-8 pt-4 md:pt-6 px-2 md:px-4 lg:px-8 scroll-smooth snap-x snap-mandatory" style="scrollbar-width: thin; scrollbar-color: #D4AF37 transparent;">
                @foreach($steps as $index => $step)
                <div class="group relative flex-shrink-0 w-[240px] sm:w-[280px] md:w-[320px] snap-center flex flex-col items-start justify-start" data-aos="fade-up" data-aos-delay="{{ $step['delay'] }}">
                    <div class="absolute -top-3 -right-3 md:-top-4 md:-right-4 z-20 flex h-8 w-8 md:h-11 md:w-11 items-center justify-center rounded-full border border-gold/30 bg-white text-gold shadow-soft transition-all duration-300 group-hover:bg-gold group-hover:text-navy group-hover:border-gold group-hover:shadow-button group-hover:scale-105">
                        <span class="font-heading text-xs md:text-sm font-bold tracking-wide">{{ $step['num'] }}</span>
                    </div>

                    <div class="relative mt-2 md:mt-4 flex h-full w-full flex-col rounded-lg md:rounded-[1.75rem] border border-white/70 bg-white p-4 md:p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-card-hover">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex h-8 w-8 md:h-11 md:w-11 items-center justify-center rounded-lg md:rounded-xl bg-gold/10 border border-gold/20 text-navy shrink-0 transition-all duration-300 group-hover:bg-gold/15 group-hover:text-gold-dark">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">{!! $step['icon_svg'] !!}</svg>
                            </div>
                            <span class="rounded-full bg-cream px-2 md:px-3 py-1 text-[8px] md:text-[10px] font-heading font-semibold text-ink-soft border border-gold/20 whitespace-nowrap">{{ $step['duration'] }}</span>
                        </div>

                        <div class="mt-3 md:mt-5 flex-1">
                            <h3 class="font-heading text-sm md:text-lg font-bold text-navy">{{ $step['title'] }}</h3>
                            <p class="mt-1 md:mt-2 text-xs md:text-sm font-inter leading-relaxed text-ink-soft">{{ $step['desc'] }}</p>
                        </div>

                        <div class="mt-3 md:mt-5 h-0.5 w-8 md:w-10 rounded-full bg-gold/40 transition-all duration-300 group-hover:w-full group-hover:bg-gradient-to-r group-hover:from-gold group-hover:to-gold-light"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Bottom Trust Strip + CTA (preserved) --}}
        <div class="mt-8 md:mt-14 text-center" data-aos="fade-up">
            <div class="inline-flex flex-col sm:flex-row items-center gap-2 md:gap-4 rounded-full bg-white border border-gold/20 px-4 md:px-8 py-3 md:py-4 shadow-card">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-gold shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-xs md:text-sm font-inter font-medium text-navy">Proses transparan, komunikasi mudah, dan hasil sesuai kebutuhan Anda.</p>
            </div>
            <div class="mt-6 md:mt-8">
                <p class="text-sm md:text-lg font-heading font-semibold text-navy">Need a Custom Printing Solution?</p>
                <p class="mt-1 md:mt-2 text-xs md:text-sm font-inter text-ink-soft">Kami siap membantu mewujudkan proyek cetak dan branding Anda.</p>
                <a href="#contact"
                   class="mt-3 md:mt-5 inline-flex items-center gap-1.5 md:gap-2 rounded-full bg-navy px-4 md:px-8 py-2.5 md:py-3.5 text-xs md:text-sm font-heading font-semibold text-white shadow-button transition-all duration-300 hover:bg-gold hover:text-navy hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50 group">
                    Start Your Project
                    <svg class="w-3 h-3 md:w-4 md:h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endif
</div>

@script
<script>
    function workflowScroll() {
        return {
            canScrollLeft: false,
            canScrollRight: false,
            showHint: true,

            init() {
                this.updateScrollState();

                this.$nextTick(() => {
                    this.updateScrollState();
                });

                setTimeout(() => {
                    this.showHint = false;
                }, 4000);
            },

            updateScrollState() {
                const container = this.$refs.scrollContainer;

                if (!container) {
                    this.canScrollLeft = false;
                    this.canScrollRight = false;
                    return;
                }

                const maxScroll = Math.max(container.scrollWidth - container.clientWidth, 0);
                this.canScrollLeft = container.scrollLeft > 8;
                this.canScrollRight = container.scrollLeft < maxScroll - 8;
            },

            scroll(amount) {
                const container = this.$refs.scrollContainer;

                if (!container) {
                    return;
                }

                container.scrollBy({
                    left: amount,
                    behavior: 'smooth'
                });

                requestAnimationFrame(() => this.updateScrollState());
            }
        }
    }
</script>
@endscript
