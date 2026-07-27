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

<section id="workflow" class="relative overflow-hidden bg-white">
    {{-- Single subtle background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 right-1/3 w-[400px] h-[400px] bg-gradient-to-bl from-[#0B5ED7]/3 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Work Process</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight text-slate-950 leading-[1.1]">How We Turn Your Ideas <span class="text-[#0B5ED7]">Into Reality</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Empat langkah sederhana untuk mewujudkan proyek percetakan dan branding Anda dengan hasil maksimal.</p>
        </div>

        {{-- Steps Grid --}}
        <div class="relative mt-12">
            {{-- Desktop Connector Line --}}
            <div class="hidden lg:block absolute top-[68px] left-[10%] right-[10%] h-px bg-gradient-to-r from-transparent via-[#0B5ED7]/20 to-transparent"></div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($steps as $step)
                <div class="group relative" data-aos="fade-up" data-aos-delay="{{ $step['delay'] }}">
                    <div class="relative rounded-2xl border border-slate-100 bg-white p-8 shadow-card transition-all duration-500 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-[#0B5ED7]/20 h-full flex flex-col z-10 overflow-hidden">
                        {{-- Background number --}}
                        <div class="absolute -top-4 -right-4 text-[100px] font-bold leading-none text-[#0B5ED7]/[0.04] select-none pointer-events-none">
                            {{ $step['num'] }}
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7] transition-all duration-500 group-hover:bg-[#0B5ED7] group-hover:text-white relative z-10">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                            </svg>
                        </div>

                        <div class="mt-4 flex items-center gap-3">
                            <span class="inline-flex items-center justify-center rounded-full bg-[#0B5ED7]/10 px-3 py-1 text-[11px] font-bold text-[#0B5ED7]">
                                Step {{ $step['num'] }}
                            </span>
                            <span class="text-[11px] text-slate-400 font-medium">{{ $step['duration'] }}</span>
                        </div>

                        <h3 class="mt-4 text-xl font-semibold text-slate-950">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500 flex-1">{{ $step['desc'] }}</p>

                        <div class="mt-5 h-0.5 w-8 rounded-full bg-[#0B5ED7]/20 transition-all duration-500 group-hover:w-full group-hover:bg-[#0B5ED7]"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-12 text-center" data-aos="fade-up">
            <p class="text-lg font-semibold text-slate-900">Need a Custom Printing Solution?</p>
            <p class="mt-2 text-sm text-slate-500">Kami siap membantu mewujudkan proyek cetak dan branding Anda.</p>
            <a href="#contact"
               class="mt-5 inline-flex items-center gap-2 rounded-full bg-[#0B5ED7] px-8 py-3.5 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 group">
                Start Your Project
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

