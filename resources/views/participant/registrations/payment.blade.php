<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Pembayaran</h2>
            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('dashboard') }}">
                            Dashboard
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('participant.registrations.index') }}">
                            Registrasi Saya
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Pilih Metode Pembayaran</li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] sticky top-6">
                    <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Rincian Tagihan</h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Kode Event</span>
                            <span class="font-medium text-gray-800 dark:text-white">{{ $registration->event->code }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Nama Event</span>
                            <span class="font-medium text-gray-800 dark:text-white text-right">{{ Str::limit($registration->event->name, 25) }}</span>
                        </div>
                        <div class="border-t border-dashed border-gray-200 dark:border-gray-700 my-4"></div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Biaya Daftar</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}</span>
                        </div>

                        <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 mt-4">
                            <p class="text-xs text-center text-gray-500 mb-1">Total yang harus dibayar</p>
                            <p class="text-2xl font-bold text-center text-brand-600 dark:text-brand-400">
                                Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('participant.registrations.checkout', $registration) }}" method="POST" id="paymentForm" x-data="{ selectedMethod: null }">
                    @csrf

                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Pilih Metode Pembayaran</h3>
                        </div>

                        <div class="p-5">
                            @if(empty($channels))
                            <div class="text-center py-10">
                                <p class="text-red-500">Gagal memuat metode pembayaran dari Tripay.</p>
                                <p class="text-sm text-gray-500">Pastikan koneksi internet server aman atau API Key benar.</p>
                            </div>
                            @else
                            @php
                            $groups = collect($channels)->groupBy('group');
                            @endphp

                            @foreach($groups as $groupName => $paymentChannels)
                            <div class="mb-6 last:mb-0">
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3 px-1">
                                    {{ $groupName }}
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($paymentChannels as $channel)
                                    @if($channel['active'])
                                    <label class="relative cursor-pointer group">
                                        <input type="radio"
                                            name="method"
                                            value="{{ $channel['code'] }}"
                                            x-model="selectedMethod"
                                            class="peer sr-only">

                                        <div class="flex items-center justify-between p-4 border rounded-xl transition-all duration-200"
                                            :class="selectedMethod === '{{ $channel['code'] }}' 
                                            ? 'border-brand-500 bg-brand-50 ring-1 ring-brand-500 dark:bg-brand-500/10 dark:border-brand-400' 
                                            : 'border-gray-200 bg-white hover:border-brand-300 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-white/5'">

                                            <div class="flex items-center gap-3">
                                                <div class="w-14 h-9 bg-white rounded-lg border border-gray-100 flex items-center justify-center p-1 overflow-hidden transition-transform"
                                                    :class="selectedMethod === '{{ $channel['code'] }}' ? 'scale-105 shadow-sm' : ''">
                                                    <img src="{{ $channel['icon_url'] }}" alt="{{ $channel['name'] }}" class="max-w-full max-h-full object-contain">
                                                </div>

                                                <div>
                                                    <p class="font-bold text-sm transition-colors"
                                                        :class="selectedMethod === '{{ $channel['code'] }}' 
                                                        ? 'text-brand-700 dark:text-brand-400' 
                                                        : 'text-gray-800 dark:text-white'">
                                                        {{ $channel['name'] }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        Biaya: Rp {{ number_format($channel['total_fee']['flat'], 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div x-show="selectedMethod === '{{ $channel['code'] }}'"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 scale-50"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                class="w-6 h-6 rounded-full bg-brand-500 text-white flex items-center justify-center shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>

                                            <div x-show="selectedMethod !== '{{ $channel['code'] }}'"
                                                class="w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600"></div>
                                        </div>
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>

                        <div class="flex justify-end gap-4 border-t border-gray-200 px-5 py-4 bg-gray-50 dark:border-gray-800 dark:bg-white/5 rounded-b-2xl">
                            <a href="{{ route('participant.registrations.show', $registration) }}"
                                class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Batal
                            </a>

                            <button type="submit"
                                :disabled="!selectedMethod"
                                :class="selectedMethod 
                        ? 'bg-brand-500 hover:bg-brand-600 text-white' 
                        : 'bg-gray-300 cursor-not-allowed text-gray-500 dark:bg-gray-700 dark:text-gray-400'"
                                class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg px-6 py-2.5 text-sm font-medium transition-all duration-200">

                                <svg x-show="selectedMethod" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>

                                <span x-text="selectedMethod ? 'Bayar Sekarang' : 'Pilih Metode Dulu'"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
