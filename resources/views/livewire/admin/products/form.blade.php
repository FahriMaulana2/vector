<div>
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <a
                href="{{ route('admin.products.index') }}"
                wire:navigate
                class="p-2 rounded-xl text-text-secondary hover:text-primary hover:bg-primary/5 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">
                    {{ $isEditing ? 'Edit Produk' : 'Tambah Produk' }}
                </h1>

                <p class="text-text-secondary mt-1.5 text-sm">
                    {{ $isEditing
                        ? 'Perbarui informasi produk OMH Vector.'
                        : 'Tambahkan produk baru ke katalog OMH Vector.'
                    }}
                </p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form wire:submit="save" class="space-y-6">

        {{-- Informasi Produk --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">
                    Informasi Produk
                </h2>

                <p class="text-sm text-text-secondary mt-1">
                    Informasi yang akan ditampilkan pada katalog produk.
                </p>
            </div>

            <div class="p-6 space-y-6">

                {{-- Nama Produk --}}
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-text-primary mb-2"
                    >
                        Nama Produk <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="name"
                        type="text"
                        wire:model="name"
                        placeholder="Contoh: Banner Custom"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                    >

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label
                        for="description"
                        class="block text-sm font-medium text-text-primary mb-2"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        id="description"
                        wire:model="description"
                        rows="5"
                        placeholder="Jelaskan secara singkat mengenai produk..."
                        class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition resize-none"
                    ></textarea>

                    @error('description')
                        <p class="mt-1.5 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Kategori Produk --}}
                <div>
                    <label
                        for="product_category_id"
                        class="block text-sm font-medium text-text-primary mb-2"
                    >
                        Kategori Produk <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="product_category_id"
                        wire:model="product_category_id"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                    >
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('product_category_id')
                        <p class="mt-1.5 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Badge + Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Badge --}}
                    <div>
                        <label
                            for="badge"
                            class="block text-sm font-medium text-text-primary mb-2"
                        >
                            Badge
                        </label>

                        <input
                            id="badge"
                            type="text"
                            wire:model="badge"
                            placeholder="Contoh: Populer"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >

                        <p class="mt-1.5 text-xs text-text-secondary">
                            Opsional. Contoh: Baru, Populer, Best Seller.
                        </p>

                        @error('badge')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label
                            for="is_active"
                            class="block text-sm font-medium text-text-primary mb-2"
                        >
                            Status <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="is_active"
                            wire:model="is_active"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>

                        @error('is_active')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

            </div>
        </div>

        {{-- Harga --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">
                    Informasi Harga
                </h2>

                <p class="text-sm text-text-secondary mt-1">
                    Harga produk akan diberikan oleh admin melalui WhatsApp.
                </p>
            </div>

            <div class="p-6">
                <div class="flex items-start gap-4 p-4 rounded-xl bg-blue-50 border border-blue-100">
                    <div class="flex-shrink-0">
                        <svg
                            class="w-5 h-5 text-primary mt-0.5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-blue-900">
                            Harga tidak ditampilkan di katalog.
                        </p>

                        <p class="text-sm text-blue-700 mt-1">
                            Pelanggan akan diarahkan untuk menghubungi admin melalui
                            WhatsApp untuk mendapatkan informasi harga dan melakukan
                            pemesanan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gambar Utama --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">
                    Gambar Produk
                </h2>

                <p class="text-sm text-text-secondary mt-1">
                    Upload gambar utama yang akan digunakan pada card produk.
                </p>
            </div>

            <div class="p-6">

                {{-- Existing image --}}
                @if($existing_image && !$image)
                    <div class="mb-4">
                        <p class="text-xs font-medium text-text-secondary mb-2">
                            Gambar saat ini
                        </p>

                        <img
                            src="{{ asset('storage/' . $existing_image) }}"
                            alt="{{ $name }}"
                            class="w-full max-w-md h-64 object-cover rounded-2xl border border-border"
                        >
                    </div>
                @endif

                {{-- Preview image --}}
                @if($image)
                    <div class="mb-4">
                        <p class="text-xs font-medium text-text-secondary mb-2">
                            Preview gambar baru
                        </p>

                        <img
                            src="{{ $image->temporaryUrl() }}"
                            alt="Preview"
                            class="w-full max-w-md h-64 object-cover rounded-2xl border border-border"
                        >
                    </div>
                @endif

                <label
                    for="image"
                    class="flex flex-col items-center justify-center w-full max-w-md h-48 border-2 border-dashed border-border rounded-2xl cursor-pointer hover:border-primary hover:bg-primary/5 transition"
                >
                    <svg
                        class="w-10 h-10 text-text-secondary mb-3"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-10h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                    </svg>

                    <span class="text-sm font-medium text-text-primary">
                        Pilih gambar
                    </span>

                    <span class="text-xs text-text-secondary mt-1">
                        JPG, JPEG, PNG maksimal 2MB
                    </span>

                    <input
                        id="image"
                        type="file"
                        wire:model="image"
                        accept="image/*"
                        class="hidden"
                    >
                </label>

                @error('image')
                    <p class="mt-1.5 text-xs text-red-500">
                        {{ $message }}
                    </p>
                @enderror

                <div wire:loading wire:target="image" class="mt-3 text-sm text-primary">
                    Mengunggah gambar...
                </div>

            </div>
        </div>

        {{-- Gallery --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">
                    Gallery Produk
                </h2>

                <p class="text-sm text-text-secondary mt-1">
                    Opsional. Tambahkan beberapa gambar pendukung produk.
                </p>
            </div>

            <div class="p-6">

                {{-- Existing gallery --}}
                @if(count($existing_gallery) > 0)
                    <div class="mb-6">
                        <p class="text-xs font-medium text-text-secondary mb-3">
                            Gallery saat ini
                        </p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($existing_gallery as $galleryImage)
                                <div class="aspect-square rounded-xl overflow-hidden border border-border">
                                    <img
                                        src="{{ asset('storage/' . $galleryImage) }}"
                                        alt="{{ $name }}"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Upload gallery --}}
                <label
                    for="gallery"
                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-border rounded-2xl cursor-pointer hover:border-primary hover:bg-primary/5 transition"
                >
                    <svg
                        class="w-8 h-8 text-text-secondary mb-2"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    <span class="text-sm font-medium text-text-primary">
                        Tambahkan gambar gallery
                    </span>

                    <span class="text-xs text-text-secondary mt-1">
                        Bisa memilih beberapa gambar
                    </span>

                    <input
                        id="gallery"
                        type="file"
                        wire:model="gallery"
                        accept="image/*"
                        multiple
                        class="hidden"
                    >
                </label>

                @error('gallery.*')
                    <p class="mt-1.5 text-xs text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>
        </div>

        {{-- Action --}}
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

            <a
                href="{{ route('admin.products.index') }}"
                wire:navigate
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-border text-sm font-semibold text-text-primary hover:bg-surface transition"
            >
                Batal
            </a>

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-dark transition shadow-button disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <svg
                    wire:loading.remove
                    wire:target="save"
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                <svg
                    wire:loading
                    wire:target="save"
                    class="w-4 h-4 animate-spin"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>

                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                    ></path>
                </svg>

                <span wire:loading.remove wire:target="save">
                    {{ $isEditing ? 'Simpan Perubahan' : 'Tambah Produk' }}
                </span>

                <span wire:loading wire:target="save">
                    Menyimpan...
                </span>
            </button>

        </div>

    </form>
</div>