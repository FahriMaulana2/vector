<?php
$aboutData = [
    'image' => 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=900&q=80',
    'imageAlt' => 'OMH Vector creative team in modern printing studio',
];
?>

<section id="about" class="relative overflow-hidden bg-cream">
    {{-- Subtle layered background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-gradient-to-bl from-gold/8 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[380px] h-[380px] bg-gradient-to-tr from-white/40 to-transparent rounded-full blur-3xl"></div>
    </div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 py-20 lg:py-24 relative z-10">
        <div class="grid lg:grid-cols-[1fr_1fr] lg:items-center gap-16 lg:gap-20">
            {{-- Left: Image with decorative frame --}}
            <div class="relative" data-aos="fade-right" data-aos-delay="100">
                {{-- Decorative navy + gold shapes behind image --}}
                <div class="absolute -top-5 -left-5 w-28 h-28 rounded-3xl bg-navy/5 border border-navy/10 hidden md:block"></div>
                <div class="absolute -bottom-6 -right-5 w-20 h-20 rounded-2xl bg-gold/15 border border-gold/20 hidden md:block"></div>

                {{-- Gold accent line --}}
                <div class="absolute top-8 -right-4 w-1.5 h-24 rounded-full bg-gradient-to-b from-gold to-gold-dark hidden md:block"></div>

                <div class="relative rounded-[2rem] overflow-hidden shadow-card-hover ring-1 ring-white/60">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy/25 via-transparent to-transparent z-10"></div>
                    @if(!empty($aboutData['image']))
                    <img src="{{ $aboutData['image'] }}"
                         alt="{{ $aboutData['imageAlt'] }}"
                         onerror="this.style.display='none'; this.parentElement.classList.add('about-fallback');"
                         class="h-[520px] w-full object-cover transition-transform duration-700 hover:scale-105" />
                    <div class="absolute inset-0 z-0 hidden about-fallback-placeholder items-center justify-center bg-navy-deep">
                        <span class="font-heading text-white/30 text-5xl font-bold">OMH</span>
                    </div>
                    @else
                    <div class="flex h-[520px] w-full items-center justify-center bg-navy-deep">
                        <span class="font-heading text-white/30 text-5xl font-bold">OMH</span>
                    </div>
                    @endif
                </div>

                {{-- Floating Experience Card --}}
                <div class="absolute -bottom-8 -left-4 md:-left-8 bg-white rounded-2xl px-6 py-5 shadow-card-hover border border-white/60 z-20 animate-float-subtle">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-xl gradient-primary text-white font-heading font-bold text-xl shadow-button">6+</div>
                        <div>
                            <p class="font-heading font-semibold text-navy">Tahun Pengalaman</p>
                            <p class="text-xs font-inter text-ink-soft">Digital Printing &amp; Branding</p>
                        </div>
                    </div>
                </div>

                {{-- Small gold trust badge --}}
                <div class="absolute top-6 right-6 z-20 hidden sm:flex items-center gap-2 rounded-full bg-white/90 backdrop-blur-sm px-4 py-2 shadow-card border border-gold/30">
                    <svg class="w-4 h-4 text-gold fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <span class="text-xs font-inter font-semibold text-navy">Terpercaya Sejak 2019</span>
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="space-y-8" data-aos="fade-left" data-aos-delay="200">
                <div class="space-y-4">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 border border-gold/30 shadow-soft">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                        <span class="font-heading text-xs font-semibold uppercase tracking-[0.2em] text-navy">Tentang OMH Vector</span>
                    </span>
                    <h2 class="font-heading text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight text-navy leading-[1.1]">
                        Mitra Digital Printing &amp; Branding
                        <span class="gradient-text">Terpercaya</span>
                    </h2>
                    <p class="max-w-2xl text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Kami adalah creative agency yang fokus pada digital printing, desain grafis, dan branding. Dengan pengalaman lebih dari 6 tahun, kami telah membantu 980+ klien dari UMKM hingga korporasi.</p>
                </div>

                {{-- Mission & Vision Cards --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="group rounded-2xl border border-white/70 bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gold/15 text-gold-dark transition-colors duration-300 group-hover:bg-gold group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="mt-4 font-heading text-lg font-semibold text-navy">Misi Kami</h3>
                        <p class="mt-2 text-sm font-inter leading-relaxed text-ink-soft">Memberikan layanan cetak dan branding berkualitas tinggi dengan harga terjangkau dan tepat waktu.</p>
                    </div>
                    <div class="group rounded-2xl border border-white/70 bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gold/15 text-gold-dark transition-colors duration-300 group-hover:bg-gold group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="mt-4 font-heading text-lg font-semibold text-navy">Visi Kami</h3>
                        <p class="mt-2 text-sm font-inter leading-relaxed text-ink-soft">Menjadi creative printing agency terdepan yang dikenal karena inovasi, kualitas, dan pelayanan prima.</p>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-3 gap-6 pt-4 border-t border-white/80">
                    <div>
                        <p class="font-heading text-3xl font-bold text-navy">980+</p>
                        <p class="text-sm font-inter text-ink-soft mt-0.5">Klien Puas</p>
                    </div>
                    <div>
                        <p class="font-heading text-3xl font-bold text-navy">1.250+</p>
                        <p class="text-sm font-inter text-ink-soft mt-0.5">Proyek Selesai</p>
                    </div>
                    <div>
                        <p class="font-heading text-3xl font-bold text-gold-dark">6+</p>
                        <p class="text-sm font-inter text-ink-soft mt-0.5">Tahun Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
