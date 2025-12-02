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
        
        <!-- ===== Page Wrapper ===== -->
        <div class="flex h-screen overflow-hidden">
            <!-- ===== Sidebar ===== -->
            @include('layouts.sidebar')

            <!-- ===== Content Area ===== -->
            <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
                <!-- Small Device Overlay -->
                <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fixed inset-0 z-[9998] bg-gray-900/50"></div>
                
                <!-- ===== Header ===== -->
                @isset($header)
                    @include('layouts.header')
                @endisset
                
                <!-- ===== Main Content ===== -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>