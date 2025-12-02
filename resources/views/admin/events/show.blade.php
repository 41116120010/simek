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
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('admin.events.index') }}">
                            Kelola Event
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">{{ $event->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- Success Message -->
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

        <!-- Event Header Card -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-6">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ $event->name }}</h3>
                            <span class="inline-flex items-center justify-center gap-1 rounded-full px-3 py-1 text-xs font-medium
                                {{ $event->type === 'competition' ? 'bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500' : 'bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500' }}">
                                {{ $event->type === 'competition' ? 'Lomba' : 'Seminar' }}
                            </span>
                            <span class="inline-flex items-center justify-center gap-1 rounded-full px-3 py-1 text-xs font-medium
                                @if($event->status === 'published') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                @elseif($event->status === 'draft') bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                @elseif($event->status === 'ongoing') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                @elseif($event->status === 'completed') bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500
                                @else bg-red-100 text-red-800 dark:bg-red-500/15 dark:text-red-500
                                @endif">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-medium">Kode Event:</span> {{ $event->code }}
                        </p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <!-- Edit Button - Butuh edit_events permission -->
                        @can('edit_events')
                            <a href="{{ route('admin.events.edit', $event) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Event
                            </a>
                        @endcan
                        
                        <!-- Back Button - Always visible -->
                        <a href="{{ route('admin.events.index') }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Left Column (2/3) -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Basic Information -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Informasi Event
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-4">
                        <div>
                            <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Deskripsi</h4>
                            <p class="text-sm text-gray-800 dark:text-white/90 whitespace-pre-line">{{ $event->description }}</p>
                        </div>

                        @if($event->terms_conditions)
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                            <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Syarat & Ketentuan</h4>
                            <p class="text-sm text-gray-800 dark:text-white/90 whitespace-pre-line">{{ $event->terms_conditions }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Competition/Seminar Details -->
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
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Min Anggota</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ $event->min_team_members }} orang</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Max Anggota</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ $event->max_team_members }} orang</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if($event->type === 'seminar')
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Pembicara
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <p class="font-semibold text-lg text-gray-800 dark:text-white/90 mb-2">{{ $event->speaker_name }}</p>
                        @if($event->speaker_bio)
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->speaker_bio }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Location & Schedule -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Lokasi & Jadwal
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">📍 Tempat</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ $event->venue }}</p>
                                @if($event->venue_address)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $event->venue_address }}</p>
                                @endif
                                @if($event->venue_link)
                                <a href="{{ $event->venue_link }}" target="_blank" class="inline-flex items-center gap-1 text-sm text-brand-500 hover:text-brand-600 mt-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Lihat di Google Maps
                                </a>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">🕒 Waktu Pelaksanaan</p>
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Mulai</p>
                                        <p class="font-semibold text-gray-800 dark:text-white/90">
                                            {{ $event->start_date->format('d M Y, H:i') }} WIB
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Selesai</p>
                                        <p class="font-semibold text-gray-800 dark:text-white/90">
                                            {{ $event->end_date->format('d M Y, H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Sessions -->
                @if($event->sessions->count() > 0)
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Sesi Event ({{ $event->sessions->count() }})
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="space-y-4">
                            @foreach($event->sessions as $session)
                            <div class="rounded-xl border border-gray-200 p-4 dark:border-gray-700">
                                <div class="flex items-start justify-between mb-2">
                                    <h4 class="font-semibold text-gray-800 dark:text-white/90">{{ $session->name }}</h4>
                                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
                                        @if($session->status === 'scheduled') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                        @elseif($session->status === 'ongoing') bg-green-100 text-green-800 dark:bg-green-500/15 dark:text-green-500
                                        @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                        @endif">
                                        {{ ucfirst($session->status) }}
                                    </span>
                                </div>
                                @if($session->description)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $session->description }}</p>
                                @endif
                                <div class="flex flex-wrap gap-3 text-xs text-gray-500 dark:text-gray-400">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $session->start_time->format('d M Y, H:i') }} - {{ $session->end_time->format('H:i') }}
                                    </span>
                                    @if($session->location)
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        </svg>
                                        {{ $session->location }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Event Requirements -->
                @if($event->requirements->count() > 0)
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Syarat Pendaftaran ({{ $event->requirements->count() }})
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="space-y-3">
                            @foreach($event->requirements as $requirement)
                            <div class="flex items-start gap-3 rounded-lg border border-gray-200 p-3 dark:border-gray-700">
                                <div class="flex-shrink-0 mt-0.5">
                                    @if($requirement->type === 'file')
                                        <span class="text-lg">📎</span>
                                    @elseif($requirement->type === 'link')
                                        <span class="text-lg">🔗</span>
                                    @else
                                        <span class="text-lg">📝</span>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                        {{ $requirement->name }}
                                        @if($requirement->is_required)
                                        <span class="text-red-500">*</span>
                                        @endif
                                    </p>
                                    @if($requirement->description)
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $requirement->description }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Tipe: <span class="font-medium">{{ ucfirst($requirement->type) }}</span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column (1/3) -->
            <div class="space-y-6">
                <!-- Registration Stats -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Statistik Registrasi
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-4">
                        <div class="text-center p-4 bg-gradient-to-br from-brand-50 to-brand-100 rounded-xl dark:from-brand-900/20 dark:to-brand-800/20">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Total Peserta</p>
                            <p class="text-3xl font-bold text-brand-600 dark:text-brand-400">
                                {{ $event->registrations_count }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                dari {{ $event->quota ?? '∞' }} kuota
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="text-center p-3 bg-gray-50 rounded-lg dark:bg-gray-800">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Biaya</p>
                                <p class="text-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $event->is_free ? 'Gratis' : 'Rp ' . number_format($event->registration_fee, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-lg dark:bg-gray-800">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Sisa Kuota</p>
                                <p class="text-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $event->quota ? ($event->quota - $event->registrations_count) : '∞' }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-100 dark:border-gray-800">
                            <div class="space-y-2 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Pendaftaran Dibuka</span>
                                    <span class="font-medium text-gray-800 dark:text-white/90">{{ $event->registration_start->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Pendaftaran Ditutup</span>
                                    <span class="font-medium text-gray-800 dark:text-white/90">{{ $event->registration_end->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Registrations -->
                @if($event->registrations->count() > 0)
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="flex justify-between items-center border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Registrasi Terbaru
                        </h3>
                        <a href="{{ route('admin.registrations.index', ['event' => $event->id]) }}" class="text-sm text-brand-500 hover:text-brand-600 font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="space-y-3">
                            @foreach($event->registrations->take(5) as $registration)
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-100 dark:border-gray-800">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-500 text-white font-semibold">
                                    {{ substr($registration->user->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white/90 truncate">
                                        {{ $registration->user->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $registration->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center justify-center gap-1 rounded-full px-2 py-0.5 text-xs font-medium shrink-0
                                    @if($registration->status === 'confirmed') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                    @elseif($registration->status === 'pending') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                    @elseif($registration->status === 'paid') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                    @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                    @endif">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Meta Information -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Informasi Sistem
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Dibuat oleh</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">{{ $event->creator->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $event->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-800">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Terakhir diupdate</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $event->updater ? $event->updater->name : '-' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $event->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    @can('edit_events')
                    <a href="{{ route('admin.events.edit', $event) }}" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white hover:bg-brand-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Event
                    </a>
                    @endcan

                    @can('delete_events')
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event {{ $event->name }}? Tindakan ini tidak dapat dibatalkan!')" {{ $event->registrations->count() > 0 ? 'x-data' : '' }}>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 hover:bg-red-100 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30" {{ $event->registrations->count() > 0 ? 'disabled' : '' }}>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Event
                        </button>
                        @if($event->registrations->count() > 0)
                        <p class="text-xs text-center text-gray-500 mt-2">Event tidak dapat dihapus karena sudah ada registrasi</p>
                        @endif
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>