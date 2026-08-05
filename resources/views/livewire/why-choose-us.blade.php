<?php
$reasons = [
    [
        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
        'title' => 'High Quality Printing',
        'desc' => 'Kami menggunakan material premium dan tinta berkualitas tinggi untuk hasil cetak yang tajam, tahan lama, dan warna akurat.',
        'delay' => 100,
    ],
    [
        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
        'title' => 'Fast Turnaround',
        'desc' => 'Proses produksi cepat dengan timeline yang jelas. Pesanan Anda selesai tepat waktu tanpa mengorbankan kualitas.',
        'delay' => 200,
    ],
    [
        'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z',
        'title' => 'Professional Design',
        'desc' => 'Tim desainer berpengalaman siap mengoptimalkan brand Anda dengan desain kreatif yang sesuai identitas bisnis.',
        'delay' => 300,
    ],
    [
        'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'title' => 'Affordable Pricing',
        'desc' => 'Harga kompetitif tanpa mengorbankan kualitas. Dapatkan solusi cetak dan branding terbaik dengan budget optimal.',
        'delay' => 400,
    ],
    [
        'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
        'title' => 'Responsive Support',
        'desc' => 'Tim customer service siap membantu Anda dari konsultasi, desain, produksi, hingga pengiriman dengan respons cepat.',
        'delay' => 500,
    ],
    [
        'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
        'title' => 'Premium Equipment',
        'desc' => 'Peralatan modern dan teknologi cetak terkini memastikan setiap detail tercetak sempurna dan konsisten.',
        'delay' => 600,
    ],
];
?>

<section id="why-choose-us" class="relative overflow-hidden py-20 lg:py-24 text-white">
    {{-- Layered dark navy background (z-0, behind content) --}}
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-[#07182F] via-[#0B1E3D] to-[#0F2646]"></div>

    {{-- Depth glows (behind content) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-120px] right-[-80px] w-[520px] h-[520px] rounded-full bg-[#0B5ED7]/20 blur-3xl"></div>
        <div class="absolute bottom-[-140px] left-[-80px] w-[460px] h-[460px] rounded-full bg-[#FBBF24]/10 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[760px] h-[760px] rounded-full bg-[#2563EB]/8 blur-3xl"></div>
    </div>

    {{-- Subtle dot pattern (behind content) --}}
    <div class="absolute inset-0 z-0 opacity-[0.05] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #ffffff 1px, transparent 0); background-size: 40px 40px;"></div>

    {{-- Thin gold accent line top (behind content) --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-[#FBBF24]/40 to-transparent pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-[0.9fr_1.1fr] gap-14 lg:gap-16 items-start">
            {{-- Left Column --}}
            <div class="space-y-8 lg:sticky lg:top-28" data-aos="fade-right">
                <div class="space-y-5">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/[0.06] px-4 py-1.5 border border-white/10 backdrop-blur-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#FBBF24]"></span>
                        <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#FBBF24]">Why Choose Us</span>
                    </span>
                    <h2 class="text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight leading-[1.1] text-white">
                        Why Businesses Trust <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FBBF24] via-[#FCD34D] to-[#F59E0B]">OMH Vector</span>
                    </h2>
                    <p class="max-w-xl text-base lg:text-lg leading-relaxed text-white/65">Kami berkomitmen memberikan layanan percetakan dan branding terbaik untuk setiap klien.</p>
                </div>

                {{-- Trust Panel (existing statistics) --}}
                <div class="rounded-2xl border border-white/10 bg-white/[0.04] backdrop-blur-sm p-6">
                    <div class="h-0.5 w-10 rounded-full bg-gradient-to-r from-[#FBBF24] to-[#F59E0B] mb-5"></div>
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4 lg:grid-cols-2 xl:grid-cols-4">
                        <div>
                            <p class="text-2xl sm:text-3xl font-bold text-white">980+</p>
                            <p class="mt-1 text-xs text-white/40 uppercase tracking-wider">Satisfied Clients</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-bold text-white">1.250+</p>
                            <p class="mt-1 text-xs text-white/40 uppercase tracking-wider">Completed Projects</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-bold text-[#FBBF24]">6+</p>
                            <p class="mt-1 text-xs text-white/40 uppercase tracking-wider">Years Experience</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-bold text-white">99%</p>
                            <p class="mt-1 text-xs text-white/40 uppercase tracking-wider">On-time Delivery</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Feature Cards --}}
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($reasons as $index => $reason)
                <div class="group relative rounded-2xl border border-white/10 bg-white/[0.06] p-6 backdrop-blur-sm transition-all duration-500 hover:-translate-y-1 hover:bg-white/[0.09] hover:shadow-xl {{ $index === 2 ? 'hover:border-[#FBBF24]/30' : 'hover:border-[#0B5ED7]/40' }}"
                     data-aos="fade-up"
                     data-aos-delay="{{ $reason['delay'] }}">
                    <div class="flex items-start gap-4">
                        @php $isGold = $index === 0 || $index === 3; @endphp
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $isGold ? 'bg-[#FBBF24]/20 text-[#FBBF24] group-hover:bg-[#FBBF24]' : 'bg-[#0B5ED7]/20 text-white group-hover:bg-[#0B5ED7]' }} transition-all duration-500 group-hover:scale-105 group-hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $reason['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-white">{{ $reason['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-white/60">{{ $reason['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
