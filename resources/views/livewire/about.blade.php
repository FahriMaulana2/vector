<?php
$isPage = request()->routeIs('about');
$about = $about ?? \App\Models\AboutSection::getActive();
$stats = $stats ?? \App\Models\AboutStat::getActive();
$milestones = $milestones ?? \App\Models\AboutMilestone::getActive();

$aboutData = [
    'image' => $about?->getImageUrlAttribute() ?? 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=900&q=80',
    'imageAlt' => $about?->title ?? 'OMH Vector creative team in modern printing studio',
    'title' => $about?->title ?? 'Tentang OMH Vector',
    'subtitle' => $about?->subtitle ?? 'Mitra Digital Printing & Branding Terpercaya',
    'description' => $about?->description ?? 'Kami adalah creative agency yang fokus pada digital printing, desain grafis, dan branding. Dengan pengalaman lebih dari 6 tahun, kami telah membantu 980+ klien dari UMKM hingga korporasi.',
    'vision' => $about?->vision ?? 'Menjadi creative printing agency terdepan yang dikenal karena inovasi, kualitas, dan pelayanan prima.',
    'mission' => $about?->mission ?? 'Memberikan layanan cetak dan branding berkualitas tinggi dengan harga terjangkau dan tepat waktu.',
    'yearsExperience' => (int) ($about?->years_experience ?? 6),
];
?>

