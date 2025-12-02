<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-red-800 dark:text-red-400">
            Hapus Akun
        </h2>
        <p class="mt-1 text-sm text-red-600 dark:text-red-400/80">
            Setelah akun Anda dihapus, semua data akan dihapus secara permanen. Sebelum menghapus akun, silakan download data yang ingin Anda simpan.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center px-6 py-2.5 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white shadow-theme-xs hover:bg-red-700 focus:outline-none focus:ring-3 focus:ring-red-500/10 transition"
    >
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                Setelah akun Anda dihapus, semua data akan dihapus secara permanen. Masukkan password Anda untuk mengkonfirmasi penghapusan akun.
            </p>

            <div class="mt-6">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Password <span class="text-red-500">*</span>
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Masukkan password Anda"
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                />
                @error('password', 'userDeletion')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button 
                    type="button" 
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-theme-xs hover:bg-gray-50 focus:outline-none focus:ring-3 focus:ring-gray-500/10 transition dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700"
                >
                    Batal
                </button>

                <button 
                    type="submit"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white shadow-theme-xs hover:bg-red-700 focus:outline-none focus:ring-3 focus:ring-red-500/10 transition"
                >
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>