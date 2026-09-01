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
<section id="workflow" class="relative overflow-hidden bg-cream py-20 lg:py-28">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[420px] h-[420px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[380px] h-[380px] bg-gradient-to-tl from-navy/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Faint navy dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-navy">Alur Kerja</span>
            </span>
            <h2 class="font-heading mt-6 text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-navy leading-[1.12]">Proses Mudah dari Ide <span class="gradient-text">hingga Hasil</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Empat langkah sederhana untuk mewujudkan proyek percetakan dan branding Anda dengan hasil maksimal.</p>
        </div>

        {{-- Workflow Timeline --}}
        <div class="relative mt-16">
            {{-- Desktop connecting line (lg+) --}}
            <div class="hidden lg:block absolute top-6 left-[8%] right-[8%] h-0.5 bg-gradient-to-r from-navy/10 via-navy/30 to-gold/40 rounded-full"></div>

            {{-- Vertical connecting line (mobile/tablet) --}}
            <div class="lg:hidden absolute left-[27px] top-2 bottom-10 w-0.5 bg-gradient-to-b from-navy/10 via-navy/30 to-gold/40 rounded-full"></div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 items-start">
                @foreach($steps as $index => $step)
                <div class="group relative flex flex-col items-start justify-start w-full" data-aos="fade-up" data-aos-delay="{{ $step['delay'] }}">
                    {{-- Timeline indicator (step number) --}}
                    <div class="relative z-10 mb-5 flex items-center justify-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full border border-gold/30 bg-cream text-gold shadow-soft transition-all duration-300 group-hover:bg-gold group-hover:text-navy group-hover:border-gold group-hover:shadow-button group-hover:scale-105">
                            <span class="font-heading text-sm font-bold tracking-wide">{{ $step['num'] }}</span>
                        </div>
                    </div>

                    {{-- Step card --}}
                    <div class="relative flex h-full w-full flex-col rounded-[1.75rem] border border-white/70 bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-card-hover">
                        {{-- Icon + duration row --}}
                        <div class="flex items-center justify-between">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gold/10 border border-gold/20 text-navy transition-all duration-300 group-hover:bg-gold/15 group-hover:text-gold-dark">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">{!! $step['icon_svg'] !!}</svg>
                            </div>
                            <span class="rounded-full bg-cream px-3 py-1 text-[10px] font-heading font-semibold text-ink-soft border border-gold/20">{{ $step['duration'] }}</span>
                        </div>

                        {{-- Content --}}
                        <div class="mt-5 flex-1">
                            <h3 class="font-heading text-lg font-bold text-navy">{{ $step['title'] }}</h3>
                            <p class="mt-2 text-sm font-inter leading-relaxed text-ink-soft">{{ $step['desc'] }}</p>
                        </div>

                        {{-- Gold decorative line --}}
                        <div class="mt-5 h-0.5 w-10 rounded-full bg-gold/40 transition-all duration-300 group-hover:w-full group-hover:bg-gradient-to-r group-hover:from-gold group-hover:to-gold-light"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Bottom Trust Strip + CTA (preserved) --}}
        <div class="mt-14 text-center" data-aos="fade-up">
            <div class="inline-flex flex-col sm:flex-row items-center gap-4 rounded-full bg-white border border-gold/20 px-8 py-4 shadow-card">
                <svg class="w-5 h-5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm font-inter font-medium text-navy">Proses transparan, komunikasi mudah, dan hasil sesuai kebutuhan Anda.</p>
            </div>
            <div class="mt-8">
                <p class="text-lg font-heading font-semibold text-navy">Need a Custom Printing Solution?</p>
                <p class="mt-2 text-sm font-inter text-ink-soft">Kami siap membantu mewujudkan proyek cetak dan branding Anda.</p>
                <a href="#contact"
                   class="mt-5 inline-flex items-center gap-2 rounded-full bg-navy px-8 py-3.5 text-sm font-heading font-semibold text-white shadow-button transition-all duration-300 hover:bg-gold hover:text-navy hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50 group">
                    Start Your Project
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endif
</div>