<section id="about" class="relative overflow-hidden bg-white {{ $isPage ? 'pt-8 pb-16 md:pb-24' : '' }}">
    {{-- Subtle layered background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[280px] h-[280px] md:w-[450px] md:h-[450px] bg-gradient-to-bl from-gold/8 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-tr from-gold/10 md:from-white/40 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="mx-auto px-4 md:px-6 lg:px-8 py-8 md:py-16 lg:py-20 relative z-10 md:max-w-7xl">
        <div class="grid md:grid-cols-[1fr_1fr] md:items-center gap-8 md:gap-16 lg:gap-20">
            {{-- Left: Image with decorative frame --}}
            <div class="relative order-2 md:order-1" data-aos="fade-right" data-aos-delay="100">
                <div class="absolute -top-5 -left-5 w-28 h-28 rounded-3xl bg-navy/5 border border-navy/10 hidden md:block"></div>
                <div class="absolute -bottom-6 -right-5 w-20 h-20 rounded-2xl bg-gold/15 border border-gold/20 hidden md:block"></div>
                <div class="absolute top-8 -right-4 w-1.5 h-24 rounded-full bg-gradient-to-b from-gold to-gold-dark hidden md:block"></div>

                {{-- Image container with safely docked badge to prevent desktop overlap --}}
                <div class="relative rounded-2xl md:rounded-[2rem] overflow-hidden shadow-lg md:shadow-card-hover ring-1 ring-black/5">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy/35 via-transparent to-transparent z-10"></div>
                    @if(!empty($aboutData['image']))
                    <img src="{{ $aboutData['image'] }}"
                         alt="{{ $aboutData['imageAlt'] }}"
                         onerror="this.style.display='none'; this.parentElement.classList.add('about-fallback');"
                         class="w-full h-72 md:h-[520px] object-cover transition-transform duration-700 hover:scale-105" />
                    <div class="absolute inset-0 z-0 hidden about-fallback-placeholder items-center justify-center bg-navy-deep">
                        <span class="font-heading text-white/30 text-5xl font-bold">OMH</span>
                    </div>
                    @else
                    <div class="flex w-full h-72 md:h-[520px] items-center justify-center bg-navy-deep">
                        <span class="font-heading text-white/30 text-5xl font-bold">OMH</span>
                    </div>
                    @endif

                    {{-- Gold trust badge: Docked cleanly inside top-right corner of image container --}}
                    <div class="absolute top-4 right-4 md:top-5 md:right-5 z-20 flex items-center gap-2 rounded-full bg-white/95 backdrop-blur-md px-3.5 py-1.5 md:px-4 md:py-2 shadow-md border border-gold/30">
                        <svg class="w-4 h-4 text-gold fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <span class="text-xs font-inter font-semibold text-navy">Terpercaya Sejak 2019</span>
                    </div>
                </div>

                {{-- Floating Experience Card --}}
                <div class="absolute -bottom-6 -left-3 md:-bottom-8 md:-left-6 bg-white rounded-xl md:rounded-2xl px-4 py-3 md:px-6 md:py-5 shadow-lg md:shadow-card-hover border border-navy/10 z-20 animate-float-subtle">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="flex items-center justify-center w-10 h-10 md:w-14 md:h-14 rounded-lg md:rounded-xl gradient-primary text-white font-heading font-bold text-base md:text-xl shadow-button">{{ $aboutData['yearsExperience'] }}+</div>
                        <div>
                            <p class="font-heading font-semibold text-navy text-sm md:text-base">Tahun Pengalaman</p>
                            <p class="text-[11px] md:text-xs font-inter text-ink-soft">Digital Printing & Branding</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="space-y-5 md:space-y-8 order-1 md:order-2" data-aos="fade-left" data-aos-delay="200">
                <div class="space-y-3 md:space-y-4">
                    <span class="inline-flex items-center gap-2 rounded-full bg-navy/5 px-3 py-1.5 md:px-4 md:py-1.5 border border-navy/10 shadow-soft">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                        <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.15em] md:tracking-[0.2em] text-navy">{{ $aboutData['title'] }}</span>
                    </span>
                    <h2 class="font-heading text-2xl md:text-4xl lg:text-5xl font-bold tracking-tight text-navy leading-tight md:leading-[1.1]">
                        {{ $aboutData['subtitle'] }}
                    </h2>
                    <p class="text-sm md:text-base lg:text-lg font-inter leading-relaxed text-ink-soft">{{ $aboutData['description'] }}</p>
                </div>

                {{-- Mission & Vision Cards --}}
                <div class="grid gap-3 md:gap-4 sm:grid-cols-2">
                    <div class="group rounded-xl md:rounded-2xl border border-navy/10 bg-white p-4 md:p-6 shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover hover:border-gold/40">
                        <div class="flex h-10 w-10 md:h-12 md:w-12 items-center justify-center rounded-xl bg-gold/15 text-gold-dark transition-colors duration-300 group-hover:bg-gold group-hover:text-white">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="mt-3 md:mt-4 font-heading text-base md:text-lg font-semibold text-navy">Misi Kami</h3>
                        <p class="mt-2 text-xs md:text-sm font-inter leading-relaxed text-ink-soft">{{ $aboutData['mission'] }}</p>
                    </div>
                    <div class="group rounded-xl md:rounded-2xl border border-navy/10 bg-white p-4 md:p-6 shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover hover:border-gold/40">
                        <div class="flex h-10 w-10 md:h-12 md:w-12 items-center justify-center rounded-xl bg-gold/15 text-gold-dark transition-colors duration-300 group-hover:bg-gold group-hover:text-white">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="mt-3 md:mt-4 font-heading text-base md:text-lg font-semibold text-navy">Visi Kami</h3>
                        <p class="mt-2 text-xs md:text-sm font-inter leading-relaxed text-ink-soft">{{ $aboutData['vision'] }}</p>
                    </div>
                </div>

                @if($isPage)
                    {{-- Dynamic Stats or Fallback on Full Page --}}
                    @if(isset($stats) && $stats->isNotEmpty())
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 md:gap-4 pt-4 border-t border-navy/10">
                            @foreach($stats as $stat)
                                <div class="p-3.5 rounded-xl bg-navy/5 border border-navy/10">
                                    <p class="font-heading text-xl md:text-2xl font-bold text-navy">{{ $stat->value }}</p>
                                    <p class="text-xs font-inter text-ink-soft mt-0.5">{{ $stat->label }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="grid grid-cols-3 gap-3 md:gap-6 pt-4 border-t border-navy/10">
                            <div>
                                <p class="font-heading text-lg md:text-3xl font-bold text-navy">980+</p>
                                <p class="text-xs md:text-sm font-inter text-ink-soft mt-0.5">Klien Puas</p>
                            </div>
                            <div>
                                <p class="font-heading text-lg md:text-3xl font-bold text-navy">1.250+</p>
                                <p class="text-xs md:text-sm font-inter text-ink-soft mt-0.5">Proyek Selesai</p>
                            </div>
                            <div>
                                <p class="font-heading text-lg md:text-3xl font-bold text-gold-dark">6+</p>
                                <p class="text-xs md:text-sm font-inter text-ink-soft mt-0.5">Tahun Aktif</p>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- CTA on Landing Page Preview --}}
                    <div class="pt-2">
                        <a href="{{ route('about') }}"
                           class="inline-flex items-center gap-2 rounded-full bg-navy px-6 py-3 text-xs md:text-sm font-heading font-semibold text-cream shadow-button transition-all duration-300 hover:bg-navy-deep hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                            <span>Lihat Selengkapnya</span>
                            <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if($isPage && isset($milestones) && $milestones->isNotEmpty())
            {{-- Dynamic Milestones Timeline Section --}}
            <div class="mt-16 md:mt-24 pt-12 border-t border-navy/10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="inline-flex items-center gap-2 rounded-full bg-navy/5 px-4 py-1.5 border border-navy/10 text-xs font-heading font-semibold uppercase tracking-wider text-navy">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                        Perjalanan Kami
                    </span>
                    <h3 class="mt-3 font-heading text-2xl md:text-3xl lg:text-4xl font-bold text-navy">Timeline & Jejak Prestasi</h3>
                    <p class="mt-2 text-sm text-ink-soft font-inter">Perjalanan bertumbuh bersama Anda menghadirkan karya cetak dan visual terbaik</p>
                </div>

                <div class="relative max-w-3xl mx-auto">
                    {{-- Central vertical line --}}
                    <div class="absolute left-4 md:left-1/2 top-4 bottom-4 w-0.5 bg-gradient-to-b from-gold via-navy to-gold -translate-x-1/2"></div>

                    <div class="space-y-6 md:space-y-8">
                        @foreach($milestones as $index => $milestone)
                            <div class="relative flex flex-col md:flex-row items-start md:items-center {{ $index % 2 === 0 ? 'md:flex-row-reverse' : '' }} gap-4 md:gap-8 pl-10 md:pl-0">
                                {{-- Year badge node --}}
                                <div class="absolute left-4 md:left-1/2 -translate-x-1/2 flex items-center justify-center w-9 h-9 rounded-full bg-navy text-gold font-heading font-bold text-xs border-2 border-white shadow-md z-10">
                                    {{ $milestone->year }}
                                </div>

                                {{-- Card --}}
                                <div class="w-full md:w-[calc(50%-2rem)] {{ $index % 2 === 0 ? 'md:text-left' : 'md:text-right' }}">
                                    <div class="p-5 rounded-2xl bg-white border border-navy/10 shadow-card hover:shadow-card-hover hover:border-gold/40 transition duration-300">
                                        <span class="inline-block px-2.5 py-0.5 rounded-md bg-gold/15 text-gold-dark text-xs font-heading font-bold mb-2">
                                            {{ $milestone->year }}
                                        </span>
                                        <h4 class="font-heading text-base md:text-lg font-bold text-navy">{{ $milestone->title }}</h4>
                                        @if($milestone->description)
                                            <p class="mt-2 text-xs md:text-sm font-inter text-ink-soft leading-relaxed">{{ $milestone->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($isPage)
            {{-- CTA Kembali ke Home di halaman /tentang --}}
            <div class="mt-12 md:mt-16 text-center relative z-20">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full bg-navy/10 border border-navy/20 px-6 py-3 text-xs font-heading font-semibold text-navy transition hover:bg-navy hover:text-cream shadow-sm">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        @endif
    </div>
</section>
