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
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('participant.registrations.index') }}">
                            Registrasi Saya
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

        <div class="space-y-6">
            <!-- Registration Header -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-5 sm:p-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90 mb-2">{{ $registration->registration_code }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Terdaftar pada: {{ $registration->created_at->format('d M Y, H:i') }} WIB
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center gap-1 rounded-full px-3 py-1 text-xs font-medium
                                @if($registration->status === 'confirmed') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                @elseif($registration->status === 'pending') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                @elseif($registration->status === 'paid') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                @elseif($registration->status === 'waiting_payment') bg-orange-100 text-orange-800 dark:bg-orange-500/15 dark:text-orange-400
                                @elseif($registration->status === 'attended') bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500
                                @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                            </span>
                            <a href="{{ route('participant.registrations.index') }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>

                    <!-- Status Messages -->
                    <div class="mt-4">
                        @if($registration->isPending())
                            <div class="rounded-lg border border-warning-200 bg-warning-50 p-4 dark:border-warning-800 dark:bg-warning-900/20">
                                <p class="text-sm text-warning-800 dark:text-orange-400">⏳ Registrasi Anda sedang menunggu konfirmasi dari panitia.</p>
                            </div>
                        @elseif($registration->isWaitingPayment())
                            <div class="rounded-lg border border-orange-200 bg-orange-50 p-4 dark:border-orange-800 dark:bg-orange-900/20">
                                <p class="text-sm font-semibold text-orange-800 dark:text-orange-400">💳 Silakan lakukan pembayaran untuk melanjutkan registrasi.</p>
                            </div>
                        @elseif($registration->isPaid())
                            <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/20">
                                <p class="text-sm text-blue-800 dark:text-blue-400">✓ Pembayaran berhasil! Menunggu konfirmasi panitia.</p>
                            </div>
                        @elseif($registration->isConfirmed())
                            <div class="rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
                                <p class="text-sm font-semibold text-green-800 dark:text-green-400">🎉 Selamat! Registrasi Anda telah dikonfirmasi.</p>
                            </div>
                        @elseif($registration->hasAttended())
                            <div class="rounded-lg border border-purple-200 bg-purple-50 p-4 dark:border-purple-800 dark:bg-purple-900/20">
                                <p class="text-sm font-semibold text-purple-800 dark:text-purple-400">✨ Terima kasih telah menghadiri event ini!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Event Info -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Informasi Event
                    </h3>
                </div>
                <div class="p-5 sm:p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nama Event</p>
                        <p class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->event->name }}</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tipe Event</p>
                            <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium {{ $registration->event->type === 'competition' ? 'bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500' : 'bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500' }}">
                                {{ $registration->event->type === 'competition' ? 'Lomba' : 'Seminar' }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tanggal Event</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->event->start_date->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Lokasi</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->event->venue }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Biaya</p>
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $registration->event->is_free ? 'Gratis' : 'Rp ' . number_format($registration->event->registration_fee, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Info -->
            @if($registration->team_name)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Informasi Tim: {{ $registration->team_name }}
                    </h3>
                </div>
                <div class="p-5 sm:p-6">
                    @if($registration->members->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">#</th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nama</th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Email</th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Role</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($registration->members as $index => $member)
                                        <tr>
                                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white/90">{{ $index + 1 }}</td>
                                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white/90">{{ $member->name }}</td>
                                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $member->email }}</td>
                                            <td class="px-5 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium {{ $member->role === 'leader' ? 'bg-brand-500/10 text-brand-500' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400' }}">
                                                    {{ $member->role === 'leader' ? '👑 Leader' : 'Member' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Payment Info -->
            @if($registration->payment)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Informasi Pembayaran
                    </h3>
                </div>
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Reference</p>
                            <p class="font-mono font-semibold text-gray-800 dark:text-white/90">{{ $registration->payment->reference }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Jumlah</p>
                            <p class="font-bold text-gray-800 dark:text-white/90 text-xl">Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}</p>
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
                            <p class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->payment->paid_at->format('d M Y, H:i') }}</p>
                        </div>
                        @endif
                        @if($registration->payment->expired_at && !$registration->payment->isPaid())
                        <div class="sm:col-span-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Batas Pembayaran</p>
                            <p class="font-semibold text-orange-600 dark:text-orange-400">{{ $registration->payment->expired_at->format('d M Y, H:i') }}</p>
                            @if($registration->payment->expired_at > now())
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Sisa waktu: {{ now()->diffForHumans($registration->payment->expired_at, true) }}
                                </p>
                            @else
                                <p class="text-xs text-red-600 dark:text-red-500 mt-1">Pembayaran telah kadaluarsa</p>
                            @endif
                        </div>
                        @endif
                    </div>

                    @if($registration->isWaitingPayment() && !$registration->payment->isExpired())
                        <div class="mt-6">
                            <a href="{{ route('participant.registrations.payment', $registration) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-orange-500 px-6 py-3 text-sm font-medium text-white hover:bg-orange-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Lakukan Pembayaran
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Requirement Answers -->
            @if($registration->requirement_answers)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Jawaban Persyaratan
                    </h3>
                </div>
                <div class="p-5 sm:p-6 space-y-3">
                    @foreach($registration->requirement_answers as $reqId => $answer)
                        @php
                            $requirement = $registration->event->requirements->firstWhere('id', $reqId);
                        @endphp
                        @if($requirement)
                        <div class="p-4 bg-gray-50 dark:bg-white/[0.02] rounded-lg border border-gray-200 dark:border-gray-800">
                            <p class="font-semibold text-gray-800 dark:text-white/90 mb-2">{{ $requirement->name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                @if($requirement->type === 'file')
                                    <a href="{{ asset('uploads/requirements/' . $answer) }}" target="_blank" class="inline-flex items-center gap-1 text-brand-500 hover:text-brand-600">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        {{ $answer }}
                                    </a>
                                @elseif($requirement->type === 'link')
                                    <a href="{{ $answer }}" target="_blank" class="inline-flex items-center gap-1 text-brand-500 hover:text-brand-600">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                        {{ $answer }}
                                    </a>
                                @else
                                    {{ $answer }}
                                @endif
                            </p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Attendance History -->
            @if($registration->attendances->count() > 0)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Riwayat Kehadiran
                    </h3>
                </div>
                <div class="p-5 sm:p-6 space-y-3">
                    @foreach($registration->attendances as $attendance)
                    <div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white text-xl">✓</span>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800 dark:text-white/90">
                                {{ $attendance->eventSession ? $attendance->eventSession->name : 'Event Utama' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Check-in: {{ $attendance->check_in_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Notes -->
            @if($registration->notes)
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Catatan
                    </h3>
                </div>
                <div class="p-5 sm:p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $registration->notes }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>