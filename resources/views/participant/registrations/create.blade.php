<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Form Pendaftaran Event</h2>
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
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('participant.events.show', $event) }}">
                            {{ Str::limit($event->name, 30) }}
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Form Pendaftaran</li>
                </ol>
            </nav>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
                <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </span>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-red-800 dark:text-red-400 mb-2">Error!</p>
                        <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-400 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" class="text-red-500 hover:text-red-700">
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

        <form method="POST" action="{{ route('participant.registrations.store', $event) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Event Info -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Event</h3>
                </div>
                <div class="p-5 sm:p-6">
                    <h4 class="text-xl font-bold text-gray-800 dark:text-white/90 mb-3">{{ $event->name }}</h4>
                    <div class="flex flex-wrap gap-3 text-sm text-gray-600 dark:text-gray-400">
                        <span class="inline-flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $event->start_date->format('d M Y') }}
                        </span>
                        <span>•</span>
                        <span class="inline-flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $event->venue }}
                        </span>
                        <span>•</span>
                        <span class="font-semibold text-gray-800 dark:text-white/90">
                            {{ $event->is_free ? 'Gratis' : 'Rp ' . number_format($event->registration_fee, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Participant Info (Auto-filled) -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Peserta</h3>
                </div>
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                            <input type="text" value="{{ auth()->user()->name }}" readonly class="block w-full rounded-lg border-gray-300 bg-gray-100 px-4 py-2.5 text-sm text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="text" value="{{ auth()->user()->email }}" readonly class="block w-full rounded-lg border-gray-300 bg-gray-100 px-4 py-2.5 text-sm text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                            <input type="text" value="{{ auth()->user()->phone }}" readonly class="block w-full rounded-lg border-gray-300 bg-gray-100 px-4 py-2.5 text-sm text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Institusi</label>
                            <input type="text" value="{{ auth()->user()->institution }}" readonly class="block w-full rounded-lg border-gray-300 bg-gray-100 px-4 py-2.5 text-sm text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Info (if competition team) -->
            @if($event->isCompetition() && in_array($event->competition_type, ['team', 'both']))
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Tim</h3>
                </div>
                <div class="p-5 sm:p-6">
                    <!-- Team Name -->
                    <div class="mb-6">
                        <label for="team_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Tim <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="team_name" name="team_name" value="{{ old('team_name') }}" required placeholder="Contoh: Tim Jagoan" class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500">
                    </div>

                    <!-- Team Members -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">
                                Anggota Tim (Min: {{ $event->min_team_members - 1 }}, Max: {{ $event->max_team_members - 1 }}) <span class="text-red-500">*</span>
                            </label>
                            <button type="button" onclick="addMember()" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-3 py-2 text-xs font-medium text-white hover:bg-brand-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Anggota
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                            Anda otomatis menjadi ketua tim. Tambahkan anggota tim lainnya di bawah.
                        </p>
                        <div id="members-container" class="space-y-4">
                            <!-- Members will be added here dynamically -->
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Requirements -->
            @if($event->requirements->count() > 0)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Persyaratan Pendaftaran</h3>
                </div>
                <div class="p-5 sm:p-6 space-y-4">
                    @foreach($event->requirements as $requirement)
                    <div>
                        <label for="requirement_{{ $requirement->id }}" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ $requirement->name }}
                            @if($requirement->is_required)
                            <span class="text-red-500">*</span>
                            @endif
                        </label>
                        @if($requirement->description)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $requirement->description }}</p>
                        @endif
                        
                        @if($requirement->type === 'file')
                            <input type="file" id="requirement_{{ $requirement->id }}" name="requirement_{{ $requirement->id }}" {{ $requirement->is_required ? 'required' : '' }} accept=".jpg,.jpeg,.png,.pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 dark:file:bg-brand-500/10 dark:file:text-brand-500">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Format: JPG, PNG, PDF (Max 2MB)</p>
                        @elseif($requirement->type === 'link')
                            <input type="url" id="requirement_{{ $requirement->id }}" name="requirement_{{ $requirement->id }}" {{ $requirement->is_required ? 'required' : '' }} placeholder="https://..." class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        @else
                            <input type="text" id="requirement_{{ $requirement->id }}" name="requirement_{{ $requirement->id }}" {{ $requirement->is_required ? 'required' : '' }} class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Notes -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Catatan Tambahan</h3>
                </div>
                <div class="p-5 sm:p-6">
                    <label for="notes" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan (Opsional)</label>
                    <textarea id="notes" name="notes" rows="4" placeholder="Tuliskan catatan atau pertanyaan jika ada" class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm placeholder:text-gray-400 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500">{{ old('notes') }}</textarea>
                </div>
            </div>

            <!-- Agreement -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-5 sm:p-6">
                    <label class="flex items-start">
                        <input type="checkbox" required class="mt-1 h-4 w-4 rounded border-gray-300 text-brand-500 shadow-sm focus:ring-brand-500">
                        <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                            Saya menyatakan bahwa data yang saya isi adalah benar dan saya telah membaca serta menyetujui syarat & ketentuan event ini.
                        </span>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('participant.events.show', $event) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </a>
                <button type="submit" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Daftar Event
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        let memberIndex = 0;
        const maxMembers = {{ $event->max_team_members ?? 3 }} - 1; // -1 because leader is auto-included

        function addMember() {
            if (memberIndex >= maxMembers) {
                alert('Maksimal ' + maxMembers + ' anggota tim (selain ketua)');
                return;
            }

            const container = document.getElementById('members-container');
            const memberHTML = `
                <div class="rounded-2xl border border-gray-200 bg-white p-5 member-item dark:border-gray-800 dark:bg-white/[0.03]" data-index="${memberIndex}">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="font-semibold text-gray-800 dark:text-white/90">Anggota #${memberIndex + 1}</h5>
                        <button type="button" onclick="removeMember(${memberIndex})" class="text-red-600 hover:text-red-800 text-sm font-medium dark:text-red-500 dark:hover:text-red-400">
                            Hapus
                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="members[${memberIndex}][name]" required class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="members[${memberIndex}][email]" required class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                No. Telepon
                            </label>
                            <input type="text" name="members[${memberIndex}][phone]" class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Institusi
                            </label>
                            <input type="text" name="members[${memberIndex}][institution]" class="block w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', memberHTML);
            memberIndex++;
        }

        function removeMember(index) {
            const member = document.querySelector(`.member-item[data-index="${index}"]`);
            if (member) {
                member.remove();
                memberIndex--;
            }
        }

        // Auto add 1 member on load for team events
        @if($event->isCompetition() && in_array($event->competition_type, ['team', 'both']))
        document.addEventListener('DOMContentLoaded', function() {
            addMember();
        });
        @endif
    </script>
    @endpush
</x-app-layout>