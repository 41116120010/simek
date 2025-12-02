<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Edit Event</h2>
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
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('admin.events.show', $event) }}">
                            {{ $event->name }}
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Edit</li>
                </ol>
            </nav>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
                <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-500 text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </span>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-red-800 dark:text-red-400 mb-2">Terdapat error pada form:</p>
                        <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-400 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Informasi Dasar
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Informasi umum tentang event
                    </p>
                </div>
                
                <div class="p-5 sm:p-6 space-y-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Event Type -->
                        <div>
                            <label for="type" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tipe Event <span class="text-red-500">*</span>
                            </label>
                            <div x-data="{ isOptionSelected: true }" class="relative">
                                <select 
                                    id="type" 
                                    name="type" 
                                    required
                                    onchange="toggleEventTypeFields()"
                                    class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                >
                                    <option value="">Pilih Tipe Event</option>
                                    <option value="competition" {{ old('type', $event->type) == 'competition' ? 'selected' : '' }}>Lomba</option>
                                    <option value="seminar" {{ old('type', $event->type) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                </select>
                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                            @error('type')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Event Name -->
                        <div>
                            <label for="name" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Nama Event <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $event->name) }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            />
                            @error('name')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Deskripsi Event <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4" 
                            required
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                        >{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms & Conditions -->
                    <div>
                        <label for="terms_conditions" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Syarat & Ketentuan
                        </label>
                        <textarea 
                            id="terms_conditions" 
                            name="terms_conditions" 
                            rows="4"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                        >{{ old('terms_conditions', $event->terms_conditions) }}</textarea>
                        @error('terms_conditions')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Competition Specific Fields -->
            <div id="competition-fields" class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" style="display: {{ old('type', $event->type) == 'competition' ? 'block' : 'none' }};">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Detail Lomba
                    </h3>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <div>
                            <label for="competition_type" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tipe Lomba <span class="text-red-500">*</span>
                            </label>
                            <div x-data="{ isOptionSelected: {{ old('competition_type', $event->competition_type) ? 'true' : 'false' }} }" class="relative">
                                <select 
                                    id="competition_type" 
                                    name="competition_type"
                                    onchange="toggleTeamFields()"
                                    class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                >
                                    <option value="">Pilih Tipe Lomba</option>
                                    <option value="individual" {{ old('competition_type', $event->competition_type) == 'individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="team" {{ old('competition_type', $event->competition_type) == 'team' ? 'selected' : '' }}>Tim</option>
                                    <option value="both" {{ old('competition_type', $event->competition_type) == 'both' ? 'selected' : '' }}>Individual & Tim</option>
                                </select>
                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div id="min-team-field" style="display: {{ in_array(old('competition_type', $event->competition_type), ['team', 'both']) ? 'block' : 'none' }};">
                            <label for="min_team_members" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Min Anggota Tim <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="min_team_members" 
                                name="min_team_members" 
                                value="{{ old('min_team_members', $event->min_team_members) }}" 
                                min="1"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <div id="max-team-field" style="display: {{ in_array(old('competition_type', $event->competition_type), ['team', 'both']) ? 'block' : 'none' }};">
                            <label for="max_team_members" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Max Anggota Tim <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="max_team_members" 
                                name="max_team_members" 
                                value="{{ old('max_team_members', $event->max_team_members) }}" 
                                min="1"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seminar Specific Fields -->
            <div id="seminar-fields" class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" style="display: {{ old('type', $event->type) == 'seminar' ? 'block' : 'none' }};">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Detail Seminar
                    </h3>
                </div>
                
                <div class="p-5 sm:p-6 space-y-6">
                    <div>
                        <label for="speaker_name" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Nama Pembicara <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="speaker_name" 
                            name="speaker_name" 
                            value="{{ old('speaker_name', $event->speaker_name) }}"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                        />
                    </div>

                    <div>
                        <label for="speaker_bio" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Bio Pembicara
                        </label>
                        <textarea 
                            id="speaker_bio" 
                            name="speaker_bio" 
                            rows="3"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                        >{{ old('speaker_bio', $event->speaker_bio) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Location & Schedule -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Lokasi & Jadwal
                    </h3>
                </div>
                
                <div class="p-5 sm:p-6 space-y-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="venue" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tempat <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="venue" 
                                name="venue" 
                                value="{{ old('venue', $event->venue) }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <div>
                            <label for="venue_address" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Alamat Lengkap
                            </label>
                            <input 
                                type="text" 
                                id="venue_address" 
                                name="venue_address" 
                                value="{{ old('venue_address', $event->venue_address) }}"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <div>
                            <label for="start_date" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tanggal Mulai <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="start_date" 
                                name="start_date" 
                                value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <div>
                            <label for="end_date" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tanggal Selesai <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="end_date" 
                                name="end_date" 
                                value="{{ old('end_date', $event->end_date->format('Y-m-d\TH:i')) }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="venue_link" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Link Google Maps
                        </label>
                        <input 
                            type="url" 
                            id="venue_link" 
                            name="venue_link" 
                            value="{{ old('venue_link', $event->venue_link) }}"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                        />
                    </div>
                </div>
            </div>

            <!-- Registration Settings -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Pengaturan Registrasi
                    </h3>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="quota" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Kuota Peserta
                            </label>
                            <input 
                                type="number" 
                                id="quota" 
                                name="quota" 
                                value="{{ old('quota', $event->quota) }}" 
                                min="1"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kosongkan untuk unlimited peserta</p>
                        </div>

                        <div>
                            <label for="registration_fee" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Biaya Pendaftaran (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="registration_fee" 
                                name="registration_fee" 
                                value="{{ old('registration_fee', $event->registration_fee) }}" 
                                min="0" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Isi 0 untuk event gratis</p>
                        </div>

                        <div>
                            <label for="registration_start" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Pendaftaran Dibuka <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="registration_start" 
                                name="registration_start" 
                                value="{{ old('registration_start', $event->registration_start->format('Y-m-d\TH:i')) }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <div>
                            <label for="registration_end" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Pendaftaran Ditutup <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="registration_end" 
                                name="registration_end" 
                                value="{{ old('registration_end', $event->registration_end->format('Y-m-d\TH:i')) }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Status Event
                    </h3>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div class="max-w-md">
                        <label for="status" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div x-data="{ isOptionSelected: true }" class="relative">
                            <select 
                                id="status" 
                                name="status" 
                                required
                                class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            >
                                <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.events.show', $event) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Batal
                </a>
                <button type="submit" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white hover:bg-brand-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Event
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function toggleEventTypeFields() {
            const type = document.getElementById('type').value;
            const competitionFields = document.getElementById('competition-fields');
            const seminarFields = document.getElementById('seminar-fields');
            
            if (type === 'competition') {
                competitionFields.style.display = 'block';
                seminarFields.style.display = 'none';
                document.getElementById('competition_type').required = true;
                document.getElementById('speaker_name').required = false;
            } else if (type === 'seminar') {
                competitionFields.style.display = 'none';
                seminarFields.style.display = 'block';
                document.getElementById('competition_type').required = false;
                document.getElementById('speaker_name').required = true;
            } else {
                competitionFields.style.display = 'none';
                seminarFields.style.display = 'none';
            }
        }

        function toggleTeamFields() {
            const competitionType = document.getElementById('competition_type').value;
            const minField = document.getElementById('min-team-field');
            const maxField = document.getElementById('max-team-field');
            
            if (competitionType === 'team' || competitionType === 'both') {
                minField.style.display = 'block';
                maxField.style.display = 'block';
                document.getElementById('min_team_members').required = true;
                document.getElementById('max_team_members').required = true;
            } else {
                minField.style.display = 'none';
                maxField.style.display = 'none';
                document.getElementById('min_team_members').required = false;
                document.getElementById('max_team_members').required = false;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleEventTypeFields();
            toggleTeamFields();
        });
    </script>
    @endpush
</x-app-layout>