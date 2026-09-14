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

        /* Toast animations */
        @keyframes toastSlideIn {
            from { opacity: 0; transform: translateX(100%) scale(0.95); }
            to   { opacity: 1; transform: translateX(0)   scale(1); }
        }
        @keyframes toastSlideOut {
            from { opacity: 1; transform: translateX(0)   scale(1); }
            to   { opacity: 0; transform: translateX(100%) scale(0.95); }
        }
        .toast-enter { animation: toastSlideIn 0.35s cubic-bezier(.21,1.02,.73,1) forwards; }
        .toast-leave { animation: toastSlideOut 0.25s ease-in forwards; }
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

    {{-- ============================================================ --}}
    {{-- GLOBAL TOAST NOTIFICATION SYSTEM                             --}}
    {{-- ============================================================ --}}
    <div
        id="omh-toast-container"
        class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none"
        style="width:340px; max-width:calc(100vw - 2rem);"
        x-data="{
            toasts: [],
            addToast(type, message) {
                const id = Date.now() + Math.random();
                this.toasts.push({ id, type, message, leaving: false });
                setTimeout(() => this.removeToast(id), 4200);
            },
            removeToast(id) {
                const t = this.toasts.find(t => t.id === id);
                if (t) {
                    t.leaving = true;
                    setTimeout(() => { this.toasts = this.toasts.filter(t => t.id !== id); }, 280);
                }
            }
        }"
        @notify.window="addToast($event.detail.type ?? ($event.detail[0] && $event.detail[0].type) ?? 'success', $event.detail.message ?? ($event.detail[0] && $event.detail[0].message) ?? '')"
    >
        {{-- Flash session → toast via inline script after Alpine boots --}}
        @if(session()->has('success'))
        <script>
            document.addEventListener('alpine:initialized', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: {!! \Illuminate\Support\Js::from(session('success')) !!} } }));
            });
        </script>
        @endif
        @if(session()->has('error'))
        <script>
            document.addEventListener('alpine:initialized', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: {!! \Illuminate\Support\Js::from(session('error')) !!} } }));
            });
        </script>
        @endif

        <template x-for="toast in toasts" :key="toast.id">
            <div
                :class="toast.leaving ? 'toast-leave' : 'toast-enter'"
                class="pointer-events-auto flex items-start gap-3 px-4 py-3.5 rounded-2xl shadow-xl border"
                :style="toast.type === 'error'
                    ? 'background:#fff1f2;border-color:#fecdd3;'
                    : toast.type === 'warning'
                    ? 'background:#fffbeb;border-color:#fde68a;'
                    : 'background:#f0fdf4;border-color:#bbf7d0;'"
            >
                <!-- Icon -->
                <div class="flex-shrink-0 mt-0.5">
                    <template x-if="toast.type === 'success'">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:#dcfce7;">
                            <svg class="w-4 h-4" style="color:#16a34a" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:#fee2e2;">
                            <svg class="w-4 h-4" style="color:#dc2626" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:#fef3c7;">
                            <svg class="w-4 h-4" style="color:#d97706" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            </svg>
                        </div>
                    </template>
                </div>
                <!-- Text -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold"
                       :style="toast.type === 'error' ? 'color:#991b1b' : toast.type === 'warning' ? 'color:#92400e' : 'color:#14532d'"
                       x-text="toast.type === 'success' ? 'Berhasil' : toast.type === 'error' ? 'Terjadi Kesalahan' : 'Perhatian'"></p>
                    <p class="text-xs mt-0.5 leading-relaxed"
                       :style="toast.type === 'error' ? 'color:#dc2626' : toast.type === 'warning' ? 'color:#b45309' : 'color:#16a34a'"
                       x-text="toast.message"></p>
                </div>
                <!-- Close -->
                <button @click="removeToast(toast.id)" class="flex-shrink-0 mt-0.5 opacity-50 hover:opacity-100 transition-opacity">
                    <svg class="w-4 h-4" style="color:#6b7280" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </template>
    </div>

    {{-- ============================================================ --}}
    {{-- GLOBAL DELETE CONFIRMATION MODAL                             --}}
    {{-- ============================================================ --}}
    <x-confirm-delete-modal />

    @livewireScripts
</body>
</html>
