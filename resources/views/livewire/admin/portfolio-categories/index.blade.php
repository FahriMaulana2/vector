<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">Kategori Portofolio</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola kategori portofolio.</p>
            </div>
            <a href="{{ route('admin.portfolio-categories.create') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button hover:shadow-button-hover">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Kategori
            </a>
        </div>
    <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
        <div class="p-6">
            @if($items->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <p class="mt-4 text-sm font-medium text-text-secondary">Belum ada kategori</p>
                    <a href="{{ route('admin.portfolio-categories.create') }}" wire:navigate class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary-dark transition-colors">Tambah</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border">
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Nama</th>
