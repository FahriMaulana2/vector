<div>
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">Dashboard</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Selamat datang kembali. Berikut ringkasan aktivitas OMAH Vector.</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-text-secondary bg-white px-4 py-2 rounded-xl border border-border shadow-soft">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-medium">{{ now()->format('l, d F Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
        <x-admin.stat-card 
            title="Total Produk" 
            :value="$stats['total_products']" 
            color="primary"
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>' />
            
        <x-admin.stat-card 
            title="Total Portofolio" 
            :value="$stats['total_portfolios']" 
            color="yellow"
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>' />
            
        <x-admin.stat-card 
            title="Total Pesanan" 
            :value="$stats['total_orders']" 
            color="blue"
icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>' />
            
        <x-admin.stat-card 
            title="Pesanan Selesai"
            :value="$stats['completed_orders']" 
            color="green"
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' />
            
        <x-admin.stat-card 
            title="Total FAQ" 
            :value="$stats['total_faqs']" 
            color="purple"
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' />
    </div>

    <!-- Statistics Summary Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
            <div>
                <p class="text-xs text-text-secondary">Menunggu</p>
                <p class="text-sm font-semibold text-text-primary">{{ $stats['pending_orders'] }} Pesanan</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
            <div>
                <p class="text-xs text-text-secondary">Selesai</p>
                <p class="text-sm font-semibold text-text-primary">{{ $stats['completed_orders'] }} Pesanan</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-primary"></div>
            <div>
                <p class="text-xs text-text-secondary">Total Produk</p>
                <p class="text-sm font-semibold text-text-primary">{{ $stats['total_products'] }} Item</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-border flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-text-primary admin-heading">Pesanan Terbaru</h3>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="p-6">
                @if($recentOrders->isEmpty())
                    <div class="text-center py-10">
                        <svg class="mx-auto h-14 w-14 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="mt-4 text-sm font-medium text-text-secondary">Belum ada pesanan masuk</p>
                        <p class="text-xs text-text-secondary/60 mt-1">Pesanan akan muncul di sini saat pelanggan memesan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-border">
                                    <th class="text-left py-3 px-2 text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                                    <th class="text-left py-3 px-2 text-xs font-semibold text-text-secondary uppercase tracking-wider">Pelanggan</th>
                                    <th class="text-left py-3 px-2 text-xs font-semibold text-text-secondary uppercase tracking-wider">Status</th>
                                    <th class="text-left py-3 px-2 text-xs font-semibold text-text-secondary uppercase tracking-wider">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr class="border-b border-border/50 hover:bg-surface/50 transition-colors">
                                        <td class="py-3.5 px-2">
                                            <span class="font-mono text-xs font-medium text-text-secondary">{{ $order->order_number }}</span>
                                        </td>
                                        <td class="py-3.5 px-2">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                    {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <p class="font-medium text-text-primary text-sm">{{ $order->customer_name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-2">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                    'design_process' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'printing' => 'bg-purple-100 text-purple-700 border-purple-200',
                                                    'finishing' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                    'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                    'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                                ];
                                                $statusLabel = [
                                                    'pending' => 'Pending',
                                                    'design_process' => 'Design Process',
                                                    'printing' => 'Printing',
                                                    'finishing' => 'Finishing',
                                                    'completed' => 'Completed',
                                                    'cancelled' => 'Cancelled',
                                                ];
                                                $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                                $label = $statusLabel[$order->status] ?? ucfirst(str_replace('_', ' ', $order->status));
                                            @endphp
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-lg border {{ $color }}">
                                                <span class="w-1.5 h-1.5 rounded-full currentColor"></span>
                                                {{ $label }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-2 text-xs text-text-secondary">
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-border flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-yellow-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-text-primary admin-heading">Aksi Cepat</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-text-secondary mb-6">Kelola konten dan pantau operasional website OMH Vector dengan mudah melalui menu berikut.</p>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-border bg-surface/50 hover:bg-primary/5 hover:border-primary/20 transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">Kelola Produk</p>
                                <p class="text-xs text-text-secondary">Tambah, edit, atau hapus katalog produk</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-text-secondary/40 group-hover:text-primary group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <a href="{{ route('admin.portfolios.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-border bg-surface/50 hover:bg-primary/5 hover:border-primary/20 transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">Kelola Portofolio</p>
                                <p class="text-xs text-text-secondary">Tampilkan proyek terbaik Anda</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-text-secondary/40 group-hover:text-primary group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-border bg-surface/50 hover:bg-primary/5 hover:border-primary/20 transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">Pengaturan Website</p>
                                <p class="text-xs text-text-secondary">Ubah logo, info perusahaan, dan SEO</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-text-secondary/40 group-hover:text-primary group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>