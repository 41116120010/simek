<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Buat Event Baru</h2>
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
                    <li class="text-sm text-gray-800 dark:text-white/90">Buat Event</li>
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

        <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-6">
            @csrf

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
                            <div x-data="{ isOptionSelected: {{ old('type') ? 'true' : 'false' }} }" class="relative">
                                <select 
                                    id="type" 
                                    name="type" 
                                    required
                                    onchange="toggleEventTypeFields()"
                                    class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true"
                                >
                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Pilih Tipe Event</option>
                                    <option value="competition" {{ old('type') == 'competition' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Lomba</option>
                                    <option value="seminar" {{ old('type') == 'seminar' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Seminar</option>
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
                                value="{{ old('name') }}" 
                                required
                                placeholder="Contoh: Kompetisi Web Design 2025"
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
                            placeholder="Jelaskan detail tentang event ini..."
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                        >{{ old('description') }}</textarea>
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
                            placeholder="Contoh:
1. Mahasiswa aktif D3/D4/S1
2. Membawa laptop sendiri
3. Mengikuti seluruh rangkaian acara"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                        >{{ old('terms_conditions') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Opsional - Syarat yang harus dipenuhi peserta</p>
                        @error('terms_conditions')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Competition Specific Fields -->
            <div id="competition-fields" class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" style="display: none;">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Detail Lomba
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Pengaturan khusus untuk event lomba
                    </p>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <!-- Competition Type -->
                        <div>
                            <label for="competition_type" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tipe Lomba <span class="text-red-500">*</span>
                            </label>
                            <div x-data="{ isOptionSelected: {{ old('competition_type') ? 'true' : 'false' }} }" class="relative">
                                <select 
                                    id="competition_type" 
                                    name="competition_type"
                                    onchange="toggleTeamFields()"
                                    class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true"
                                >
                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Pilih Tipe Lomba</option>
                                    <option value="individual" {{ old('competition_type') == 'individual' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Individual</option>
                                    <option value="team" {{ old('competition_type') == 'team' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Tim</option>
                                    <option value="both" {{ old('competition_type') == 'both' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Individual & Tim</option>
                                </select>
                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Min Team Members -->
                        <div id="min-team-field" style="display: none;">
                            <label for="min_team_members" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Min Anggota Tim <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="min_team_members" 
                                name="min_team_members" 
                                value="{{ old('min_team_members', 2) }}" 
                                min="1"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <!-- Max Team Members -->
                        <div id="max-team-field" style="display: none;">
                            <label for="max_team_members" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Max Anggota Tim <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="max_team_members" 
                                name="max_team_members" 
                                value="{{ old('max_team_members', 3) }}" 
                                min="1"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seminar Specific Fields -->
            <div id="seminar-fields" class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" style="display: none;">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Detail Seminar
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Informasi pembicara dan materi seminar
                    </p>
                </div>
                
                <div class="p-5 sm:p-6 space-y-6">
                    <!-- Speaker Name -->
                    <div>
                        <label for="speaker_name" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Nama Pembicara <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="speaker_name" 
                            name="speaker_name" 
                            value="{{ old('speaker_name') }}"
                            placeholder="Contoh: Dr. Ahmad Fadli, M.Kom"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                        />
                    </div>

                    <!-- Speaker Bio -->
                    <div>
                        <label for="speaker_bio" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Bio Pembicara
                        </label>
                        <textarea 
                            id="speaker_bio" 
                            name="speaker_bio" 
                            rows="3"
                            placeholder="Jelaskan latar belakang dan expertise pembicara..."
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                        >{{ old('speaker_bio') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Opsional - Profil singkat pembicara</p>
                    </div>
                </div>
            </div>

            <!-- Location & Schedule -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Lokasi & Jadwal
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Tempat dan waktu pelaksanaan event
                    </p>
                </div>
                
                <div class="p-5 sm:p-6 space-y-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Venue -->
                        <div>
                            <label for="venue" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tempat <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="venue" 
                                name="venue" 
                                value="{{ old('venue') }}" 
                                required
                                placeholder="Contoh: Aula Gedung Vokasi"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            />
                        </div>

                        <!-- Venue Address -->
                        <div>
                            <label for="venue_address" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Alamat Lengkap
                            </label>
                            <input 
                                type="text" 
                                id="venue_address" 
                                name="venue_address" 
                                value="{{ old('venue_address') }}"
                                placeholder="Jl. Prof. Dr. Hamka, Padang"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            />
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tanggal Mulai <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="start_date" 
                                name="start_date" 
                                value="{{ old('start_date') }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tanggal Selesai <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="end_date" 
                                name="end_date" 
                                value="{{ old('end_date') }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>
                    </div>

                    <!-- Venue Link -->
                    <div>
                        <label for="venue_link" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Link Google Maps
                        </label>
                        <input 
                            type="url" 
                            id="venue_link" 
                            name="venue_link" 
                            value="{{ old('venue_link') }}"
                            placeholder="https://maps.google.com/?q=..."
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                        />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Opsional - Untuk memudahkan peserta menemukan lokasi</p>
                    </div>
                </div>
            </div>

            <!-- Registration Settings -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Pengaturan Registrasi
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Kuota, biaya, dan periode pendaftaran
                    </p>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Quota -->
                        <div>
                            <label for="quota" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Kuota Peserta
                            </label>
                            <input 
                                type="number" 
                                id="quota" 
                                name="quota" 
                                value="{{ old('quota') }}" 
                                min="1"
                                placeholder="Kosongkan jika unlimited"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kosongkan untuk unlimited peserta</p>
                        </div>

                        <!-- Registration Fee -->
                        <div>
                            <label for="registration_fee" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Biaya Pendaftaran (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="registration_fee" 
                                name="registration_fee" 
                                value="{{ old('registration_fee', 0) }}" 
                                min="0" 
                                required
                                placeholder="0"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Isi 0 untuk event gratis</p>
                        </div>

                        <!-- Registration Start -->
                        <div>
                            <label for="registration_start" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Pendaftaran Dibuka <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="registration_start" 
                                name="registration_start" 
                                value="{{ old('registration_start') }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>

                        <!-- Registration End -->
                        <div>
                            <label for="registration_end" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Pendaftaran Ditutup <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="registration_end" 
                                name="registration_end" 
                                value="{{ old('registration_end') }}" 
                                required
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Sessions (Dynamic) -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between items-center border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Sesi Event
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Jadwal acara per sesi (opsional)
                        </p>
                    </div>
                    <button 
                        type="button" 
                        onclick="addSession()" 
                        class="shadow-theme-xs inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Sesi
                    </button>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div id="sessions-container" class="space-y-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-8">
                            Belum ada sesi. Klik "Tambah Sesi" untuk menambahkan jadwal acara.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Event Requirements (Dynamic) -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between items-center border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Syarat Pendaftaran
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Dokumen/data yang harus dilengkapi peserta (opsional)
                        </p>
                    </div>
                    <button 
                        type="button" 
                        onclick="addRequirement()" 
                        class="shadow-theme-xs inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Syarat
                    </button>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div id="requirements-container" class="space-y-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-8">
                            Belum ada syarat. Klik "Tambah Syarat" untuk menambahkan persyaratan pendaftaran.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Status Event
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Tentukan status publikasi event
                    </p>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div class="max-w-md">
                        <label for="status" class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div x-data="{ isOptionSelected: {{ old('status', 'draft') ? 'true' : 'false' }} }" class="relative">
                            <select 
                                id="status" 
                                name="status" 
                                required
                                class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                @change="isOptionSelected = true"
                            >
                                <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Draft (Belum Dipublikasi)</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Published (Dipublikasikan)</option>
                            </select>
                            <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Draft tidak akan terlihat oleh peserta</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.events.index') }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Batal
                </a>
                <button type="submit" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white hover:bg-brand-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Event
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        let sessionIndex = 0;
        let requirementIndex = 0;

        // Toggle event type specific fields
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

        // Toggle team fields
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

        // Add Session
        function addSession() {
            const container = document.getElementById('sessions-container');
            
            // Remove empty message if exists
            const emptyMsg = container.querySelector('p');
            if (emptyMsg) emptyMsg.remove();
            
            const sessionHTML = `
                <div class="rounded-xl border border-gray-300 dark:border-gray-700 p-4 session-item" data-index="${sessionIndex}">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-semibold text-gray-900 dark:text-white/90">Sesi #${sessionIndex + 1}</h4>
                        <button type="button" onclick="removeSession(${sessionIndex})" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium">
                            Hapus
                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Nama Sesi <span class="text-red-500">*</span></label>
                            <input type="text" name="sessions[${sessionIndex}][name]" required placeholder="Contoh: Opening Ceremony" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Lokasi</label>
                            <input type="text" name="sessions[${sessionIndex}][location]" placeholder="Opsional" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Waktu Mulai <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="sessions[${sessionIndex}][start_time]" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Waktu Selesai <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="sessions[${sessionIndex}][end_time]" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                        </div>
                        <div class="lg:col-span-2">
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Deskripsi</label>
                            <textarea name="sessions[${sessionIndex}][description]" rows="2" placeholder="Deskripsi sesi (opsional)" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"></textarea>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', sessionHTML);
            sessionIndex++;
        }

        // Remove Session
        function removeSession(index) {
            const session = document.querySelector(`.session-item[data-index="${index}"]`);
            if (session) {
                session.remove();
                
                // Show empty message if no sessions
                const container = document.getElementById('sessions-container');
                if (container.querySelectorAll('.session-item').length === 0) {
                    container.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400 text-center py-8">Belum ada sesi. Klik "Tambah Sesi" untuk menambahkan jadwal acara.</p>';
                }
            }
        }

        // Add Requirement
        function addRequirement() {
            const container = document.getElementById('requirements-container');
            
            // Remove empty message if exists
            const emptyMsg = container.querySelector('p');
            if (emptyMsg) emptyMsg.remove();
            
            const requirementHTML = `
                <div class="rounded-xl border border-gray-300 dark:border-gray-700 p-4 requirement-item" data-index="${requirementIndex}">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-semibold text-gray-900 dark:text-white/90">Syarat #${requirementIndex + 1}</h4>
                        <button type="button" onclick="removeRequirement(${requirementIndex})" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium">
                            Hapus
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Nama Syarat <span class="text-red-500">*</span></label>
                                <input type="text" name="requirements[${requirementIndex}][name]" required placeholder="Contoh: KTM" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Tipe Input <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="requirements[${requirementIndex}][type]" required class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                                        <option value="text" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Text</option>
                                        <option value="file" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">File Upload</option>
                                        <option value="link" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Link/URL</option>
                                    </select>
                                    <span class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Deskripsi</label>
                            <input type="text" name="requirements[${requirementIndex}][description]" placeholder="Contoh: Upload scan KTM dalam format JPG/PNG" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        </div>
                        <div>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="requirements[${requirementIndex}][is_required]" value="1" checked class="h-5 w-5 rounded border-gray-300 text-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Wajib diisi</span>
                            </label>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', requirementHTML);
            requirementIndex++;
        }

        // Remove Requirement
        function removeRequirement(index) {
            const requirement = document.querySelector(`.requirement-item[data-index="${index}"]`);
            if (requirement) {
                requirement.remove();
                
                // Show empty message if no requirements
                const container = document.getElementById('requirements-container');
                if (container.querySelectorAll('.requirement-item').length === 0) {
                    container.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400 text-center py-8">Belum ada syarat. Klik "Tambah Syarat" untuk menambahkan persyaratan pendaftaran.</p>';
                }
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleEventTypeFields();
            toggleTeamFields();
        });
    </script>
    @endpush>
</x-app-layout>