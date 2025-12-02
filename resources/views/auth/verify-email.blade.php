<x-guest-layout>
    <div class="mb-4 text-sm font-normal text-gray-700 dark:text-gray-400">
        {{ __('Terima Kasih telah mendaftar! Sebelum memulai, Anda harus memverifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan kepada Anda. Jika Anda tidak menerima email tersebut, Silahkan ajukan pengiriman ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-success-600 dark:text-success-500">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm text-brand-500 hover:text-brand-600 dark:text-brand-400 focus:outline-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
