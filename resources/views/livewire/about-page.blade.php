<?php
$about = $about ?? \App\Models\AboutSection::getActive();

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

$values = [
    ['title' => 'Kualitas Konsisten', 'description' => 'Kontrol kualitas pada setiap tahap produksi, dari file desain hingga finishing.'],
    ['title' => 'Harga Transparan', 'description' => 'Estimasi harga jelas sejak awal melalui konfigurasi produk, tanpa biaya tersembunyi.'],
    ['title' => 'Tepat Waktu', 'description' => 'Jadwal produksi terjaga agar kebutuhan promosi dan event Anda tidak tertunda.'],
    ['title' => 'Pendampingan Desain', 'description' => 'Tim kami membantu menyiapkan file cetak agar hasil sesuai ekspektasi.'],
];
?>

<div class="bg-light text-ink">
    {{-- Hero --}}
    <section class="relative overflow-hidden px-5 pb-14 pt-32 sm:px-8 lg:px-12 lg:pb-20 lg:pt-40">
        <div class="pointer-events-none absolute inset-0 opacity-40" style="background-image: linear-gradient(120deg, transparent 0%, rgba(214,168,61,.08) 50%, transparent 100%);"></div>
        <div class="relative mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full border border-gold/35 bg-white/70 px-4 py-2 text-[10px] font-semibold uppercase tracking-[0.24em] text-gold-dark"><span class="h-1.5 w-1.5 rounded-full bg-gold"></span>Tentang Kami</span>
            <h1 class="mt-7 font-heading text-4xl font-bold leading-[1.08] tracking-tight text-navy sm:text-6xl">{{ $aboutData['title'] }}<span class="block text-gold-dark">{{ $aboutData['subtitle'] }}</span></h1>
            <p class="mx-auto mt-7 max-w-2xl text-sm leading-7 text-ink-soft sm:text-base">{{ $aboutData['description'] }}</p>
        </div>
    </section>

    {{-- Profil Perusahaan --}}
    <section class="px-5 pb-16 sm:px-8 lg:px-12 lg:pb-24">
        <div class="mx-auto grid max-w-7xl items-center gap-10 lg:grid-cols-[1fr_1fr] lg:gap-16">
            <div class="relative" data-aos="fade-right">
                <div class="relative overflow-hidden rounded-lg md:rounded-[2rem] shadow-lg md:shadow-card-hover ring-1 ring-white/60">
                    <div class="absolute inset-0 z-10 bg-gradient-to-t from-navy/25 via-transparent to-transparent"></div>
                    @if(!empty($aboutData['image']))
                        <img src="{{ $aboutData['image'] }}" alt="{{ $aboutData['imageAlt'] }}" class="h-64 w-full object-cover md:h-[480px]">
                    @else
                        <div class="flex h-64 w-full items-center justify-center bg-navy-deep md:h-[480px]"><span class="font-heading text-5xl font-bold text-white/30">OMH</span></div>
                    @endif
                </div>
                <div class="absolute -bottom-6 -left-3 z-20 rounded-lg border border-white/60 bg-white px-4 py-3 shadow-lg md:-bottom-8 md:-left-8 md:rounded-2xl md:px-6 md:py-5 md:shadow-card-hover">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="gradient-primary flex h-10 w-10 items-center justify-center rounded-lg font-heading text-base font-bold text-white shadow-button md:h-14 md:w-14 md:rounded-xl md:text-xl">{{ $aboutData['yearsExperience'] }}+</div>
                        <div>
                            <p class="font-heading text-sm font-semibold text-navy md:text-base">Tahun Pengalaman</p>
                            <p class="font-inter text-[11px] text-ink-soft md:text-xs">Digital Printing &amp; Branding</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-5 md:space-y-8" data-aos="fade-left">
                <div class="space-y-3">
                    <p class="font-heading text-[10px] font-semibold uppercase tracking-[0.2em] text-gold-dark">Profil Perusahaan</p>
                    <h2 class="font-heading text-2xl font-bold leading-tight text-navy md:text-4xl">Solusi cetak &amp; branding dari satu tempat</h2>
                    <p class="font-inter text-sm leading-relaxed text-ink-soft md:text-base">{{ $aboutData['description'] }}</p>
                </div>

                <div class="grid gap-3 md:gap-4 sm:grid-cols-2">
                    <div class="group rounded-lg border border-white/70 bg-white p-4 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-card-hover md:rounded-2xl md:p-6 md:shadow-card">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gold/15 text-gold-dark md:h-12 md:w-12 md:rounded-xl">
                            <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="mt-3 font-heading text-sm font-semibold text-navy md:mt-4 md:text-lg">Visi Kami</h3>
                        <p class="mt-2 font-inter text-xs leading-relaxed text-ink-soft md:text-sm">{{ $aboutData['vision'] }}</p>
                    </div>
                    <div class="group rounded-lg border border-white/70 bg-white p-4 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-card-hover md:rounded-2xl md:p-6 md:shadow-card">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gold/15 text-gold-dark md:h-12 md:w-12 md:rounded-xl">
                            <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="mt-3 font-heading text-sm font-semibold text-navy md:mt-4 md:text-lg">Misi Kami</h3>
                        <p class="mt-2 font-inter text-xs leading-relaxed text-ink-soft md:text-sm">{{ $aboutData['mission'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Nilai / Keunggulan --}}
    <section class="bg-cream px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
        <div class="mx-auto max-w-7xl">
            <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
                <p class="font-heading text-[10px] font-semibold uppercase tracking-[0.2em] text-gold-dark">Nilai Kami</p>
                <h2 class="mt-3 font-heading text-2xl font-bold text-navy md:text-4xl">Kenapa memilih OMH Vector</h2>
            </div>
            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($values as $value)
                    <div class="rounded-lg border border-white/70 bg-white p-5 shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-card-hover md:rounded-2xl md:p-6" data-aos="fade-up" data-aos-delay="{{ 80 + ($loop->index * 60) }}">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-navy font-heading text-xs font-bold text-gold">{{ $loop->iteration }}</span>
                        <h3 class="mt-4 font-heading text-sm font-semibold text-navy md:text-base">{{ $value['title'] }}</h3>
                        <p class="mt-2 font-inter text-xs leading-relaxed text-ink-soft md:text-sm">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-light px-5 py-16 sm:px-8 lg:px-12 lg:py-20">
        <div class="mx-auto max-w-7xl rounded-3xl bg-navy-dark px-6 py-14 text-white shadow-card sm:px-10 lg:px-16 lg:py-20">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-center lg:justify-between" data-aos="fade-up">
                <div class="max-w-2xl">
                    <h2 class="font-heading text-3xl font-bold leading-tight sm:text-5xl">Siap mewujudkan proyek cetak Anda?</h2>
                    <p class="mt-5 max-w-xl text-sm leading-7 text-white/60">Pilih produk, atur konfigurasi sesuai kebutuhan, lalu lanjutkan ke form pemesanan.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" wire:navigate class="inline-flex items-center gap-3 rounded-full bg-gold px-5 py-3 text-xs font-semibold text-navy transition hover:bg-gold-light hover:shadow-button">Lihat Produk<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg></a>
                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="inline-flex items-center rounded-full border border-white/25 px-5 py-3 text-xs font-semibold text-white transition hover:border-gold hover:text-gold">Konsultasi WhatsApp</a>
                </div>
            </div>
        </div>
    </section>
</div>
