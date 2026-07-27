<?php
$aboutData = [
    'image' => 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=900&q=80',
    'imageAlt' => 'OMH Vector creative team in modern printing studio',
];
?>

<section id="about" class="relative overflow-hidden bg-white">
    {{-- Single subtle background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-gradient-to-bl from-[#0B5ED7]/4 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-[1fr_1fr] lg:items-center gap-16 lg:gap-20">
            {{-- Left: Image with experience card --}}
            <div class="relative" data-aos="fade-right" data-aos-delay="100">
                <div class="relative rounded-[2rem] overflow-hidden shadow-card-hover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B5ED7]/10 via-transparent to-transparent z-10"></div>
                    <img src="{{ $aboutData['image'] }}"
                         alt="{{ $aboutData['imageAlt'] }}"
                         class="h-[520px] w-full object-cover transition-transform duration-700 hover:scale-105" />
                </div>

                {{-- Experience Card --}}
                <div class="absolute -bottom-8 -left-8 bg-white rounded-2xl px-6 py-5 shadow-card-hover border border-slate-100 z-20 animate-float-subtle">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-xl gradient-primary text-white font-bold text-xl shadow-button">6+</div>
                        <div>
                            <p class="font-semibold text-slate-900">Tahun Pengalaman</p>
                            <p class="text-xs text-slate-500">Digital Printing &amp; Branding</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="space-y-8" data-aos="fade-left" data-aos-delay="200">
                <div class="space-y-4">
                    <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                        <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Tentang OMH Vector</span>
                    </span>
                    <h2 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight text-slate-950 leading-[1.1]">
                        Mitra Digital Printing &amp; Branding
                        <span class="text-[#0B5ED7]">Terpercaya</span>
                    </h2>
                    <p class="max-w-2xl text-base lg:text-lg leading-relaxed text-slate-500">Kami adalah creative agency yang fokus pada digital printing, desain grafis, dan branding. Dengan pengalaman lebih dari 6 tahun, kami telah membantu 980+ klien dari UMKM hingga korporasi.</p>
                </div>

                {{-- Mission & Vision Cards --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover hover:border-[#0B5ED7]/15">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7] transition-all duration-300 group-hover:bg-[#0B5ED7] group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-slate-950">Misi Kami</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">Memberikan layanan cetak dan branding berkualitas tinggi dengan harga terjangkau dan tepat waktu.</p>
                    </div>
                    <div class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover hover:border-[#0B5ED7]/15">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7] transition-all duration-300 group-hover:bg-[#0B5ED7] group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-slate-950">Visi Kami</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">Menjadi creative printing agency terdepan yang dikenal karena inovasi, kualitas, dan pelayanan prima.</p>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-3 gap-6 pt-4 border-t border-slate-100">
                    <div>
                        <p class="text-3xl font-bold text-[#0B5ED7]">980+</p>
                        <p class="text-sm text-slate-500 mt-0.5">Klien Puas</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-[#0B5ED7]">1.250+</p>
                        <p class="text-sm text-slate-500 mt-0.5">Proyek Selesai</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-[#0B5ED7]">6+</p>
                        <p class="text-sm text-slate-500 mt-0.5">Tahun Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

