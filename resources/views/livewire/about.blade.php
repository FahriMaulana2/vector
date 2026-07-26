<section id="about" class="relative overflow-hidden bg-white py-28 lg:py-32">
    {{-- Decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-gradient-to-bl from-[#0B5ED7]/5 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[350px] h-[350px] bg-gradient-to-tr from-[#FFC107]/5 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-br from-[#0B5ED7]/3 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-grid opacity-30"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-[1fr_1fr] lg:items-center gap-16 lg:gap-20">
            {{-- Left: Image with overlapping card --}}
            <div class="relative" data-aos="fade-right" data-aos-delay="100">
                {{-- Decorative blobs --}}
                <div class="absolute -top-6 -left-6 w-32 h-32 blob bg-gradient-to-br from-[#0B5ED7]/12 to-transparent animate-float-slow"></div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 blob-2 bg-gradient-to-tr from-[#FFC107]/12 to-transparent animate-float-delayed"></div>

                {{-- Main Image --}}
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-200/60">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B5ED7]/15 via-transparent to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=900&q=80" alt="OMH Vector Team" class="h-[520px] w-full object-cover transition-transform duration-700 hover:scale-105" />
                </div>

                {{-- Floating Experience Card --}}
                <div class="absolute -bottom-8 -left-8 glass-strong rounded-2xl px-6 py-5 shadow-premium-xl animate-float z-20">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-xl gradient-primary text-white font-bold text-xl shadow-lg shadow-[#0B5ED7]/20">6+</div>
                        <div>
                            <p class="font-semibold text-slate-900">Tahun Pengalaman</p>
                            <p class="text-xs text-slate-500">Digital Printing &amp; Branding</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="space-y-10" data-aos="fade-left" data-aos-delay="200">
                <div class="space-y-5">
                    <div class="inline-flex items-center gap-3 rounded-full bg-[#0B5ED7]/5 px-5 py-2 border border-[#0B5ED7]/10">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                        <span class="text-sm font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Tentang OMH Vector</span>
                    </div>
                    <h2 class="text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl leading-[1.15]">
                        Mitra Digital Printing &amp; Branding
                        <span class="gradient-text">Terpercaya</span>
                    </h2>
                    <p class="text-lg leading-relaxed text-slate-500">Kami adalah creative agency yang fokus pada digital printing, desain grafis, dan branding. Dengan pengalaman lebih dari 6 tahun, kami telah membantu 980+ klien dari UMKM hingga korporasi.</p>
                </div>

                {{-- Mission & Vision Cards --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="group rounded-2xl border border-slate-100 bg-gradient-to-br from-white to-slate-50/50 p-6 shadow-premium transition-all duration-300 hover:-translate-y-2 hover:shadow-premium-xl hover:border-[#0B5ED7]/15">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#0B5ED7]/10 to-[#0B5ED7]/5 text-[#0B5ED7] transition-all duration-300 group-hover:from-[#0B5ED7] group-hover:to-blue-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-[#0B5ED7]/20 group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-950">Misi Kami</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">Memberikan layanan cetak dan branding berkualitas tinggi dengan harga terjangkau dan tepat waktu.</p>
                    </div>
                    <div class="group rounded-2xl border border-slate-100 bg-gradient-to-br from-white to-slate-50/50 p-6 shadow-premium transition-all duration-300 hover:-translate-y-2 hover:shadow-premium-xl hover:border-[#0B5ED7]/15">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#0B5ED7]/10 to-[#0B5ED7]/5 text-[#0B5ED7] transition-all duration-300 group-hover:from-[#0B5ED7] group-hover:to-blue-500 group-hover:text-white group-hover:shadow-lg group-hover:shadow-[#0B5ED7]/20 group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-950">Visi Kami</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">Menjadi creative printing agency terdepan yang dikenal karena inovasi, kualitas, dan pelayanan prima.</p>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-3 gap-6 pt-4 border-t border-slate-100">
                    <div>
                        <p class="text-3xl font-bold gradient-text">980+</p>
                        <p class="text-sm text-slate-500 mt-1">Klien Puas</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold gradient-text">1.250+</p>
                        <p class="text-sm text-slate-500 mt-1">Proyek Selesai</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold gradient-text">6+</p>
                        <p class="text-sm text-slate-500 mt-1">Tahun Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
