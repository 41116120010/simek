<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/simekv2-ico.png') }}">

        <meta name="description" content="SI-MEK - Sistem Manajemen Event Kampus adalah platform untuk mengelola pendaftaran dan pembayaran event kampus secara efisien.">
        <meta name="author" content="Daffiq Trie Octorino">
        <meta name="robots" content="index, follow">
        <meta property="og:title" content="SI-MEK - Sistem Manajemen Event Kampus">
        <meta property="og:description" content="SI-MEK - Sistem Manajemen Event Kampus adalah platform untuk mengelola pendaftaran dan pembayaran event kampus secara efisien.">
        <meta property="og:image" content="{{ asset('assets/img/simekv2-ico.png') }}">
        <meta property="og:url" content="https://simek.tka24.my.id">
        <meta property="og:type" content="website">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Assets -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="{ 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode')); $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark bg-gray-900': darkMode === true}">
        <!-- ===== Preloader ===== -->
        <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})" class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
            <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"></div>
        </div>
        <!-- ===== Preloader End ===== -->

        <!-- ===== Page Wrapper Start ===== -->
        <div class="relative z-1 flex min-h-screen flex-col items-center justify-center overflow-hidden p-6">

        <!-- Centered Content -->
            <div class="mx-auto w-full max-w-[242px] text-center sm:max-w-[472px]">
                <h1 class="mb-8 text-title-md font-bold text-gray-800 dark:text-white/90 xl:text-title-2xl">
                    ERROR
                </h1>

                <img src="{{ asset('assets/img/404.svg') }}" alt="404" class="dark:hidden" />
                <img src="{{ asset('assets/img/404-dark.svg') }}" alt="404" class="hidden dark:block" />

                <p class="mb-6 mt-10 text-base text-gray-700 dark:text-gray-400 sm:text-lg">
                Halaman tidak ditemukan!
                </p>

                <a href="{{ url('/') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                Kembali ke Halaman Utama
                </a>
            </div>
      <!-- Footer -->
            <p class="absolute bottom-6 left-1/2 -translate-x-1/2 text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; <span id="year">2025</span> | SI-MEK
            </p>
        </div>
        <!-- ===== Page Wrapper End ===== -->
  </body>
</html>