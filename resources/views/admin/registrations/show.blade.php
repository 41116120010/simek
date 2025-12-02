<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Detail Registrasi</h2>
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
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('admin.registrations.index') }}">
                            Registrasi
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">{{ $registration->registration_code }}</li>
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

        <!-- Registration Header Card -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-6">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ $registration->registration_code }}</h3>
                            <span class="inline-flex items-center justify-center gap-1 rounded-full px-3 py-1 text-xs font-medium
                                @if($registration->status === 'confirmed') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                @elseif($registration->status === 'pending') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                @elseif($registration->status === 'paid') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                @elseif($registration->status === 'waiting_payment') bg-orange-100 text-orange-800 dark:bg-orange-500/15 dark:text-orange-500
                                @elseif($registration->status === 'attended') bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500
                                @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <span class="inline-flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Terdaftar pada: {{ $registration->created_at->format('d M Y, H:i') }} WIB
                            </span>
                        </p>
                    </div>
                    
                    <!-- Back Button -->
                    <a href="{{ route('admin.registrations.index') }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Left Column (2/3) -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Participant & Event Info -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Informasi Peserta & Event
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Participant Info -->
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-3">INFORMASI PESERTA</h4>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nama Lengkap</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->user->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Email</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">No. Telepon</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->user->phone ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Institusi</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->user->institution ?? '-' }}</p>
                                    </div>
                                    @if($registration->user->address)
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Alamat</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->user->address }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Event Info -->
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-3">INFORMASI EVENT</h4>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nama Event</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->event->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tipe Event</p>
                                        <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
                                            {{ $registration->event->type === 'competition' ? 'bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500' : 'bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500' }}">
                                            {{ $registration->event->type === 'competition' ? 'Lomba' : 'Seminar' }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tanggal Event</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->event->start_date->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Lokasi</p>
                                        <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $registration->event->venue }}</p>
                                        @if($registration->event->venue_address)
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $registration->event->venue_address }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Members -->
                @if($registration->event->type === 'competition' && $registration->team_name)
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Anggota Tim: {{ $registration->team_name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Total {{ $registration->members->count() }} anggota
                        </p>
                    </div>
                    <div class="p-5 sm:p-6">
                        @if($registration->members->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <th class="py-3 pr-5 text-left text-xs font-medium text-gray-500 dark:text-gray-400">#</th>
                                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama</th>
                                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Email</th>
                                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No. Telepon</th>
                                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @foreach($registration->members as $index => $member)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                                                <td class="py-3 pr-5">
                                                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-500 text-sm font-semibold text-white">
                                                        {{ $index + 1 }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-3">
                                                    <p class="font-medium text-sm text-gray-800 dark:text-white/90">{{ $member->name }}</p>
                                                </td>
                                                <td class="px-5 py-3">
                                                    <p class="text-sm text-gray-800 dark:text-white/90">{{ $member->email }}</p>
                                                </td>
                                                <td class="px-5 py-3">
                                                    <p class="text-sm text-gray-800 dark:text-white/90">{{ $member->phone ?? '-' }}</p>
                                                </td>
                                                <td class="px-5 py-3">
                                                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
                                                        {{ $member->role === 'leader' ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-500/15 dark:text-indigo-500' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400' }}">
                                                        {{ ucfirst($member->role) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-8 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada anggota tim</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Requirement Answers -->
                @if($registration->requirement_answers && count($registration->requirement_answers) > 0)
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Jawaban Syarat Pendaftaran
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="space-y-4">
                            @foreach($registration->requirement_answers as $reqId => $answer)
                                @php
                                    $requirement = $registration->event->requirements->firstWhere('id', $reqId);
                                @endphp
                                @if($requirement)
                                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                                    <div class="flex items-start gap-3">
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
                                            <p class="font-semibold text-sm text-gray-800 dark:text-white/90 mb-2">{{ $requirement->name }}</p>
                                            <div class="rounded-lg bg-gray-50 px-3 py-2 dark:bg-gray-800">
                                                @if($requirement->type === 'file')
                                                    <a href="#" class="inline-flex items-center gap-2 text-sm text-brand-500 hover:text-brand-600">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        {{ basename($answer) }}
                                                    </a>
                                                @elseif($requirement->type === 'link')
                                                    <a href="{{ $answer }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-brand-500 hover:text-brand-600 break-all">
                                                        <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                        </svg>
                                                        {{ $answer }}
                                                    </a>
                                                @else
                                                    <p class="text-sm text-gray-800 dark:text-white/90">{{ $answer }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column (1/3) -->
            <div class="space-y-6">
                <!-- Payment Info -->
                @if($registration->payment)
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Informasi Pembayaran
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-4">
                        <div class="text-center p-4 bg-gradient-to-br from-brand-50 to-brand-100 rounded-xl dark:from-brand-900/20 dark:to-brand-800/20">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-brand-600 dark:text-brand-400">
                                Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Reference</p>
                                <p class="font-mono font-semibold text-gray-800 dark:text-white/90">{{ $registration->payment->reference }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Metode Pembayaran</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->payment->payment_channel ?? 'Belum dipilih' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Status Pembayaran</p>
                                <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
                                    @if($registration->payment->status === 'paid') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                    @elseif($registration->payment->status === 'unpaid') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                    @else bg-red-100 text-red-800 dark:bg-red-500/15 dark:text-red-500
                                    @endif">
                                    {{ ucfirst($registration->payment->status) }}
                                </span>
                            </div>
                            @if($registration->payment->paid_at)
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tanggal Bayar</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->payment->paid_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @elseif($registration->event->is_free)
                <div class="rounded-2xl border border-green-200 bg-green-50 p-5 dark:border-green-800 dark:bg-green-900/20">
                    <div class="flex items-center gap-3">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-green-500 text-white text-xl">
                            💚
                        </span>
                        <div>
                            <p class="font-semibold text-green-800 dark:text-green-400">Event Gratis</p>
                            <p class="text-sm text-green-700 dark:text-green-500">Tidak memerlukan pembayaran</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Tindakan
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-3">
                        <!-- Approve Button - Butuh approve_registrations permission -->
                        @can('approve_registrations')
                            @if(in_array($registration->status, ['pending', 'paid']))
                                <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST" onsubmit="return confirm('Konfirmasi registrasi {{ $registration->user->name }}?')">
                                    @csrf
                                    <button type="submit" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-lg bg-success-500 px-4 py-3 text-sm font-medium text-white hover:bg-success-600">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Approve Registrasi
                                    </button>
                                </form>
                            @endif
                        @endcan

                        <!-- Reject Button - Butuh reject_registrations permission -->
                        @can('reject_registrations')
                            @if(!in_array($registration->status, ['confirmed', 'attended', 'cancelled']))
                                <form action="{{ route('admin.registrations.reject', $registration) }}" method="POST" onsubmit="return confirm('Tolak registrasi {{ $registration->user->name }}?')">
                                    @csrf
                                    <button type="submit" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 hover:bg-red-100 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Reject Registrasi
                                    </button>
                                </form>
                            @endif
                        @endcan

                        @if($registration->status === 'confirmed')
                            <div class="rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
                                <div class="flex items-center gap-2 text-green-800 dark:text-green-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Registrasi Terkonfirmasi</span>
                                </div>
                            </div>
                        @endif

                        @if($registration->status === 'cancelled')
                            <div class="rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
                                <div class="flex items-center gap-2 text-red-800 dark:text-red-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Registrasi Dibatalkan</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline/Activity Log (Optional - jika ada) -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Timeline
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-500 text-white">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div class="h-full w-0.5 bg-gray-200 dark:bg-gray-700"></div>
                                </div>
                                <div class="flex-1 pb-4">
                                    <p class="font-semibold text-sm text-gray-800 dark:text-white/90">Registrasi Dibuat</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $registration->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            @if($registration->updated_at != $registration->created_at)
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-300 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-gray-800 dark:text-white/90">Terakhir Diupdate</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $registration->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>