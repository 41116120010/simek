<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <div class="space-y-6">

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Total Events Card - Butuh view_events permission -->
                @can('view_events')
                    <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-indigo-500 text-white">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                                {{ $stats['total_events'] }}
                            </h3>
                            <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                                Total Event
                            </p>
                        </div>
                    </article>
                @endcan

                <!-- Active Events Card - Butuh view_events permission -->
                @can('view_events')
                    <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-green-500 text-white">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                                {{ $stats['active_events'] }}
                            </h3>
                            <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                                Event Aktif
                            </p>
                        </div>
                    </article>
                @endcan

                <!-- Total Registrations Card - Butuh view_registrations permission -->
                @can('view_registrations')
                    <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-yellow-500 text-white">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                                {{ $stats['total_registrations'] }}
                            </h3>
                            <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                                Total Registrasi
                            </p>
                        </div>
                    </article>
                @endcan

                <!-- Total Revenue Card - Butuh view_payments permission -->
                @can('view_payments')
                    <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-purple-500 text-white">
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
                @endcan

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Event Terbaru Table - Butuh view_events permission -->
                @can('view_events')
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="flex flex-col gap-4 border-b border-gray-200 px-4 py-4 sm:px-5 lg:flex-row lg:items-center lg:justify-between dark:border-gray-800">
                            <div class="flex-shrink-0">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                    Event Terbaru
                                </h3>
                            </div>
                            <div>
                                <a href="{{ route('admin.events.index') }}" class="shadow-theme-xs flex h-11 w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 sm:w-auto sm:min-w-[100px] dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    Lihat Semua Event
                                </a>
                            </div>
                        </div>
                        <div class="w-full overflow-x-auto p-4 sm:p-5">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-gray-100 border-y dark:border-gray-800">
                                        <th class="py-3">
                                            <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Event</p>
                                        </th>
                                        <th class="py-3">
                                            <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Tanggal</p>
                                        </th>
                                        <th class="py-3">
                                            <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse($recentEvents as $event)
                                        <tr>
                                            <td class="py-3">
                                                <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $event->name }}</p>
                                                <span class="text-gray-500 text-theme-xs dark:text-gray-400">{{ $event->type === 'competition' ? 'Lomba' : 'Seminar' }}</span>
                                            </td>
                                            <td class="py-3">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $event->start_date->format('d M Y') }}</p>
                                            </td>
                                            <td class="py-3">
                                                <p class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium
                                                    @if($event->status === 'published') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                                    @elseif($event->status === 'draft') bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                                    @else bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                                    @endif">
                                                    {{ ucfirst($event->status) }}
                                                </p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 text-center">
                                                <p class="text-gray-500 dark:text-gray-400">Belum ada event</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan

                <!-- Registrasi Terbaru Table - Butuh view_registrations permission -->
                @can('view_registrations')
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="flex flex-col gap-4 border-b border-gray-200 px-4 py-4 sm:px-5 lg:flex-row lg:items-center lg:justify-between dark:border-gray-800">
                            <div class="flex-shrink-0">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                    Registrasi Terbaru
                                </h3>
                            </div>
                            <div>
                                <a href="{{ route('admin.registrations.index') }}" class="shadow-theme-xs flex h-11 w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 sm:w-auto sm:min-w-[100px] dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    Lihat Semua Registrasi
                                </a>
                            </div>
                        </div>
                        <div class="w-full overflow-x-auto p-4 sm:p-5">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-gray-100 border-y dark:border-gray-800">
                                        <th class="py-3">
                                            <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Nama</p>
                                        </th>
                                        <th class="py-3">
                                            <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Event</p>
                                        </th>
                                        <th class="py-3">
                                            <p class="font-medium text-left text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse($recentRegistrations as $registration)
                                        <tr>
                                            <td class="py-3">
                                                <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $registration->user->name }}</p>
                                            </td>
                                            <td class="py-3">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ Str::limit($registration->event->name, 30) }}</p>
                                            </td>
                                            <td class="py-3">
                                                <p class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium
                                                    @if($registration->status === 'confirmed') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                                    @elseif($registration->status === 'pending') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                                    @elseif($registration->status === 'paid') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                                    @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                                    @endif">
                                                    {{ ucfirst($registration->status) }}
                                                </p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 text-center">
                                                <p class="text-gray-500 dark:text-gray-400">Belum ada registrasi</p>
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
    </div>
</x-app-layout>