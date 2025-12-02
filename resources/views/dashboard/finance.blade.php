<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <div class="space-y-6">

            <!-- Welcome Section -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90 mb-2">
                                Selamat Datang, {{ auth()->user()->name }}!
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400">
                                Anda login sebagai : <span class="font-semibold text-brand-600 dark:text-brand-400">Finance Officer</span>
                            </p>
                        </div>
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-green-500 text-white">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Total Revenue -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-green-500 text-white">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                        </h3>
                        <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                            Total Pendapatan
                        </p>
                    </div>
                </article>

                <!-- Pending Payments -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-yellow-500 text-white">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            {{ $stats['pending_payments'] }}
                        </h3>
                        <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                            Pembayaran Pending
                        </p>
                    </div>
                </article>

                <!-- Paid Registrations -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-blue-500 text-white">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            {{ $stats['paid_registrations'] }}
                        </h3>
                        <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                            Sudah Bayar
                        </p>
                    </div>
                </article>

            </div>

            <!-- Quick Actions - Permission Aware -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        <!-- Kelola Pembayaran - Butuh view_payments -->
                        @can('view_payments')
                            <a href="{{ route('admin.payments.index') }}" class="block p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/30 transition">
                                <div class="flex items-center gap-3">
                                    <span class="text-3xl">💳</span>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white/90">Kelola Pembayaran</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Verifikasi & Monitor</p>
                                    </div>
                                </div>
                            </a>
                        @endcan

                        <!-- Pembayaran Pending - Butuh view_payments -->
                        @can('view_payments')
                            <a href="{{ route('admin.payments.index', ['status' => 'unpaid']) }}" class="block p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg hover:bg-yellow-100 dark:hover:bg-yellow-900/30 transition">
                                <div class="flex items-center gap-3">
                                    <span class="text-3xl">⏳</span>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white/90">Pembayaran Pending</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $stats['pending_payments'] }} transaksi</p>
                                    </div>
                                </div>
                            </a>
                        @endcan

                        <!-- Export Payment - Butuh export_payments -->
                        @can('export_payments')
                            <a href="{{ route('admin.payments.export.excel') }}" class="block p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition">
                                <div class="flex items-center gap-3">
                                    <span class="text-3xl">📊</span>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white/90">Export Payment</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Ekspor Pembayaran ke Excel</p>
                                    </div>
                                </div>
                            </a>
                        @endcan
                        
                    </div>
                </div>
            </div>

            <!-- Recent Payments - Butuh view_payments -->
            @can('view_payments')
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="flex flex-col gap-4 border-b border-gray-200 px-4 py-4 sm:px-5 lg:flex-row lg:items-center lg:justify-between dark:border-gray-800">
                        <div class="flex-shrink-0">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                Pembayaran Terbaru
                            </h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.payments.index') }}" class="shadow-theme-xs flex h-11 w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 sm:w-auto sm:min-w-[100px] dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                Lihat Semua Pembayaran
                            </a>
                        </div>
                    </div>
                    <div class="w-full overflow-x-auto p-4 sm:p-5">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-gray-100 border-y dark:border-gray-800">
                                    <th class="py-3">
                                        <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Peserta</p>
                                    </th>
                                    <th class="py-3">
                                        <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Event</p>
                                    </th>
                                    <th class="py-3">
                                        <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Jumlah</p>
                                    </th>
                                    <th class="py-3">
                                        <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                                    </th>
                                    <th class="py-3">
                                        <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Tanggal</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($recentPayments as $payment)
                                    <tr>
                                        <td class="py-3">
                                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ $payment->registration->user->name }}
                                            </p>
                                            <span class="text-gray-500 text-theme-xs dark:text-gray-400">
                                                {{ $payment->registration->user->email }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <p class="text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ Str::limit($payment->registration->event->name, 40) }}
                                            </p>
                                        </td>
                                        <td class="py-3">
                                            <p class="font-semibold text-gray-800 text-theme-sm dark:text-white/90">
                                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="py-3">
                                            <p class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium
                                                @if($payment->status === 'paid') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                                @elseif($payment->status === 'unpaid') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                                @else bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500
                                                @endif">
                                                {{ ucfirst($payment->status) }}
                                            </p>
                                        </td>
                                        <td class="py-3">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                {{ $payment->created_at->format('d M Y') }}
                                            </p>
                                            <span class="text-gray-400 text-theme-xs dark:text-gray-500">
                                                {{ $payment->created_at->format('H:i') }} WIB
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center">
                                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium mb-2">
                                                Belum Ada Pembayaran
                                            </p>
                                            <p class="text-gray-400 dark:text-gray-500 text-sm">
                                                Pembayaran akan muncul di sini setelah peserta melakukan transaksi.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan

        </div>
    </div>
</x-app-layout>