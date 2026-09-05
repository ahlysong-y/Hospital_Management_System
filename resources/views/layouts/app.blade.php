<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SmartCare HMS') }}</title>

    <!-- Theme Initialization Script (Prevents flash of wrong theme) -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('color-theme', isDark ? 'dark' : 'light');
            return isDark;
        }
    </script>

    <!-- Google Fonts: Kantumruy Pro (Khmer) & Plus Jakarta Sans (Latin/Numbers) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js CDN for Dynamic Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Vite Assets / CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js CDN fallback for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen selection:bg-teal-600 selection:text-white transition-colors duration-200 relative overflow-x-hidden"
      x-data="{ sidebarOpen: false, sidebarCollapsed: false, darkMode: localStorage.getItem('color-theme') === 'dark' }">
    
    <!-- Ambient Glass Orbs in Background -->
    <div class="fixed top-0 left-1/4 w-96 h-96 bg-teal-500/10 dark:bg-teal-500/15 rounded-full blur-3xl pointer-events-none animate-pulse-glow"></div>
    <div class="fixed bottom-10 right-10 w-96 h-96 bg-sky-500/10 dark:bg-sky-500/15 rounded-full blur-3xl pointer-events-none animate-pulse-glow" style="animation-delay: 3s;"></div>

    <div class="min-h-screen flex bg-slate-50/80 dark:bg-slate-950/80 relative z-10">

        <!-- Left Sidebar Navigation Component -->
        @include('layouts.sidebar')

        <!-- Main Layout Area (Top Header + Page Content) -->
        <div
            :class="{
                'lg:ml-64': !sidebarCollapsed,
                'lg:ml-20': sidebarCollapsed
            }"
            class="flex-1 flex flex-col min-w-0 transition-all duration-300 ease-in-out"
        >
            <!-- Top Header Bar Component -->
            @include('layouts.header')

            <!-- Page Heading (if provided) -->
            @if (isset($header))
            <header class="bg-white dark:bg-slate-900 border-b border-slate-200/80 dark:border-slate-800 shadow-2xs transition-colors">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Main Content Area -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- SweetAlert2 CDN & Global Handler -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Global Interceptor for Forms
            document.querySelectorAll('form').forEach(function (form) {
                // Ignore logout form or inline quick status update selects if unwanted
                if (form.getAttribute('action') && form.getAttribute('action').includes('logout')) {
                    return;
                }

                const methodInput = form.querySelector('input[name="_method"]');
                const methodValue = methodInput ? methodInput.value.toUpperCase() : 'POST';

                form.addEventListener('submit', function (e) {
                    if (form.dataset.confirmed) {
                        return; // already confirmed
                    }

                    // 1. DELETE Confirmation
                    if (methodValue === 'DELETE') {
                        e.preventDefault();
                        Swal.fire({
                            title: 'តើអ្នកពិតជាចង់លុបទិន្នន័យនេះមែនទេ?',
                            text: 'ទិន្នន័យដែលបានលុបមិនអាចទាញយកមកវិញបានទេ!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#e11d48', // Rose-600
                            cancelButtonColor: '#64748b', // Slate-500
                            confirmButtonText: 'បាទ/ចាស, លុបទិន្នន័យ!',
                            cancelButtonText: 'បោះបង់',
                            background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                            color: document.documentElement.classList.contains('dark') ? '#f8fafc' : '#1e293b',
                            borderRadius: '1rem'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.dataset.confirmed = 'true';
                                form.submit();
                            }
                        });
                    }

                    // 2. CREATE Confirmation (Form POST without _method, excluding quick patch status forms)
                    else if (!methodInput && form.getAttribute('method') && form.getAttribute('method').toUpperCase() === 'POST') {
                        // Check if form contains input elements (not a bare single-select form)
                        if (form.querySelectorAll('input:not([type="hidden"]), textarea, select').length > 1) {
                            e.preventDefault();
                            Swal.fire({
                                title: 'តើអ្នកពិតជាចង់រក្សាទុកទិន្នន័យថ្មីនេះមែនទេ?',
                                text: 'សូមពិនិត្យព័ត៌មានឱ្យបានត្រឹមត្រូវមុននឹងរក្សាទុកចូលប្រព័ន្ធ!',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#0f766e', // Teal-700
                                cancelButtonColor: '#64748b',
                                confirmButtonText: 'បាទ/ចាស, រក្សាទុក!',
                                cancelButtonText: 'ពិនិត្យឡើងវិញ',
                                background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                                color: document.documentElement.classList.contains('dark') ? '#f8fafc' : '#1e293b',
                                borderRadius: '1rem'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.dataset.confirmed = 'true';
                                    form.submit();
                                }
                            });
                        }
                    }

                    // 3. EDIT / UPDATE Confirmation (PUT/PATCH forms with multiple fields)
                    else if (methodValue === 'PUT' || (methodValue === 'PATCH' && form.querySelectorAll('input:not([type="hidden"]), textarea, select').length > 1)) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'តើអ្នកពិតជាចង់រក្សាទុកការកែប្រែនេះមែនទេ?',
                            text: 'ព័ត៌មានចាស់នឹងត្រូវធ្វើបច្ចុប្បន្នភាព!',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#0f766e',
                            cancelButtonColor: '#64748b',
                            confirmButtonText: 'បាទ/ចាស, កែប្រែ!',
                            cancelButtonText: 'បោះបង់',
                            background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                            color: document.documentElement.classList.contains('dark') ? '#f8fafc' : '#1e293b',
                            borderRadius: '1rem'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.dataset.confirmed = 'true';
                                form.submit();
                            }
                        });
                    }
                });
            });

            // Flash Success Message SweetAlert Toast
            @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true
            });
            @endif
        });
    </script>

</body>
</html>
