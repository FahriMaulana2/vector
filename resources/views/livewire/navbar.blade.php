<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur-xl shadow-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between py-5 lg:py-6">
            <a href="#home" class="inline-flex items-center gap-3 text-slate-900">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0B5ED7] text-white shadow-xl shadow-[#0B5ED7]/10">
                    <span class="font-semibold">P</span>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em]">Printify</p>
                    <p class="text-xs text-slate-500">Digital Printing</p>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-1 font-medium text-slate-700">
                <a href="#home" class="relative px-3 py-2 rounded-full transition-all duration-300 hover:text-[#0B5ED7] after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[#0B5ED7] after:scale-x-0 after:transition-transform after:duration-300 hover:after:scale-x-100">Home</a>
                <a href="#about" class="relative px-3 py-2 rounded-full transition-all duration-300 hover:text-[#0B5ED7] after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[#0B5ED7] after:scale-x-0 after:transition-transform after:duration-300 hover:after:scale-x-100">Tentang Kami</a>
                <a href="#services" class="relative px-3 py-2 rounded-full transition-all duration-300 hover:text-[#0B5ED7] after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[#0B5ED7] after:scale-x-0 after:transition-transform after:duration-300 hover:after:scale-x-100">Layanan</a>
                <a href="#products" class="relative px-3 py-2 rounded-full transition-all duration-300 hover:text-[#0B5ED7] after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[#0B5ED7] after:scale-x-0 after:transition-transform after:duration-300 hover:after:scale-x-100">Produk</a>
                <a href="#portfolio" class="relative px-3 py-2 rounded-full transition-all duration-300 hover:text-[#0B5ED7] after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[#0B5ED7] after:scale-x-0 after:transition-transform after:duration-300 hover:after:scale-x-100">Portofolio</a>
                <a href="#contact" class="relative px-3 py-2 rounded-full transition-all duration-300 hover:text-[#0B5ED7] after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[#0B5ED7] after:scale-x-0 after:transition-transform after:duration-300 hover:after:scale-x-100">Kontak</a>
            </div>

            <div class="hidden lg:flex items-center gap-3">
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center justify-center rounded-full border border-[#0B5ED7] bg-[#0B5ED7] px-6 py-2 text-sm font-semibold text-white transition-all duration-300 hover:scale-105 active:scale-95 hover:shadow-xl hover:bg-[#0a4dc2] hover:border-[#0a4dc2]">Order via WhatsApp</a>
            </div>

            <button @click="open = !open" type="button" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white p-3 text-slate-600 transition hover:border-slate-300 hover:text-[#0B5ED7] lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /> </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition class="lg:hidden border-t border-slate-200 bg-white">
        <div class="space-y-1 px-6 pb-6 pt-4 text-slate-700">
            <a href="#home" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-50">Home</a>
            <a href="#about" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-50">Tentang Kami</a>
            <a href="#services" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-50">Layanan</a>
            <a href="#products" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-50">Produk</a>
            <a href="#portfolio" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-50">Portofolio</a>
            <a href="#contact" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-50">Kontak</a>
            <a href="https://wa.me/6281234567890" target="_blank" class="block rounded-2xl bg-[#0B5ED7] px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-[#0a4dc2]">Order via WhatsApp</a>
        </div>
    </div>
</nav>
