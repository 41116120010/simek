<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Kelola Registrasi</h2>
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
                    <li class="text-sm text-gray-800 dark:text-white/90">Kelola Registrasi</li>
                </ol>
            </nav>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </span>
                    <p class="text-sm font-medium text-green-800 dark:text-green-400">{{ session('success') }}</p>
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
                </div>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
            <!-- Total -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-500/10">
                        <svg class="h-6 w-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total Registrasi</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ $registrations->total() }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-warning-500/10">
                        <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Pending</p>
                        <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ \App\Models\Registration::where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Confirmed -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-success-500/10">
                        <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Confirmed</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ \App\Models\Registration::where('status', 'confirmed')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Attended -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-500/10">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Attended</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ \App\Models\Registration::where('status', 'attended')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Header with Actions -->
            <div class="flex flex-col gap-4 border-b border-gray-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:py-5 dark:border-gray-800">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Daftar Registrasi
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Kelola semua registrasi peserta
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <!-- Export Buttons - Butuh export_registrations permission -->
                    @can('export_registrations')
                        <a href="{{ route('admin.registrations.export.excel', request()->query()) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Excel
                        </a>
                        <a href="{{ route('admin.registrations.export.pdf', request()->query()) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Export PDF
                        </a>
                    @endcan
                </div>
            </div>

            <!-- Filters -->
            <div class="border-b border-gray-200 px-5 py-4 sm:px-6 dark:border-gray-800">
                <form method="GET" action="{{ route('admin.registrations.index') }}">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                        <!-- Search -->
                        <div class="lg:col-span-2">
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Cari Peserta
                            </label>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari nama/email/kode..."
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            />
                        </div>

                        <!-- Event Filter -->
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Event
                            </label>
                            <div x-data="{ isOptionSelected: {{ request('event') ? 'true' : 'false' }} }" class="relative">
                                <select 
                                    name="event"
                                    class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true"
                                >
                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Semua Event</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ request('event') == $event->id ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            {{ $event->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">
                                Status
                            </label>
                            <div x-data="{ isOptionSelected: {{ request('status') ? 'true' : 'false' }} }" class="relative">
                                <select 
                                    name="status"
                                    class="w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true"
                                >
                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Pending</option>
                                    <option value="waiting_payment" {{ request('status') == 'waiting_payment' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Waiting Payment</option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Paid</option>
                                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Confirmed</option>
                                    <option value="attended" {{ request('status') == 'attended' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Attended</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }} class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Cancelled</option>
                                </select>
                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-end gap-2">
                            <button type="submit" class="shadow-theme-xs flex h-11 flex-1 items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 text-sm font-medium text-white hover:bg-brand-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.registrations.index') }}" class="shadow-theme-xs flex h-11 flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto px-5 py-4 sm:px-6">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="py-3 pr-5 text-left text-xs font-medium text-gray-500 dark:text-gray-400">
                                Kode
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">
                                Peserta
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">
                                Event
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tim
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">
                                Status
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">
                                Tanggal
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($registrations as $registration)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                                <td class="py-3 pr-5">
                                    <p class="font-mono text-sm font-semibold text-gray-800 dark:text-white/90">
                                        {{ $registration->registration_code }}
                                    </p>
                                </td>
                                <td class="px-5 py-3">
                                    <p class="font-medium text-sm text-gray-800 dark:text-white/90">
                                        {{ $registration->user->name }}
                                    </p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $registration->user->email }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <p class="text-sm text-gray-800 dark:text-white/90 mb-1">
                                        {{ Str::limit($registration->event->name, 40) }}
                                    </p>
                                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
                                        {{ $registration->event->type === 'competition' ? 'bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500' : 'bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500' }}">
                                        {{ $registration->event->type === 'competition' ? 'Lomba' : 'Seminar' }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <p class="text-sm text-gray-800 dark:text-white/90">
                                        {{ $registration->team_name ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium
                                        @if($registration->status === 'confirmed') bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500
                                        @elseif($registration->status === 'pending') bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400
                                        @elseif($registration->status === 'paid') bg-blue-100 text-blue-800 dark:bg-blue-500/15 dark:text-blue-500
                                        @elseif($registration->status === 'waiting_payment') bg-orange-100 text-orange-800 dark:bg-orange-500/15 dark:text-orange-500
                                        @elseif($registration->status === 'attended') bg-purple-100 text-purple-800 dark:bg-purple-500/15 dark:text-purple-500
                                        @else bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <p class="text-sm text-gray-800 dark:text-white/90">
                                        {{ $registration->created_at->format('d M Y') }}
                                    </p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $registration->created_at->format('H:i') }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <!-- View -->
                                        <a href="{{ route('admin.registrations.show', $registration) }}" class="group relative inline-block">
                                            <button class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                            <div class="invisible absolute bottom-full left-1/2 z-9999 mb-2.5 -translate-x-1/2 opacity-0 transition-opacity duration-300 group-hover:visible group-hover:opacity-100">
                                                <div class="relative">
                                                    <div class="rounded-lg bg-white px-3 py-2 text-xs font-medium whitespace-nowrap text-gray-700 shadow-xs dark:bg-[#1E2634] dark:text-white">
                                                        Detail
                                                    </div>
                                                    <div class="absolute -bottom-1 left-1/2 h-3 w-4 -translate-x-1/2 rotate-45 bg-white dark:bg-[#1E2634]"></div>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Approve - Butuh approve_registrations permission -->
                                        @can('approve_registrations')
                                            @if($registration->status === 'paid' || $registration->status === 'pending')
                                            <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST" class="inline" onsubmit="return confirm('Konfirmasi registrasi {{ $registration->user->name }}?')">
                                                @csrf
                                                <div class="group relative inline-block">
                                                    <button type="submit" class="text-gray-500 hover:text-green-500 dark:text-gray-400 dark:hover:text-green-500">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="invisible absolute bottom-full left-1/2 z-9999 mb-2.5 -translate-x-1/2 opacity-0 transition-opacity duration-300 group-hover:visible group-hover:opacity-100">
                                                        <div class="relative">
                                                            <div class="rounded-lg bg-white px-3 py-2 text-xs font-medium whitespace-nowrap text-gray-700 shadow-xs dark:bg-[#1E2634] dark:text-white">
                                                                Approve
                                                            </div>
                                                            <div class="absolute -bottom-1 left-1/2 h-3 w-4 -translate-x-1/2 rotate-45 bg-white dark:bg-[#1E2634]"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            @endif
                                        @endcan

                                        <!-- Reject - Butuh reject_registrations permission -->
                                        @can('reject_registrations')
                                            @if(!in_array($registration->status, ['confirmed', 'attended', 'cancelled']))
                                            <form action="{{ route('admin.registrations.reject', $registration) }}" method="POST" class="inline" onsubmit="return confirm('Tolak registrasi {{ $registration->user->name }}?')">
                                                @csrf
                                                <div class="group relative inline-block">
                                                    <button type="submit" class="text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="invisible absolute bottom-full left-1/2 z-9999 mb-2.5 -translate-x-1/2 opacity-0 transition-opacity duration-300 group-hover:visible group-hover:opacity-100">
                                                        <div class="relative">
                                                            <div class="rounded-lg bg-white px-3 py-2 text-xs font-medium whitespace-nowrap text-gray-700 shadow-xs dark:bg-[#1E2634] dark:text-white">
                                                                Reject
                                                            </div>
                                                            <div class="absolute -bottom-1 left-1/2 h-3 w-4 -translate-x-1/2 rotate-45 bg-white dark:bg-[#1E2634]"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">
                                        Belum Ada Registrasi
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($registrations->hasPages())
                <div class="border-t border-gray-200 px-5 py-4 sm:px-6 dark:border-gray-800">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>