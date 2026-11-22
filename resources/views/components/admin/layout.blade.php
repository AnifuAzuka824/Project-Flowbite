@props([
    'title' => 'Dashboard',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Terapkan tema tersimpan sebelum halaman dirender agar tidak ada flash.
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="h-auto min-h-screen p-4 pt-20 md:ml-64">
        @if (session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900 dark:text-green-300"
                role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-red-900 dark:text-red-300"
                role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    <script>
        // Toggle sidebar pada layar kecil.
        const sidebar = document.getElementById('sidebar');
        const sidebarBackdrop = document.getElementById('sidebar-backdrop');

        document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarBackdrop.classList.toggle('hidden');
        });

        sidebarBackdrop?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
        });

        // Toggle tema gelap/terang.
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.querySelector('.theme-toggle-dark-icon');
        const lightIcon = document.querySelector('.theme-toggle-light-icon');

        if (document.documentElement.classList.contains('dark')) {
            lightIcon?.classList.remove('hidden');
        } else {
            darkIcon?.classList.remove('hidden');
        }

        themeToggleBtn?.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('color-theme', isDark ? 'dark' : 'light');
            darkIcon?.classList.toggle('hidden', isDark);
            lightIcon?.classList.toggle('hidden', !isDark);
        });
    </script>
</body>

</html>
