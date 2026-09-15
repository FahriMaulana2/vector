<div
    id="omh-confirm-modal"
    x-data="confirmDeleteModal()"
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @confirm-delete.window="show($event.detail)"
    @keydown.escape.window="cancel()"
    class="fixed inset-0 z-[9998] flex items-center justify-center p-4"
    style="display:none;"
>
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="cancel()"></div>

    <!-- Dialog -->
    <div
        class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        @click.stop
    >
        <!-- Red accent bar -->
        <div class="h-1 w-full" style="background:linear-gradient(90deg,#ef4444,#dc2626)"></div>

        <div class="p-7">
            <!-- Icon -->
            <div class="flex justify-center mb-5">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center" style="background:#fee2e2;">
                    <svg class="w-8 h-8" style="color:#dc2626" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
            </div>

            <!-- Title & body -->
            <h3 class="text-center text-xl font-bold text-slate-800 mb-2" x-text="title">Hapus Data?</h3>
            <p class="text-center text-sm text-slate-500 leading-relaxed" x-html="message">
                Data ini akan dihapus secara permanen.<br>
                Tindakan ini <span class="font-semibold text-red-500">tidak dapat dibatalkan</span>.
            </p>

            <!-- Buttons -->
            <div class="flex gap-3 mt-7">
                <button
                    id="confirm-modal-cancel-btn"
                    @click="cancel()"
                    type="button"
                    class="flex-1 py-2.5 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 cursor-pointer"
                >
                    Batal
                </button>
                <button
                    id="confirm-modal-delete-btn"
                    @click="confirm()"
                    type="button"
                    class="flex-1 py-2.5 px-4 rounded-xl text-white text-sm font-semibold transition-all duration-200 hover:opacity-90 active:scale-[.98] cursor-pointer"
                    style="background:linear-gradient(135deg,#ef4444,#dc2626);box-shadow:0 4px 14px rgba(220,38,38,.35);"
                >
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDeleteModal() {
        return {
            open: false,
            pendingId: null,
            pendingComponentId: null,
            pendingAction: 'delete',
            title: 'Hapus Data?',
            message: 'Data ini akan dihapus secara permanen.<br>Tindakan ini <span class="font-semibold text-red-500">tidak dapat dibatalkan</span>.',
            show(detail) {
                this.pendingId = detail && detail.id !== undefined ? detail.id : null;
                this.pendingComponentId = (detail && detail.componentId) ? detail.componentId : null;
                this.pendingAction = (detail && detail.action) ? detail.action : 'delete';
                this.title = (detail && detail.title) ? detail.title : 'Hapus Data?';
                this.message = (detail && detail.message)
                    ? detail.message
                    : 'Data ini akan dihapus secara permanen.<br>Tindakan ini <span class="font-semibold text-red-500">tidak dapat dibatalkan</span>.';
                this.open = true;
            },
            confirm() {
                if (this.pendingComponentId && window.Livewire) {
                    const component = window.Livewire.find(this.pendingComponentId);
                    if (component) {
                        if (this.pendingId !== null && this.pendingId !== undefined) {
                            component[this.pendingAction](this.pendingId);
                        } else {
                            component[this.pendingAction]();
                        }
                    }
                }
                this.open = false;
            },
            cancel() {
                this.open = false;
            }
        };
    }
</script>
