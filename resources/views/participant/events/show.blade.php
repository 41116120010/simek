<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Detail Event</h2>
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
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('participant.events.index') }}">
                            Event Tersedia
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">{{ $event->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- Success/Error/Info Messages -->
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </span>
                    <p class="text-sm font-medium text-green-800 dark:text-green-400">{{ session('success') }}</p>
                    <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </span>
                    <p class="text-sm font-medium text-red-800 dark:text-red-400">{{ session('error') }}</p>
                    <button @click="show = false" class="ml-auto text-red-500 hover:text-red-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/20">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500 text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                    <p class="text-sm font-medium text-blue-800 dark:text-blue-400">{{ session('info') }}</p>
                    <button @click="show = false" class="ml-auto text-blue-500 hover:text-blue-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="space-y-6">
            <!-- Event Header -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-5 sm:p-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90 mb-3">{{ $event->name }}</h3>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center justify-center gap-1 rounded-full px-3 py-1 text-xs font-medium
                                    {{ $event->type === 'competition' ? 'bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500' : 'bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500' }}">
                                    {{ $event->type === 'competition' ? 'Lomba' : 'Seminar' }}
                                </span>
                                @if($event->is_free)
                                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-3 py-1 text-xs font-medium bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                        Gratis
                                    </span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('participant.events.index') }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Deskripsi Event</h4>
                        <p class="text-sm text-gray-800 dark:text-white/90 whitespace-pre-line">{{ $event->description }}</p>
                    </div>

                    @if($event->terms_conditions)
                    <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Syarat & Ketentuan</h4>
                        <p class="text-sm text-gray-800 dark:text-white/90 whitespace-pre-line">{{ $event->terms_conditions }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Event Info Grid -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Schedule & Location -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Jadwal & Lokasi
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Waktu Pelaksanaan</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $event->start_date->format('d M Y, H:i') }} - {{ $event->end_date->format('H:i') }} WIB
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tempat</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">{{ $event->venue }}</p>
                            @if($event->venue_address)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $event->venue_address }}</p>
                            @endif
                            @if($event->venue_link)
                            <a href="{{ $event->venue_link }}" target="_blank" class="text-brand-500 hover:text-brand-600 text-sm mt-2 inline-flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Lihat di Google Maps
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Registration Info -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Informasi Pendaftaran
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Biaya Pendaftaran</p>
                            <p class="font-bold text-gray-800 dark:text-white/90 text-2xl">
                                {{ $event->is_free ? 'Gratis' : 'Rp ' . number_format($event->registration_fee, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kuota Peserta</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $event->registered_count }} / {{ $event->quota ?? '∞' }} terdaftar
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Periode Pendaftaran</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $event->registration_start->format('d M Y') }} - {{ $event->registration_end->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Competition/Seminar Specific Info -->
            @if($event->type === 'competition')
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Detail Lomba
                    </h3>
                </div>
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tipe Lomba</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                @if($event->competition_type === 'individual') Individual
                                @elseif($event->competition_type === 'team') Tim
                                @else Individual & Tim
                                @endif
                            </p>
                        </div>
                        @if($event->competition_type !== 'individual')
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Jumlah Anggota Tim</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $event->min_team_members }} - {{ $event->max_team_members }} orang
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            @if($event->type === 'seminar' && $event->speaker_name)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Pembicara
                    </h3>
                </div>
                <div class="p-5 sm:p-6">
                    <p class="font-bold text-gray-800 dark:text-white/90 text-xl mb-2">{{ $event->speaker_name }}</p>
                    @if($event->speaker_bio)
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->speaker_bio }}</p>
                    @endif
                </div>
            </div>
            @endif

            <!-- Event Sessions -->
            @if($event->sessions->count() > 0)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Rundown Acara
                    </h3>
                </div>
                <div class="p-5 sm:p-6 space-y-3">
                    @foreach($event->sessions as $session)
                    <div class="border-l-4 border-brand-500 pl-4 py-3 bg-gray-50 dark:bg-white/[0.02] rounded-r-lg">
                        <p class="font-semibold text-gray-800 dark:text-white/90">{{ $session->name }}</p>
                        @if($session->description)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $session->description }}</p>
                        @endif
                        <div class="flex flex-wrap gap-4 mt-2 text-sm text-gray-600 dark:text-gray-400">
                            <span class="inline-flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}
                            </span>
                            @if($session->location)
                            <span class="inline-flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $session->location }}
                            </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Requirements -->
            @if($event->requirements->count() > 0)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Persyaratan Pendaftaran
                    </h3>
                </div>
                <div class="p-5 sm:p-6 space-y-3">
                    @foreach($event->requirements as $requirement)
                    <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-white/[0.02] rounded-lg border border-gray-200 dark:border-gray-800">
                        <div class="flex-shrink-0 mt-0.5">
                            @if($requirement->type === 'file')
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                            @elseif($requirement->type === 'link')
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            @else
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $requirement->name }}
                                @if($requirement->is_required)
                                <span class="text-red-500 text-xs">*</span>
                                @endif
                            </p>
                            @if($requirement->description)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $requirement->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Registration Status & Action -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-8 sm:p-10 text-center">
                    @if($userRegistration)
                        <!-- Already Registered -->
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-500/15 mb-4">
                            <svg class="h-8 w-8 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-800 dark:text-white/90 mb-2">
                            Anda sudah terdaftar di event ini
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                            Kode Registrasi: <span class="font-mono font-bold text-gray-800 dark:text-white/90">{{ $userRegistration->registration_code }}</span>
                        </p>
                        <a href="{{ route('participant.registrations.show', $userRegistration) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white hover:bg-brand-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Detail Registrasi
                        </a>
                    @elseif($event->canRegister())
                        <!-- Can Register -->
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand-500/10 mb-4">
                            <svg class="h-8 w-8 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-800 dark:text-white/90 mb-2">
                            Pendaftaran Dibuka!
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                            Buruan daftar sebelum kuota penuh atau pendaftaran ditutup
                        </p>
                        <a href="{{ route('participant.registrations.create', $event) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-8 py-4 text-base font-semibold text-white hover:bg-brand-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Daftar Sekarang
                        </a>
                    @elseif($event->isFull())
                        <!-- Full -->
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 dark:bg-red-500/15 mb-4">
                            <svg class="h-8 w-8 text-red-600 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-red-600 dark:text-red-500 mb-2">
                            Kuota Peserta Sudah Penuh
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Maaf, event ini sudah mencapai batas maksimal peserta.
                        </p>
                    @else
                        <!-- Registration Closed -->
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 dark:bg-orange-500/15 mb-4">
                            <svg class="h-8 w-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-orange-600 dark:text-orange-400 mb-2">
                            Pendaftaran Ditutup
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Periode pendaftaran untuk event ini sudah berakhir.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>