<div>
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">Dashboard</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Selamat datang kembali. Berikut ringkasan aktivitas OMH Vector.</p>
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
            title="Pesan Masuk" 
            :value="$stats['total_messages']" 
            color="purple"
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>' />
    </div>

    <!-- Statistics Summary Row -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
            <div>
                <p class="text-xs text-text-secondary">Menunggu</p>
                <p class="text-sm font-semibold text-text-primary">{{ $stats['pending_orders'] }} Pesanan</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-green-500"></div>
            <div>
                <p class="text-xs text-text-secondary">Selesai</p>
                <p class="text-sm font-semibold text-text-primary">{{ $stats['completed_orders'] }} Pesanan</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-primary"></div>
            <div>
                <p class="text-xs text-text-secondary">Pesan Masuk</p>
                <p class="text-sm font-semibold text-text-primary">{{ $stats['total_messages'] }} Pesan</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <div>
                <p class="text-xs text-text-secondary">Belum Dibaca</p>
                <p class="text-sm font-semibold text-text-primary">{{ $stats['unread_messages'] }} Pesan</p>
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
                <a href="#" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors flex items-center gap-1">
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

        <!-- Recent Messages -->
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-border flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-text-primary admin-heading">Pesan Masuk Terbaru</h3>
                </div>
                <a href="#" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="p-6">
                @if($recentMessages->isEmpty())
                    <div class="text-center py-10">
                        <svg class="mx-auto h-14 w-14 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <p class="mt-4 text-sm font-medium text-text-secondary">Belum ada pesan masuk</p>
                        <p class="text-xs text-text-secondary/60 mt-1">Pesan dari form kontak akan muncul di sini.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($recentMessages as $message)
                            <div class="flex items-start gap-3.5 p-4 rounded-xl transition-all duration-200 {{ $message->status === 'unread' ? 'bg-primary/5 border border-primary/10' : 'bg-surface/50 border border-transparent' }} hover:bg-surface">
                                <div class="flex-shrink-0 mt-0.5">
                                    @if($message->status === 'unread')
                                        <span class="flex h-2.5 w-2.5 relative">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
                                        </span>
                                    @else
                                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-400"></div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-sm font-semibold {{ $message->status === 'unread' ? 'text-text-primary' : 'text-text-secondary' }} truncate">
                                            {{ $message->name }}
                                        </p>
                                        <p class="text-xs text-text-secondary/60 flex-shrink-0">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="text-sm text-text-secondary mt-0.5 line-clamp-2">{{ $message->message }}</p>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <span class="text-xs text-text-secondary/50">{{ $message->email }}</span>
                                        @if($message->phone)
                                            <span class="text-xs text-text-secondary/50">• {{ $message->phone }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
