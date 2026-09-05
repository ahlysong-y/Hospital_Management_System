<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('ចុះឈ្មោះគណនីបុគ្គលិក') }} - SmartCare HMS</title>

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
    class="bg-slate-50 font-sans antialiased text-slate-800 min-h-screen flex items-center justify-center p-4 py-10 relative overflow-hidden selection:bg-teal-600 selection:text-white">

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
        class="w-full max-w-xl bg-white/95 backdrop-blur-xl rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-xl shadow-slate-200/60 relative z-10">

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
            <p class="text-xs text-slate-500 mt-1 font-medium">{{ __('ចុះឈ្មោះគណនីបុគ្គលិកមន្ទីរពេទ្យថ្មី') }}</p>
        </div>

        <!-- Validation Errors Display -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs space-y-1">
                <div class="font-bold mb-1">{{ __('សូមពិនិត្យកំហុសខាងក្រោម ៖') }}</div>
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form id="register-form" method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">
                    {{ __('ឈ្មោះពេញបុគ្គលិក') }} <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    placeholder="{{ __('ឧ. វេជ្ជបណ្ឌិត សុខ ចាន់ថា') }}"
                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
            </div>

            <!-- Email Address & Phone Number -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        {{ __('អ៊ីមែល') }} <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        placeholder="doctor@gmail.com"
                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
                </div>

                <div>
                    <label for="phone_number" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        {{ __('លេខទូរស័ព្ទ') }}
                    </label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                        placeholder="012 333 444"
                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
                </div>
            </div>

            <!-- Branch & Role Selection -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="branch_id" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        {{ __('សាខាមន្ទីរពេទ្យ') }} <span class="text-rose-500">*</span>
                    </label>
                    <select name="branch_id" id="branch_id" required
                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}"
                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="role" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        {{ __('តួនាទីបុគ្គលិក') }} <span class="text-rose-500">*</span>
                    </label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
                        <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>
                            {{ __('គ្រូពេទ្យ / វេជ្ជបណ្ឌិត') }}</option>
                        <option value="nurse" {{ old('role') == 'nurse' ? 'selected' : '' }}>
                            {{ __('គិលានុបដ្ឋាយិកា') }}</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>
                            {{ __('បុគ្គលិកទូទៅ / បេឡា') }}</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                            {{ __('អ្នកគ្រប់គ្រង') }}</option>
                    </select>
                </div>
            </div>

            <!-- Password & Confirmation with Show/Hide Open/Close Eye Toggle -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        {{ __('ពាក្យសម្ងាត់') }} <span class="text-rose-500">*</span>
                    </label>
                    <div x-data="{ show: false }" class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" id="password" required
                            placeholder="••••••••"
                            class="w-full pl-4 pr-11 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-teal-600 transition-colors focus:outline-hidden cursor-pointer"
                            :title="show ? 'Hide password' : 'Show password'">
                            <!-- Eye Open (when hidden) -->
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        {{ __('បញ្ជាក់ពាក្យសម្ងាត់') }} <span class="text-rose-500">*</span>
                    </label>
                    <div x-data="{ show: false }" class="relative">
                        <input :type="show ? 'text' : 'password'" name="password_confirmation"
                            id="password_confirmation" required placeholder="••••••••"
                            class="w-full pl-4 pr-11 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all duration-150">
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-teal-600 transition-colors focus:outline-hidden cursor-pointer"
                            :title="show ? 'Hide password' : 'Show password'">
                            <!-- Eye Open (when hidden) -->
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3.5 px-4 bg-linear-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-bold text-sm rounded-xl transition-all duration-200 shadow-lg shadow-teal-700/20 active:scale-95 cursor-pointer">
                    {{ __('ចុះឈ្មោះគណនី និង ចូលប្រើប្រព័ន្ធ') }}
                </button>
            </div>
        </form>

        <!-- Login Link Footer -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500">
                {{ __('មានគណនីរួចហើយមែនទេ?') }}
                <a href="{{ route('login') }}"
                    class="font-bold text-teal-700 hover:text-teal-800 hover:underline ms-1">
                    {{ __('ចូលប្រើប្រព័ន្ធ') }}
                </a>
            </p>
        </div>
    </div>

    <!-- SweetAlert2 CDN & Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');

            // 1. Validation Error SweetAlert Modal
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: @json(__('មិនអាចចុះឈ្មោះបានទេ!')),
                    html: `@foreach ($errors->all() as $error)<p class="text-sm text-slate-600 mt-1">• {{ $error }}</p>@endforeach`,
                    confirmButtonColor: '#e11d48',
                    confirmButtonText: @json(__('យល់ព្រម')),
                    background: '#ffffff',
                    color: '#1e293b',
                    borderRadius: '1.25rem'
                });
            @endif

            // 2. Submit Confirmation SweetAlert Modal
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!form.dataset.confirmed) {
                        e.preventDefault();
                        Swal.fire({
                            title: @json(__('តើអ្នកពិតជាចង់ចុះឈ្មោះគណនីថ្មីនេះមែនទេ?')),
                            text: @json(__('សូមពិនិត្យអ៊ីមែល និងតួនាទីបុគ្គលិកឱ្យបានត្រឹមត្រូវ!')),
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#0f766e',
                            cancelButtonColor: '#64748b',
                            confirmButtonText: @json(__('បាទ/ចាស, ចុះឈ្មោះ!')),
                            cancelButtonText: @json(__('ពិនិត្យឡើងវិញ')),
                            background: '#ffffff',
                            color: '#1e293b',
                            borderRadius: '1.25rem'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.dataset.confirmed = 'true';
                                form.submit();
                            }
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>
