<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard - OMAH Vector' }}</title>
    <meta name="description" content="OMH Vector Admin Dashboard - Digital Printing & Branding Solution">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Custom scrollbar untuk admin */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Sidebar transition */
        .sidebar-transition {
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
        
        /* Fade in animation for main content */
        .page-enter {
            animation: pageEnter 0.4s ease-out;
        }
        @keyframes pageEnter {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="admin-body antialiased bg-surface text-text-primary"
      x-data="{ 
          sidebarCollapsed: localStorage.getItem('omh_sidebar_collapsed') === 'true',
          mobileSidebarOpen: false,
          toggleSidebar() {
              this.sidebarCollapsed = !this.sidebarCollapsed;
              localStorage.setItem('omh_sidebar_collapsed', this.sidebarCollapsed);
          }
      }">
    
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileSidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileSidebarOpen = false"
             class="fixed inset-0 z-40 bg-dark-navy/60 backdrop-blur-sm lg:hidden"
             style="display: none;"></div>

        <!-- Sidebar -->
        @include('components.admin.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1 w-0 min-w-0 overflow-hidden">
            <!-- Topbar -->
            @include('components.admin.topbar')

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-surface p-4 md:p-6 lg:p-8">
                <div class="page-enter max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
