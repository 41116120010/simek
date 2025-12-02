<x-guest-layout>
    <div class="mb-4 text-sm font-normal text-gray-700 dark:text-gray-400">
        {{ __('Tidak Mengingat Password? Tidak Masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset password yang akan memungkinkan Anda untuk memilih yang baru.') }}
    </div>

    <x-auth-session-status class="mb-4 text-sm font-medium text-success-600 dark:text-success-500" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="space-y-5">
            <div>
                <label
                    for="email"
                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"
                >
                    {{ __('Email') }}<span class="text-error-500">*</span>
                </label>
                <x-text-input 
                    id="email" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus
                    placeholder="help@daffiq.love"
                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-primary-button class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </div>
    </form>
    <div class="mt-5">
        <p class="text-sm font-normal text-center text-gray-700 dark:text-gray-400 sm:text-start">
            <a 
                href="{{ route('login') }}" 
                class="text-brand-500 hover:text-brand-600 dark:text-brand-400"
            >
                {{ __('Sudah punya akun?') }}
            </a>
        </p>
    </div>
</x-guest-layout>