@props(['entityName' => '', 'entityType' => 'data'])

<dialog class="modal" :class="{ 'modal-open': open }">
    <div class="modal-box max-w-sm">
        <div class="text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-error/10 flex items-center justify-center">
                <svg class="w-7 h-7 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            </div>
            <h3 class="text-lg font-black text-base-content mb-1">Konfirmasi Hapus</h3>
            <p class="text-sm text-base-content/60 mb-6">Yakin ingin menghapus {{ $entityType }} <strong class="text-base-content">{{ $entityName }}</strong>? Tindakan ini tidak bisa dibatalkan.</p>
        </div>
        <div class="flex gap-2 justify-center">
            <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-bold px-6">Batal</button>
            <button @click="open = false; $el.closest('form').submit()" class="btn btn-error btn-sm font-bold px-6 text-white">Hapus</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>
