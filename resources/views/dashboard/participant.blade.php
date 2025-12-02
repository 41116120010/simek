<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <div class="space-y-6">

            <!-- Welcome Section -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-gradient-to-r from-brand-500 to-brand-600 dark:border-gray-800">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">
                                Selamat Datang, {{ auth()->user()->name }}!
                            </h3>
                            <p class="text-white/90 text-lg">
                                Temukan dan daftarkan diri dengan mengikuti event menarik di kampus
                            </p>
                        </div>
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 text-white backdrop-blur-sm">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <article class="flex items-center gap-4 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            {{ $myRegistrations->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Registrasi Saya
                        </p>
                    </div>
                </article>

                <article class="flex items-center gap-4 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-green-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            {{ $myRegistrations->where('status', 'confirmed')->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Terkonfirmasi
                        </p>
                    </div>
                </article>

                <article class="flex items-center gap-4 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            {{ $myRegistrations->where('status', 'pending')->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Menunggu
                        </p>
                    </div>
                </article>

                <article class="flex items-center gap-4 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            {{ $availableEvents->count() }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Event Tersedia
                        </p>
                    </div>
                </article>
            </div>

            <!-- My Registrations -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex flex-col gap-4 border-b border-gray-200 px-4 py-4 sm:px-5 lg:flex-row lg:items-center lg:justify-between dark:border-gray-800">
                    <div class="flex-shrink-0">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Registrasi Saya
                        </h3>
                    </div>
                    <div>
                        <a href="{{ route('participant.registrations.index') }}" class="shadow-theme-xs flex h-11 w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 sm:w-auto sm:min-w-[100px] dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <div class="p-4 sm:p-5">
                    @forelse($myRegistrations as $registration)
                    <div class="mb-4 last:mb-0 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800/50">
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 dark:text-white/90 text-lg mb-1">
                                        {{ $registration->event->name }}
                                    </h4>
                                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium
                                            @if($registration->event->type === 'competition') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                            @else bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500
                                            @endif">
                                        @if($registration->event->type === 'competition')
                                        Lomba
                                        @else
                                        Seminar
                                        @endif
                                    </span>
                                </div>
                                <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium
                                        @if($registration->status === 'confirmed') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                        @elseif($registration->status === 'pending') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                        @elseif($registration->status === 'paid') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                        @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                        @endif">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $registration->event->start_date->format('d M Y, H:i') }} WIB</span>
                                </div>

                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $registration->event->venue }}</span>
                                </div>

                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span class="font-mono font-semibold">{{ $registration->registration_code }}</span>
                                </div>

                                @if($registration->team_name)
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>Tim: <span class="font-semibold">{{ $registration->team_name }}</span></span>
                                </div>
                                @endif
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex gap-3">
                                <a href="{{ route('participant.registrations.show', $registration) }}" class="inline-flex items-center gap-2 text-sm font-medium text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">
                                    Lihat Detail
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                @if($registration->isWaitingPayment() && $registration->payment && !$registration->payment->isExpired())
                                <a href="{{ route('participant.registrations.payment', $registration) }}" class="inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300">
                                    💳 Bayar Sekarang
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-lg font-medium mb-2">
                            Belum Ada Registrasi
                        </p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mb-4">
                            Yuk, jelajahi event menarik dan daftar sekarang!
                        </p>
                        <a href="{{ route('participant.events.index') }}" class="inline-flex items-center gap-2 bg-brand-500 text-white px-6 py-2.5 rounded-lg hover:bg-brand-600 font-medium">
                            Lihat Event Tersedia
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Available Events -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex flex-col gap-4 border-b border-gray-200 px-4 py-4 sm:px-5 lg:flex-row lg:items-center lg:justify-between dark:border-gray-800">
                    <div class="flex-shrink-0">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Event Tersedia
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Event yang bisa kamu ikuti sekarang
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('participant.events.index') }}" class="shadow-theme-xs flex h-11 w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 sm:w-auto sm:min-w-[100px] dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <div class="p-4 sm:p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($availableEvents as $event)
                        <div class="group overflow-hidden rounded-xl border border-gray-200 bg-white hover:border-brand-500 hover:shadow-lg transition-all duration-300 dark:border-gray-700 dark:bg-gray-800/50 dark:hover:border-brand-500">
                            <div class="p-4">
                                <!-- Event Type Badge -->
                                <div class="mb-3">
                                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium
                                            @if($event->type === 'competition') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                            @else bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500
                                            @endif">
                                        @if($event->type === 'competition')
                                        Lomba
                                        @else
                                        Seminar
                                        @endif
                                    </span>
                                </div>

                                <!-- Event Title -->
                                <h4 class="font-semibold text-gray-800 dark:text-white/90 text-lg mb-3 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors line-clamp-2">
                                    {{ $event->name }}
                                </h4>

                                <!-- Event Info -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $event->start_date->format('d M Y') }}</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="truncate">{{ $event->venue }}</span>
                                    </div>

                                    <!-- Quota Info -->
                                    @if($event->quota)
                                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span>{{ $event->registered_count }}/{{ $event->quota }} peserta</span>
                                    </div>
                                    @endif

                                    <div class="flex items-center gap-2">
                                        @if($event->is_free)
                                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-800 dark:text-white/90">
                                            Gratis
                                        </span>
                                        @else
                                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-800 dark:text-white/90">
                                            Rp {{ number_format($event->registration_fee, 0, ',', '.') }}
                                        </span>
                                        @endif
                                    </div>

                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('participant.events.show', $event) }}" class="block w-full text-center bg-brand-500 hover:bg-brand-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                                    Daftar Sekarang
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium mb-2">
                                Tidak Ada Event Tersedia
                            </p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm">
                                Belum ada event yang dibuka untuk pendaftaran saat ini.
                            </p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>