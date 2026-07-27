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

<section id="why-choose-us" class="relative overflow-hidden py-24 lg:py-28 text-white">
    {{-- Dark Premium Background --}}
    <div class="absolute inset-0 bg-gradient-to-b from-[#0F172A] via-[#111827] to-[#0F172A]"></div>
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/3 -left-40 w-[500px] h-[500px] rounded-full bg-[#0B5ED7]/6 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/5 px-4 py-1.5 border border-white/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#FFC107]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#FFC107]">Why Choose Us</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight leading-[1.1]">Why Businesses Trust <span class="text-[#FFC107]">OMH Vector</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-white/50">Kami berkomitmen memberikan layanan percetakan dan branding terbaik untuk setiap klien.</p>
        </div>

        {{-- Feature Cards Grid --}}
        <div class="mt-12 grid gap-5 sm:grid-cols-2">
            @foreach($reasons as $reason)
            <div class="group relative rounded-2xl border border-white/[0.08] bg-white/[0.04] p-8 shadow-lg transition-all duration-500 hover:-translate-y-1 hover:shadow-xl hover:bg-white/[0.07] hover:border-[#0B5ED7]/30"
                 data-aos="fade-up"
                 data-aos-delay="{{ $reason['delay'] }}">
                <div class="flex items-start gap-5">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/[0.06] text-white/60 transition-all duration-500 group-hover:bg-[#0B5ED7] group-hover:text-white group-hover:shadow-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $reason['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-white">{{ $reason['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-white/50">{{ $reason['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Statistics Row --}}
        <div class="mt-16 pt-10 border-t border-white/[0.06]" data-aos="fade-up">
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-4">
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-white">980+</p>
                    <p class="mt-2 text-sm text-white/30 uppercase tracking-wider">Satisfied Clients</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-white">1.250+</p>
                    <p class="mt-2 text-sm text-white/30 uppercase tracking-wider">Completed Projects</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-white">6+</p>
                    <p class="mt-2 text-sm text-white/30 uppercase tracking-wider">Years Experience</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-white">99%</p>
                    <p class="mt-2 text-sm text-white/30 uppercase tracking-wider">On-time Delivery</p>
                </div>
            </div>
        </div>
    </div>
</section>

