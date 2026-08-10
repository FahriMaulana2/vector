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

<section id="why-choose-us" class="relative overflow-hidden bg-navy text-white">
    {{-- Layered dark navy background (z-0, behind content) --}}
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-navy-dark via-navy to-navy-deep"></div>

    {{-- Depth glows (behind content) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-120px] right-[-80px] w-[520px] h-[520px] rounded-full bg-gold/8 blur-3xl"></div>
        <div class="absolute bottom-[-140px] left-[-80px] w-[460px] h-[460px] rounded-full bg-gold/6 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[760px] h-[760px] rounded-full bg-navy-deep/40 blur-3xl"></div>
    </div>

    {{-- Faint gold dot pattern (behind content) --}}
    <div class="absolute inset-0 z-0 opacity-[0.05] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #D6A83D 1px, transparent 0); background-size: 40px 40px;"></div>

    {{-- Thin decorative gold lines (behind content) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-0 h-px w-full bg-gradient-to-r from-transparent via-gold/40 to-transparent"></div>
        <div class="absolute left-0 top-0 h-40 w-px bg-gradient-to-b from-transparent via-gold/20 to-transparent"></div>
        <div class="absolute right-0 top-0 h-40 w-px bg-gradient-to-b from-transparent via-gold/20 to-transparent"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 py-20 lg:py-28 relative z-10">
        {{-- Section Header (centered) --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/[0.06] px-4 py-1.5 border border-gold/25 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-gold">Mengapa Memilih Kami</span>
            </span>
            <h2 class="font-heading mt-6 text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight leading-[1.1] text-cream">Alasan Tepat Memilih OMH Vector sebagai <span class="gradient-text">Partner Kreatif Anda</span></h2>
            <p class="mt-5 max-w-2xl mx-auto text-base lg:text-lg font-inter leading-relaxed text-white/60">Kami berkomitmen memberikan layanan percetakan dan branding terbaik untuk setiap klien.</p>
        </div>

        {{-- Advantage Cards Grid (3-col desktop / 2-col tablet / 1-col mobile) --}}
        <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($reasons as $reason)
            <div class="group relative flex flex-col rounded-[1.75rem] border border-white/10 bg-white/[0.05] p-8 backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.08] hover:border-gold/30 hover:shadow-card-hover"
                 data-aos="fade-up"
                 data-aos-delay="{{ $reason['delay'] }}">

                {{-- Icon container --}}
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gold/10 border border-gold/20 text-gold transition-all duration-300 group-hover:bg-gold group-hover:text-navy group-hover:scale-105 group-hover:shadow-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $reason['icon'] }}"/>
                    </svg>
                </div>

                {{-- Content --}}
                <div class="mt-6 flex-1">
                    <h3 class="font-heading text-lg font-bold text-cream">{{ $reason['title'] }}</h3>
                    <p class="mt-2.5 text-sm font-inter leading-relaxed text-white/60">{{ $reason['desc'] }}</p>
                </div>

                {{-- Gold decorative line (expands on hover) --}}
                <div class="mt-6 h-0.5 w-10 rounded-full bg-gold/40 transition-all duration-300 group-hover:w-16 group-hover:bg-gold"></div>
            </div>
            @endforeach
        </div>

        {{-- Trust Strip (preserved statistics) --}}
        <div class="mt-16 rounded-[1.75rem] border border-white/10 bg-white/[0.04] backdrop-blur-sm p-8 lg:p-10" data-aos="fade-up">
            <div class="h-0.5 w-12 rounded-full bg-gradient-to-r from-gold to-gold-light mb-8"></div>
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-4">
                <div class="text-center sm:text-left">
                    <p class="font-heading text-2xl sm:text-3xl font-bold text-cream">980+</p>
                    <p class="mt-1 text-xs font-inter text-white/40 uppercase tracking-wider">Satisfied Clients</p>
                </div>
                <div class="text-center sm:text-left">
                    <p class="font-heading text-2xl sm:text-3xl font-bold text-cream">1.250+</p>
                    <p class="mt-1 text-xs font-inter text-white/40 uppercase tracking-wider">Completed Projects</p>
                </div>
                <div class="text-center sm:text-left">
                    <p class="font-heading text-2xl sm:text-3xl font-bold text-gold">6+</p>
                    <p class="mt-1 text-xs font-inter text-white/40 uppercase tracking-wider">Years Experience</p>
                </div>
                <div class="text-center sm:text-left">
                    <p class="font-heading text-2xl sm:text-3xl font-bold text-cream">99%</p>
                    <p class="mt-1 text-xs font-inter text-white/40 uppercase tracking-wider">On-time Delivery</p>
                </div>
            </div>
        </div>
    </div>
</section>
