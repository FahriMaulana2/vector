<?php
$steps = [
    [
        'num' => '01',
        'title' => 'Consultation',
        'desc' => 'Diskusi kebutuhan, konsep, dan target produksi Anda bersama tim kami untuk memahami visi Anda.',
        'duration' => '1–2 Hours',
        'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
        'delay' => 100,
    ],
    [
        'num' => '02',
        'title' => 'Design',
        'desc' => 'Pembuatan desain visual siap cetak sesuai brief dan brand guideline dengan sentuhan kreatif.',
        'duration' => '1–3 Days',
        'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
        'delay' => 200,
    ],
    [
        'num' => '03',
        'title' => 'Production',
        'desc' => 'Proses cetak dengan mesin modern dan quality control ketat untuk hasil yang sempurna.',
        'duration' => '3–7 Days',
        'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        'delay' => 300,
    ],
    [
        'num' => '04',
        'title' => 'Delivery',
        'desc' => 'Pengiriman tepat waktu dengan packaging aman, siap digunakan untuk kebutuhan bisnis Anda.',
        'duration' => '1–2 Days',
        'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4',
        'delay' => 400,
    ],
];
?>

<section id="workflow" class="relative overflow-hidden bg-[#F7F9FC] py-20 lg:py-24">
    {{-- Subtle background decoration --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[420px] h-[420px] bg-gradient-to-br from-[#0B5ED7]/6 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[380px] h-[380px] bg-gradient-to-tl from-[#FBBF24]/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Thin dotted pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B5ED7 1px, transparent 0); background-size: 36px 36px;"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white border border-[#0B5ED7]/10 px-4 py-1.5 mb-6 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Alur Kerja</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight text-[#0B1E3D] leading-[1.1]">How We Turn Your Ideas <span class="text-[#0B5ED7]">Into Reality</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Empat langkah sederhana untuk mewujudkan proyek percetakan dan branding Anda dengan hasil maksimal.</p>
        </div>

        {{-- Workflow Timeline --}}
        <div class="relative mt-16">
            {{-- Desktop connecting line --}}
            <div class="hidden lg:block absolute top-7 left-[8%] right-[8%] h-0.5 bg-gradient-to-r from-[#0B5ED7]/10 via-[#0B5ED7]/40 to-[#F59E0B]/40 rounded-full"></div>

            {{-- Vertical connecting line (mobile/tablet) --}}
            <div class="lg:hidden absolute left-[27px] top-2 bottom-10 w-0.5 bg-gradient-to-b from-[#0B5ED7]/15 via-[#0B5ED7]/40 to-transparent rounded-full"></div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 sm:gap-5 lg:gap-6 items-start">
                @foreach($steps as $index => $step)
                <div class="group relative flex gap-5 lg:flex-col lg:gap-0" data-aos="fade-up" data-aos-delay="{{ $step['delay'] }}">
                    {{-- Timeline indicator --}}
                    <div class="relative z-10 flex flex-col items-center lg:items-start">
                        <div class="relative">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#0B1E3D] to-[#0B5ED7] text-white shadow-button ring-1 ring-[#0B5ED7]/30 transition-all duration-300 group-hover:scale-105 group-hover:ring-2 group-hover:ring-[#F59E0B]/40">
                                <span class="text-lg font-bold">{{ $step['num'] }}</span>
                            </div>
                            {{-- Gold accent --}}
                            <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 h-1 w-6 rounded-full bg-gradient-to-r from-[#FBBF24] to-[#F59E0B] lg:-left-1 lg:translate-x-0 lg:left-auto lg:right-0"></div>
                        </div>
                    </div>

                    {{-- Card content --}}
                    <div class="flex-1 min-w-0 lg:mt-6">
                        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover hover:border-[#0B5ED7]/20 h-full">
                            {{-- Icon + duration row --}}
                            <div class="flex items-center justify-between">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7] transition-transform duration-300 group-hover:scale-105 {{ $index === 2 ? 'bg-[#FBBF24]/15 text-[#D97706]' : '' }}">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                                    </svg>
                                </div>
                                <span class="rounded-full bg-slate-50 px-3 py-1 text-[10px] font-semibold text-slate-400 border border-slate-100">{{ $step['duration'] }}</span>
                            </div>

                            {{-- Step label --}}
                            <div class="mt-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#0B5ED7]/5 px-3 py-1 text-[11px] font-bold text-[#0B5ED7] border border-[#0B5ED7]/10">
                                    Step {{ $step['num'] }}
                                </span>
                            </div>

                            <h3 class="mt-3 text-xl font-bold text-[#0B1E3D]">{{ $step['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $step['desc'] }}</p>

                            {{-- Progress line --}}
                            <div class="mt-5 h-0.5 w-8 rounded-full bg-[#0B5ED7]/15 transition-all duration-500 group-hover:w-full group-hover:bg-gradient-to-r group-hover:from-[#0B5ED7] group-hover:to-[#F59E0B]"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Bottom CTA (preserved) --}}
        <div class="mt-16 text-center" data-aos="fade-up">
            <p class="text-lg font-semibold text-[#0B1E3D]">Need a Custom Printing Solution?</p>
            <p class="mt-2 text-sm text-slate-500">Kami siap membantu mewujudkan proyek cetak dan branding Anda.</p>
            <a href="#contact"
               class="mt-5 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#0B5ED7] to-[#0B1E3D] px-8 py-3.5 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 group">
                Start Your Project
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
