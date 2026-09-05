<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('ចូលប្រើប្រព័ន្ធ') }} - SmartCare HMS</title>

    <!-- Google Fonts: Kantumruy Pro & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Vite Assets / CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js CDN for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="bg-slate-50 font-sans antialiased text-slate-800 min-h-screen flex items-center justify-center p-4 relative overflow-hidden selection:bg-teal-600 selection:text-white">

    <!-- Ambient Subtle Background Orbs -->
    <div
        class="absolute -top-40 -left-40 w-96 h-96 bg-teal-500/10 rounded-full blur-[120px] pointer-events-none animate-pulse-glow">
    </div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-sky-500/10 rounded-full blur-[120px] pointer-events-none animate-pulse-glow"
        style="animation-delay: 4s;"></div>
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-150 h-150 bg-emerald-500/5 rounded-full blur-[150px] pointer-events-none">
    </div>

    <div
        class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-xl shadow-slate-200/60 relative z-10">

        <!-- Language Switcher Pill -->
        <div class="flex items-center justify-end mb-6">
            <div class="inline-flex p-1 bg-slate-100 rounded-full border border-slate-200/80 gap-1">
                <a href="{{ route('lang.switch', 'km') }}"
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition-all {{ app()->getLocale() === 'km' ? 'bg-teal-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                    <span>🇰🇭</span> <span>ខ្មែរ</span>
                </a>
                <a href="{{ route('lang.switch', 'en') }}"
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition-all {{ app()->getLocale() === 'en' ? 'bg-teal-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                    <span>🇬🇧</span> <span>English</span>
                </a>
            </div>
        </div>

        <!-- Hospital Brand Header -->
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-linear-to-tr from-teal-600 via-teal-700 to-teal-800 text-white font-extrabold text-3xl mb-4 shadow-lg shadow-teal-700/25 animate-float">
                S
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SmartCare <span
                    class="text-teal-600">HMS</span></h1>
            <p class="text-xs text-slate-500 mt-1 font-medium">{{ __('ប្រព័ន្ធគ្រប់គ្រងមន្ទីរពេទ្យឆ្លាតវៃ') }}</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">
                    {{ __('អ៊ីមែលបុគ្គលិក') }}
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    placeholder="admin@gmail.com"
                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
            </div>

            <!-- Password with Show/Hide (Open/Close Eye Toggle) -->
            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">
                    {{ __('ពាក្យសម្ងាត់') }}
                </label>
                <div x-data="{ show: false }" class="relative">
                    <input :type="show ? 'text' : 'password'" name="password" id="password" required
                        placeholder="••••••••"
                        class="w-full pl-4 pr-11 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-teal-600 transition-colors focus:outline-hidden cursor-pointer"
                        :title="show ? 'Hide password' : 'Show password'">
                        <!-- Eye Open (when hidden) -->
                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye Closed / Slash (when shown) -->
                        <svg x-show="show" class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 013.122-.463c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-6.09-3.23a3 3 0 11-4.243-4.243" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="remember"
                        class="rounded border-slate-300 bg-white text-teal-600 shadow-2xs focus:ring-teal-500">
                    <span class="ms-2 text-xs font-medium text-slate-600">{{ __('ចងចាំគណនីខ្ញុំ') }}</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3.5 px-4 bg-linear-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-bold text-sm rounded-xl transition-all duration-200 shadow-lg shadow-teal-700/20 active:scale-95 cursor-pointer">
                    {{ __('ចូលប្រើប្រព័ន្ធ') }}
                </button>
            </div>
        </form>

        <!-- Register Option -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500">
                {{ __('មិនទាន់មានគណនីមែនទេ?') }}
                <a href="{{ route('register') }}"
                    class="font-bold text-teal-700 hover:text-teal-800 hover:underline ms-1">
                    {{ __('ចុះឈ្មោះគណនីថ្មី') }}
                </a>
            </p>
        </div>
    </div>

    <!-- SweetAlert2 CDN & Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');

            // 1. Validation Error SweetAlert Modal
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: @json(__('មិនអាចចូលប្រើប្រព័ន្ធបានទេ!')),
                    html: `@foreach ($errors->all() as $error)<p class="text-sm text-slate-600 mt-1">• {{ $error }}</p>@endforeach`,
                    confirmButtonColor: '#e11d48',
                    confirmButtonText: @json(__('យល់ព្រម')),
                    background: '#ffffff',
                    color: '#1e293b',
                    borderRadius: '1.25rem'
                });
            @endif

            // 2. Submit Loading SweetAlert
            if (form) {
                form.addEventListener('submit', function() {
                    Swal.fire({
                        title: @json(__('កំពុងផ្ទៀងផ្ទាត់ទិន្នន័យ...')),
                        text: @json(__('សូមរង់ចាំមួយភ្លែត!')),
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: '#ffffff',
                        color: '#1e293b',
                        borderRadius: '1.25rem',
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>
