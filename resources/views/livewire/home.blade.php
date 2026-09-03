<div class="pb-16 md:pb-0">
    <livewire:hero />

    <livewire:about />

    <livewire:services />

    <livewire:products />

    <livewire:portfolio />

    <livewire:why-choose-us />

    <livewire:workflow />

    <livewire:faq />

    <livewire:contact />

    {{-- Mobile Bottom Navigation (only visible on mobile) --}}
    <nav class="fixed bottom-0 left-0 right-0 md:hidden bg-white border-t border-gray-200 shadow-lg z-50 safe-area-inset-bottom" role="navigation" aria-label="Mobile Navigation">
        <div class="flex items-stretch">
            {{-- Home/Beranda --}}
            <a href="#hero" 
               class="flex-1 flex flex-col items-center justify-center py-3 px-2 text-center no-underline transition-colors duration-200 group scroll-smooth"
               @scroll.window="$el.classList.toggle('active', window.scrollY < 400)">
                <svg class="w-5 h-5 mb-0.5 text-gray-600 group-hover:text-navy" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                <span class="text-[10px] font-inter font-medium text-gray-600 group-hover:text-navy">Beranda</span>
            </a>

            {{-- Services/Layanan --}}
            <a href="#services" 
               class="flex-1 flex flex-col items-center justify-center py-3 px-2 text-center no-underline transition-colors duration-200 group scroll-smooth">
                <svg class="w-5 h-5 mb-0.5 text-gray-600 group-hover:text-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.5m0 0H9m0 0h-5.5m0 0H2m0 0h1.5m0 0v-5a1 1 0 011-1h2a1 1 0 011 1v5m0 0H9"/>
                </svg>
                <span class="text-[10px] font-inter font-medium text-gray-600 group-hover:text-navy">Layanan</span>
            </a>

            {{-- Products/Produk --}}
            <a href="#products" 
               class="flex-1 flex flex-col items-center justify-center py-3 px-2 text-center no-underline transition-colors duration-200 group scroll-smooth">
                <svg class="w-5 h-5 mb-0.5 text-gray-600 group-hover:text-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.5v2.25m0-5.25v2.25m12-7.5V7.5m-4.5 0V5.25a2.25 2.25 0 00-2.25-2.25H12a2.25 2.25 0 00-2.25 2.25v2.25"/>
                </svg>
                <span class="text-[10px] font-inter font-medium text-gray-600 group-hover:text-navy">Produk</span>
            </a>

            {{-- Portfolio/Portofolio --}}
            <a href="#portfolio" 
               class="flex-1 flex flex-col items-center justify-center py-3 px-2 text-center no-underline transition-colors duration-200 group scroll-smooth">
                <svg class="w-5 h-5 mb-0.5 text-gray-600 group-hover:text-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-[10px] font-inter font-medium text-gray-600 group-hover:text-navy">Portofolio</span>
            </a>
        </div>
    </nav>
</div>
