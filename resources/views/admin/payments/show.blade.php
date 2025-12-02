<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Detail Pembayaran</h2>
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
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('admin.payments.index') }}">
                            Pembayaran
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">{{ $payment->reference }}</li>
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

        <!-- Payment Header Card -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] mb-6">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ $payment->reference }}</h3>
                            <span class="inline-flex items-center justify-center gap-1 rounded-full px-3 py-1 text-xs font-medium
                                @if($payment->status === 'paid') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                @elseif($payment->status === 'unpaid') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                @elseif($payment->status === 'expired') bg-red-100 text-red-800 dark:bg-red-500/15 dark:text-red-500
                                @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                @endif">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <span class="inline-flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Dibuat: {{ $payment->created_at->format('d M Y, H:i') }} WIB
                            </span>
                        </p>
                    </div>
                    
                    <!-- Back Button -->
                    <a href="{{ route('admin.payments.index') }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>

                <!-- Status Messages -->
<div class="mt-4">
    @if($payment->status === 'paid')
        {{-- PAID STATUS --}}
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-500 text-white text-xl">
                    ✓
                </span>
                <div class="flex-1">
                    <p class="font-semibold text-sm text-green-800 dark:text-green-400">Pembayaran Terverifikasi</p>
                    <p class="text-xs text-green-700 dark:text-green-500 mt-1">Dibayar pada: {{ $payment->paid_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>
    
    @elseif($payment->status === 'expired' || $payment->status === 'failed')
        {{-- EXPIRED/FAILED STATUS --}}
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-500 text-white text-xl">
                    ⚠️
                </span>
                <div class="flex-1">
                    <p class="font-semibold text-sm text-red-800 dark:text-red-400">
                        {{ $payment->status === 'expired' ? 'Pembayaran Kadaluarsa' : 'Pembayaran Gagal' }}
                    </p>
                    <p class="text-xs text-red-700 dark:text-red-500 mt-1">
                        @if($payment->expired_at)
                            Batas waktu berakhir pada: {{ $payment->expired_at->format('d M Y, H:i') }} WIB
                        @else
                            Pembayaran tidak dapat diproses
                        @endif
                    </p>
                </div>
            </div>
        </div>
    
    @elseif($payment->status === 'unpaid')
        {{-- Check if actually expired --}}
        @if($payment->expired_at && $payment->expired_at->isPast())
            {{-- Should be expired but status not updated --}}
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
                <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-500 text-white text-xl">
                        ⚠️
                    </span>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-red-800 dark:text-red-400">Pembayaran Kadaluarsa</p>
                        <p class="text-xs text-red-700 dark:text-red-500 mt-1">
                            Batas waktu berakhir pada: {{ $payment->expired_at->format('d M Y, H:i') }} WIB
                        </p>
                    </div>
                </div>
            </div>
        @else
            {{-- Still valid unpaid --}}
            <div class="rounded-xl border border-orange-200 bg-orange-50 p-4 dark:border-orange-800 dark:bg-orange-900/20">
                <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-500 text-white text-xl">
                        ⏳
                    </span>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-orange-800 dark:text-orange-400">Menunggu Pembayaran</p>
                        @if($payment->expired_at)
                        <p class="text-xs text-orange-700 dark:text-orange-500 mt-1">
                            Batas waktu: {{ $payment->expired_at->format('d M Y, H:i') }} WIB
                            <span class="font-semibold">({{ $payment->expired_at->diffForHumans() }})</span>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    
    @else
        {{-- FALLBACK for other statuses --}}
        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-500 text-white text-xl">
                    ℹ️
                </span>
                <div class="flex-1">
                    <p class="font-semibold text-sm text-gray-800 dark:text-gray-400">Status: {{ ucfirst($payment->status) }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Left Column (2/3) -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Payment Details -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Detail Pembayaran
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <!-- Total Amount Highlight -->
                        <div class="mb-6 text-center p-4 bg-gradient-to-br from-brand-50 to-brand-100 rounded-xl dark:from-brand-900/20 dark:to-brand-800/20">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Total Pembayaran</p>
                            <p class="text-3xl font-bold text-brand-600 dark:text-brand-400">
                                Rp {{ number_format($payment->total_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Reference Number</p>
                                <p class="font-mono font-semibold text-sm text-gray-800 dark:text-white/90">{{ $payment->reference }}</p>
                            </div>

                            @if($payment->merchant_ref)
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Merchant Reference</p>
                                <p class="font-mono font-semibold text-sm text-gray-800 dark:text-white/90">{{ $payment->merchant_ref }}</p>
                            </div>
                            @endif

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Payment Method</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->payment_method ?? 'Manual Transfer' }}
                                </p>
                            </div>

                            @if($payment->payment_channel)
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Payment Channel</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $payment->payment_channel }}</p>
                            </div>
                            @endif

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Biaya Pendaftaran</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Biaya Admin</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">Rp {{ number_format($payment->fee, 0, ',', '.') }}</p>
                            </div>

                            @if($payment->paid_at)
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tanggal Bayar</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $payment->paid_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                            @endif

                            @if($payment->expired_at)
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Batas Waktu</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">{{ $payment->expired_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                            @endif
                        </div>

                        @if($payment->payment_data)
                        <div class="mt-6 rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-2">PAYMENT DATA (JSON)</p>
                            <div class="rounded-lg bg-gray-50 p-3 dark:bg-gray-800">
                                <pre class="text-xs text-gray-600 dark:text-gray-400 overflow-x-auto whitespace-pre-wrap">{{ json_encode($payment->payment_data, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Registration Info -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Informasi Registrasi
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kode Registrasi</p>
                                <p class="font-mono font-semibold text-sm text-gray-800 dark:text-white/90 mb-2">
                                    {{ $payment->registration->registration_code }}
                                </p>
                                <a href="{{ route('admin.registrations.show', $payment->registration) }}" class="inline-flex items-center gap-1 text-xs text-brand-500 hover:text-brand-600">
                                    Lihat Detail Registrasi
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Status Registrasi</p>
                                <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
                                    @if($payment->registration->status === 'confirmed') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                    @elseif($payment->registration->status === 'pending') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                    @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                    @endif">
                                    {{ ucfirst($payment->registration->status) }}
                                </span>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Event</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->registration->event->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tanggal Event</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->registration->event->start_date->format('d M Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Participant Info -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Informasi Peserta
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nama Lengkap</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->registration->user->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Email</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->registration->user->email }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">No. Telepon</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->registration->user->phone ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Institusi</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->registration->user->institution ?? '-' }}
                                </p>
                            </div>

                            @if($payment->registration->team_name)
                            <div class="md:col-span-2">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nama Tim</p>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white/90">
                                    {{ $payment->registration->team_name }}
                                </p>
                            </div>
                            @endif
                        </div>

                        <!-- Team Members -->
                        @if($payment->registration->members->count() > 0)
                        <div class="mt-6">
                            <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-3">ANGGOTA TIM</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <th class="py-3 pr-5 text-left text-xs font-medium text-gray-500 dark:text-gray-400">#</th>
                                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama</th>
                                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Email</th>
                                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @foreach($payment->registration->members as $index => $member)
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
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column (1/3) -->
            <div class="space-y-6">
                <!-- Actions - Butuh verify_payments permission -->
                @can('verify_payments')
                    @if($payment->status === 'unpaid')
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                Tindakan
                            </h3>
                        </div>
                        <div class="p-5 sm:p-6 space-y-3">
                            <form action="{{ route('admin.payments.verify', $payment) }}" method="POST" onsubmit="return confirm('Verifikasi pembayaran ini? Pastikan dana sudah masuk ke rekening.')">
                                @csrf
                                <button type="submit" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-lg bg-success-500 px-4 py-3 text-sm font-medium text-white hover:bg-success-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Verifikasi Pembayaran
                                </button>
                            </form>

                            <form action="{{ route('admin.payments.reject', $payment) }}" method="POST" onsubmit="return confirm('Tolak pembayaran ini? Registrasi akan dibatalkan.')">
                                @csrf
                                <button type="submit" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 hover:bg-red-100 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tolak Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                @endcan

                <!-- Quick Info -->
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Quick Info
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6 space-y-4 text-sm">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-500/10">
                                <svg class="h-5 w-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Status Pembayaran</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ ucfirst($payment->status) }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500/10">
                                <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat Pada</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ $payment->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $payment->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        @if($payment->paid_at)
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-500/10">
                                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal Bayar</p>
                                <p class="font-semibold text-gray-800 dark:text-white/90">{{ $payment->paid_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $payment->paid_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>