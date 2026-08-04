<header class="flex items-center justify-between h-[72px] px-4 md:px-6 bg-white border-b border-border shadow-soft flex-shrink-0 sticky top-0 z-30">
    <!-- Left Section -->
    <div class="flex items-center gap-3">
        <!-- Mobile Menu Button -->
        <button @click="mobileSidebarOpen = true" class="p-2 text-text-secondary rounded-lg lg:hidden hover:bg-surface transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Desktop Sidebar Toggle -->
        <button @click="toggleSidebar" class="hidden lg:flex p-2 text-text-secondary rounded-lg hover:bg-surface transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Breadcrumb -->
        <nav class="hidden sm:flex items-center gap-2 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="text-text-secondary hover:text-primary transition-colors font-medium">
                Admin
            </a>
            <svg class="w-4 h-4 text-text-secondary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-text-primary font-medium">{{ $title ?? 'Dashboard' }}</span>
        </nav>
        
        <!-- Mobile Title -->
        <h1 class="sm:hidden text-base font-semibold text-text-primary admin-heading">{{ $title ?? 'Dashboard' }}</h1>
    </div>

    <!-- Right Section -->
    <div class="flex items-center gap-2 md:gap-3">
        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="flex items-center gap-3 p-1.5 rounded-xl hover:bg-surface transition-all duration-200 group">
                <div class="flex flex-col items-end hidden md:flex">
                    <span class="text-sm font-semibold text-text-primary">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="text-xs text-text-secondary">Administrator</span>
                </div>
                <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary text-white font-bold text-xs shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
                </div>
                <svg class="w-4 h-4 text-text-secondary hidden md:block group-hover:text-text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="transform opacity-0 scale-95 -translate-y-2"
                 x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="transform opacity-0 scale-95 -translate-y-2"
                 class="absolute right-0 z-50 w-56 mt-2 origin-top-right bg-white rounded-xl shadow-card border border-border focus:outline-none"
                 style="display: none;">
                <div class="p-2">
                    <!-- Profile Info -->
                    <div class="px-3 py-2 border-b border-border mb-1">
                        <p class="text-sm font-semibold text-text-primary">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-xs text-text-secondary">{{ Auth::user()->email ?? 'admin@omhvector.com' }}</p>
                    </div>

                    <!-- Menu Items -->
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-text-secondary rounded-lg hover:bg-surface hover:text-text-primary transition-colors cursor-not-allowed opacity-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil
                        <span class="ml-auto text-[9px] bg-surface text-text-secondary px-1.5 py-0.5 rounded-md">Segera</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-text-secondary rounded-lg hover:bg-surface hover:text-text-primary transition-colors" wire:navigate>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pengaturan
                    </a>

                    <div class="border-t border-border mt-1 pt-1">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-3 py-2 text-sm text-red-500 rounded-lg hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
