<aside :class="sidebarCollapsed ? 'w-[72px]' : 'w-[270px]'" 
       class="sidebar-transition fixed inset-y-0 left-0 z-50 flex flex-col bg-[#173B6C] text-white lg:static lg:translate-x-0 overflow-hidden"
       :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
    
    <!-- Logo Area -->
    <div class="flex items-center h-[72px] px-4 border-b border-white/10 flex-shrink-0">
        <div class="flex items-center gap-3 overflow-hidden">
            <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-accent rounded-xl text-[#173B6C] font-bold text-sm shadow-lg shadow-accent/20">
                OMAH
            </div>
            <div x-show="!sidebarCollapsed" class="whitespace-nowrap">
                <p class="text-sm font-bold text-white tracking-wide">OMH Vector</p>
                <p class="text-[10px] text-white/50 font-medium tracking-wider uppercase">Admin Dashboard</p>
            </div>
        </div>
        <button @click="mobileSidebarOpen = false" class="lg:hidden ml-auto text-white/40 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-5 overflow-y-auto space-y-6 scrollbar-thin">
        
        @php
            $currentRoute = request()->route()?->getName() ?? '';
            
            $menuGroups = [
                'UTAMA' => [
                    ['name' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'grid', 'badge' => null],
                ],
'KELOLA WEBSITE' => [
                    ['name' => 'Hero Section', 'route' => 'admin.hero.index', 'active_routes' => ['admin.hero.index', 'admin.hero.create', 'admin.hero.edit'], 'icon' => 'layout', 'badge' => null],
                    ['name' => 'Tentang Kami', 'route' => 'admin.about.index', 'active_routes' => ['admin.about.index', 'admin.about.create', 'admin.about.edit'], 'icon' => 'info', 'badge' => null],
                    ['name' => 'Layanan', 'route' => 'admin.services.index', 'active_routes' => ['admin.services.index', 'admin.services.create', 'admin.services.edit'], 'icon' => 'briefcase', 'badge' => null],
                    ['name' => 'Mengapa Memilih Kami', 'route' => 'admin.why-choose-us.index', 'active_routes' => ['admin.why-choose-us.index', 'admin.why-choose-us.create', 'admin.why-choose-us.edit'], 'icon' => 'star', 'badge' => null],
                    ['name' => 'Alur Kerja', 'route' => 'admin.workflow.index', 'active_routes' => ['admin.workflow.index', 'admin.workflow.create', 'admin.workflow.edit'], 'icon' => 'layers', 'badge' => null],
                    ['name' => 'FAQ', 'route' => 'admin.faqs.index', 'active_routes' => ['admin.faqs.index', 'admin.faqs.create', 'admin.faqs.edit'], 'icon' => 'help-circle', 'badge' => null],
                ],
'KATALOG & PORTOFOLIO' => [
                    ['name' => 'Produk', 'route' => 'admin.products.index', 'active_routes' => ['admin.products.index', 'admin.products.create', 'admin.products.edit'], 'icon' => 'package', 'badge' => null],
                    ['name' => 'Halaman Produk', 'route' => 'admin.products.page-content', 'active_routes' => ['admin.products.page-content'], 'icon' => 'layout', 'badge' => null],
                    ['name' => 'Portofolio', 'route' => 'admin.portfolios.index', 'active_routes' => ['admin.portfolios.index', 'admin.portfolios.create', 'admin.portfolios.edit'], 'icon' => 'image', 'badge' => null],
                    ['name' => 'Halaman Portfolio', 'route' => 'admin.portfolios.page-content', 'active_routes' => ['admin.portfolios.page-content'], 'icon' => 'layout', 'badge' => null],
                ],
                'OPERASIONAL' => [
                    ['name' => 'Pesanan', 'route' => 'admin.orders.index', 'active_routes' => ['admin.orders.index', 'admin.orders.show'], 'icon' => 'shopping-bag', 'badge' => null],
                ],
                'PENGATURAN' => [
                    ['name' => 'Pengaturan Website', 'route' => 'admin.settings.index', 'icon' => 'settings', 'badge' => null],
                ],
                'AKUN' => [
                    ['name' => 'Keluar', 'route' => 'admin.logout', 'icon' => 'log-out', 'badge' => null, 'is_form' => true],
                ],
            ];
            
            $icons = [
                'grid' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>',
                'layout' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>',
                'info' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                'briefcase' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
                'star' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>',
                'layers' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>',
                'message-square' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>',
                'help-circle' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                'tag' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>',
                'package' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>',
                'folder' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>',
                'image' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
                'shopping-bag' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>',
                'mail' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
                'settings' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
                'users' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>',
                'log-out' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>',
            ];
            
            function isRouteActive($routeName, $currentRoute, $activeRoutes = null) {
                if ($routeName === '#') return false;
                return in_array($currentRoute, $activeRoutes ?? [$routeName], true);
            }
        @endphp

        @foreach($menuGroups as $groupName => $items)
            <div>
                <p x-show="!sidebarCollapsed" class="px-3 text-[10px] font-semibold text-white/30 uppercase tracking-[0.15em] mb-2.5">{{ $groupName }}</p>
                <div class="space-y-1">
                    @foreach($items as $item)
                        @php
                            $isActive = isRouteActive($item['route'], $currentRoute, $item['active_routes'] ?? null);
                            $isDisabled = $item['badge'] === 'Segera Hadir';
                            $isForm = $item['is_form'] ?? false;
                        @endphp

                        @if($isForm)
                            {{-- Logout form --}}
                            <form action="{{ route($item['route']) }}" method="POST" class="block">
                                @csrf
                                <button type="submit" 
                                        class="group relative flex items-center w-full gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 text-red-400/80 hover:bg-red-500/10 hover:text-red-300">
                                    <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center">
                                        {!! $icons[$item['icon']] !!}
                                    </span>
                                    <span x-show="!sidebarCollapsed" class="text-sm font-medium whitespace-nowrap">{{ $item['name'] }}</span>
                                    <div x-show="sidebarCollapsed" 
                                         class="absolute left-full ml-3 px-2.5 py-1.5 bg-[#1E4F91] text-white text-xs font-medium rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">
                                        {{ $item['name'] }}
                                    </div>
                                </button>
                            </form>
                        @elseif($isDisabled)
                            {{-- Disabled menu item --}}
                            <div class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/30 cursor-not-allowed">
                                <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center">
                                    {!! $icons[$item['icon']] !!}
                                </span>
                                <span x-show="!sidebarCollapsed" class="text-sm whitespace-nowrap flex items-center gap-2">
                                    {{ $item['name'] }}
                                    <span class="text-[9px] bg-white/10 text-white/50 px-1.5 py-0.5 rounded-md font-medium">Segera</span>
                                </span>
                                <div x-show="sidebarCollapsed" 
                                     class="absolute left-full ml-3 px-2.5 py-1.5 bg-[#1E4F91] text-white text-xs font-medium rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">
                                    {{ $item['name'] }} (Segera Hadir)
                                </div>
                            </div>
                        @else
                            {{-- Active menu item --}}
                            @php
                                $routeExists = Route::has($item['route']);
                            @endphp
                            @if($routeExists)
                                <a href="{{ route($item['route']) }}" 
                                   @if(!$routeExists) onclick="return false;" @endif
                                   class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ $isActive ? 'bg-[#1E4F91]/40 text-white shadow-sm' : 'text-white/60 hover:bg-white/5 hover:text-white' }}"
                                   x-data
                                   @if($routeExists) wire:navigate @endif>
                                    @if($isActive)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-accent rounded-r-full"></span>
                                    @endif
                                    <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center {{ $isActive ? 'text-accent' : '' }}">
                                        {!! $icons[$item['icon']] !!}
                                    </span>
                                    <span x-show="!sidebarCollapsed" class="text-sm font-medium whitespace-nowrap">{{ $item['name'] }}</span>
                                    @if($item['badge'])
                                        <span x-show="!sidebarCollapsed" class="ml-auto text-[9px] bg-accent/20 text-accent px-1.5 py-0.5 rounded-md font-medium">{{ $item['badge'] }}</span>
                                    @endif
                                    <div x-show="sidebarCollapsed" 
                                         class="absolute left-full ml-3 px-2.5 py-1.5 bg-[#1E4F91] text-white text-xs font-medium rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">
                                        {{ $item['name'] }}
                                    </div>
                                </a>
                            @else
                                <div class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/30 cursor-not-allowed">
                                    <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center">
                                        {!! $icons[$item['icon']] !!}
                                    </span>
                                    <span x-show="!sidebarCollapsed" class="text-sm whitespace-nowrap flex items-center gap-2">
                                        {{ $item['name'] }}
                                        <span class="text-[9px] bg-white/10 text-white/50 px-1.5 py-0.5 rounded-md font-medium">Segera</span>
                                    </span>
                                    <div x-show="sidebarCollapsed" 
                                         class="absolute left-full ml-3 px-2.5 py-1.5 bg-[#1E4F91] text-white text-xs font-medium rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">
                                        {{ $item['name'] }} (Segera Hadir)
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <!-- Sidebar Footer - Admin Info -->
    <div class="px-3 py-4 border-t border-white/10 flex-shrink-0">
        <div x-show="!sidebarCollapsed" class="flex items-center gap-3 px-3">
            <div class="w-8 h-8 rounded-full bg-accent/20 flex items-center justify-center text-accent text-xs font-bold">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-medium text-white/80 truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                <p class="text-[10px] text-white/40 truncate">Administrator</p>
            </div>
        </div>
    </div>
</aside>
