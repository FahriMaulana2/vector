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

    <livewire:welcome-popup />

    {{-- Mobile Bottom Navigation (only visible on mobile) --}}
    <nav class="fixed bottom-0 left-0 right-0 md:hidden bg-white border-t border-gray-200 shadow-lg z-50 safe-area-inset-bottom" role="navigation" aria-label="Mobile Navigation">
        <div class="flex items-stretch">
            {{-- Home/Beranda --}}
            <a href="{{ route('home') }}" 
               class="flex-1 flex flex-col items-center justify-center py-2.5 px-1 text-center no-underline transition-colors duration-200 group {{ request()->routeIs('home') ? 'text-navy' : 'text-gray-600' }}">
                <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('home') ? 'text-navy' : 'text-gray-600 group-hover:text-navy' }}" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                <span class="text-[10px] font-inter font-medium {{ request()->routeIs('home') ? 'text-navy font-bold' : 'text-gray-600 group-hover:text-navy' }}">Home</span>
            </a>

            {{-- Tentang --}}
            <a href="{{ route('about') }}" 
               class="flex-1 flex flex-col items-center justify-center py-2.5 px-1 text-center no-underline transition-colors duration-200 group {{ request()->routeIs('about') ? 'text-navy' : 'text-gray-600' }}">
                <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('about') ? 'text-navy' : 'text-gray-600 group-hover:text-navy' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <span class="text-[10px] font-inter font-medium {{ request()->routeIs('about') ? 'text-navy font-bold' : 'text-gray-600 group-hover:text-navy' }}">Tentang</span>
            </a>

            {{-- Produk --}}
            <a href="{{ route('products.index') }}" 
               class="flex-1 flex flex-col items-center justify-center py-2.5 px-1 text-center no-underline transition-colors duration-200 group {{ request()->routeIs('products.*') ? 'text-navy' : 'text-gray-600' }}">
                <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('products.*') ? 'text-navy' : 'text-gray-600 group-hover:text-navy' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.5v2.25m0-5.25v2.25m12-7.5V7.5m-4.5 0V5.25a2.25 2.25 0 00-2.25-2.25H12a2.25 2.25 0 00-2.25 2.25v2.25"/>
                </svg>
                <span class="text-[10px] font-inter font-medium {{ request()->routeIs('products.*') ? 'text-navy font-bold' : 'text-gray-600 group-hover:text-navy' }}">Produk</span>
            </a>

            {{-- Portofolio --}}
            <a href="{{ route('portfolio.index') }}" 
               class="flex-1 flex flex-col items-center justify-center py-2.5 px-1 text-center no-underline transition-colors duration-200 group {{ request()->routeIs('portfolio.*') ? 'text-navy' : 'text-gray-600' }}">
                <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('portfolio.*') ? 'text-navy' : 'text-gray-600 group-hover:text-navy' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-[10px] font-inter font-medium {{ request()->routeIs('portfolio.*') ? 'text-navy font-bold' : 'text-gray-600 group-hover:text-navy' }}">Portofolio</span>
            </a>

            {{-- Lacak Pesanan --}}
            <a href="{{ route('orders.track') }}" 
               class="flex-1 flex flex-col items-center justify-center py-2.5 px-1 text-center no-underline transition-colors duration-200 group {{ request()->routeIs('orders.track') ? 'text-navy' : 'text-gray-600' }}">
                <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('orders.track') ? 'text-navy' : 'text-gray-600 group-hover:text-navy' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <span class="text-[10px] font-inter font-medium {{ request()->routeIs('orders.track') ? 'text-navy font-bold' : 'text-gray-600 group-hover:text-navy' }}">Lacak</span>
            </a>
        </div>
    </nav>
</div>
