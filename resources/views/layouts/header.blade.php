<!-- Top Header Bar -->
<header class="sticky top-0 z-30 bg-white/75 dark:bg-slate-900/75 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 shadow-xs transition-colors">
    <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
        
        <!-- Left: Mobile/Desktop Sidebar Toggle & Search Bar -->
        <div class="flex items-center gap-3 lg:gap-4 flex-1">
            <!-- Mobile Sidebar Toggle -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none"
                aria-label="Toggle Navigation Menu"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Desktop Sidebar Toggle Button (when collapsed) -->
            <button
                @click="sidebarCollapsed = !sidebarCollapsed"
                class="hidden lg:flex items-center justify-center p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-100 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none"
                title="Toggle Sidebar"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8M4 18h16"/>
                </svg>
            </button>

            <!-- Global Patient Search Input -->
            <div class="relative max-w-md w-full hidden sm:block">
                <form action="{{ route('patients.index') }}" method="GET" class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('🔍 ស្វែងរកលេខកូដ ឬ ឈ្មោះអ្នកជំងឺ...') }}"
                        class="w-full pl-10 pr-4 py-2 text-sm bg-slate-100/70 dark:bg-slate-800/70 backdrop-blur-md border border-slate-200/80 dark:border-slate-700/80 rounded-xl text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 focus:bg-white dark:focus:bg-slate-900 transition-all shadow-inner"
                    >
                </form>
            </div>
        </div>

        <!-- Right: Clock, Calendar Quick Link, Actions, Dark/Light Mode, Notifications & Doctor Profile Dropdown -->
        <div class="flex items-center gap-2 sm:gap-3">

            <!-- Live Digital Ticking Clock Button (Click to open Calendar) -->
            <a href="{{ route('calendar.index') }}" class="hidden lg:flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-slate-900 to-slate-800 text-white dark:from-slate-900 dark:to-slate-950 rounded-xl text-xs font-mono font-bold hover:shadow-lg hover:shadow-teal-500/10 transition-all border border-slate-700/80 group" title="{{ __('មើលកាលវិភាគពេញលេញ') }}">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span id="header_live_clock" class="text-teal-300 font-bold">00:00:00 AM</span>
                <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-teal-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </a>
            
            <!-- Quick Add Patient Button -->
            <a href="{{ route('patients.create') }}" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold rounded-xl shadow-xs hover:shadow transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>{{ __('+ អ្នកជំងឺថ្មី') }}</span>
            </a>

            <!-- Multi-Language Switcher Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button type="button" class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/80 hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 transition-colors focus:outline-none">
                        @php $currentLang = app()->getLocale(); @endphp
                        @if($currentLang === 'en')
                            <span>🇬🇧</span> <span class="hidden sm:inline">English</span>
                        @elseif($currentLang === 'zh')
                            <span>🇨🇳</span> <span class="hidden sm:inline">中文</span>
                        @elseif($currentLang === 'ja')
                            <span>🇯🇵</span> <span class="hidden sm:inline">日本語</span>
                        @elseif($currentLang === 'ko')
                            <span>🇰🇷</span> <span class="hidden sm:inline">한국어</span>
                        @else
                            <span>🇰🇭</span> <span class="hidden sm:inline">ខ្មែរ</span>
                        @endif
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-3 py-1.5 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider border-b border-slate-100 dark:border-slate-800">
                        ជ្រើសរើសភាសា / Select Language
                    </div>

                    <x-dropdown-link :href="route('lang.switch', 'km')" class="flex items-center gap-2.5 {{ app()->getLocale() === 'km' ? 'font-bold text-teal-700 dark:text-teal-400 bg-teal-50/50 dark:bg-teal-950/40' : '' }}">
                        <span class="text-base">🇰🇭</span>
                        <span>ខ្មែរ (Khmer)</span>
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('lang.switch', 'en')" class="flex items-center gap-2.5 {{ app()->getLocale() === 'en' ? 'font-bold text-teal-700 dark:text-teal-400 bg-teal-50/50 dark:bg-teal-950/40' : '' }}">
                        <span class="text-base">🇬🇧</span>
                        <span>English</span>
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('lang.switch', 'zh')" class="flex items-center gap-2.5 {{ app()->getLocale() === 'zh' ? 'font-bold text-teal-700 dark:text-teal-400 bg-teal-50/50 dark:bg-teal-950/40' : '' }}">
                        <span class="text-base">🇨🇳</span>
                        <span>中文 (Chinese)</span>
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('lang.switch', 'ja')" class="flex items-center gap-2.5 {{ app()->getLocale() === 'ja' ? 'font-bold text-teal-700 dark:text-teal-400 bg-teal-50/50 dark:bg-teal-950/40' : '' }}">
                        <span class="text-base">🇯🇵</span>
                        <span>日本語 (Japanese)</span>
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('lang.switch', 'ko')" class="flex items-center gap-2.5 {{ app()->getLocale() === 'ko' ? 'font-bold text-teal-700 dark:text-teal-400 bg-teal-50/50 dark:bg-teal-950/40' : '' }}">
                        <span class="text-base">🇰🇷</span>
                        <span>한국어 (Korean)</span>
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <!-- Theme Toggle Switch Button (Dark / Light Mode) -->
            <button
                type="button"
                onclick="const isDark = toggleDarkMode(); if (window.Alpine) { const root = document.querySelector('[x-data]'); if (root && root._x_dataStack) { root._x_dataStack[0].darkMode = isDark; } }"
                @click="darkMode = !darkMode"
                class="p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-100 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none"
                :title="darkMode ? 'ប្តូរទៅ Light Mode' : 'ប្តូរទៅ Dark Mode'"
                aria-label="Toggle Theme"
            >
                <!-- Sun Icon (shown when Dark Mode is active) -->
                <svg x-show="darkMode" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <!-- Moon Icon (shown when Light Mode is active) -->
                <svg x-show="!darkMode" class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>

            <!-- Notification Bell Icon Button -->
            <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-100 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors relative focus:outline-none"
                    title="ការជូនដំណឹង"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <!-- Notification Badge -->
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white dark:ring-slate-900"></span>
                </button>

                <!-- Notifications Dropdown Popup -->
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200/80 dark:border-slate-800 py-2 z-50 overflow-hidden"
                    x-cloak
                >
                    <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <span class="font-bold text-sm text-slate-800 dark:text-slate-100">ការជូនដំណឹង</span>
                        <span class="text-[11px] bg-teal-50 dark:bg-teal-950/60 text-teal-700 dark:text-teal-400 font-semibold px-2 py-0.5 rounded-md">ថ្មី ២</span>
                    </div>
                    <div class="divide-y divide-slate-100 dark:divide-slate-800 max-h-64 overflow-y-auto">
                        <a href="{{ route('invoices.index') }}" class="p-3 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors block bg-emerald-50/40 dark:bg-emerald-950/20">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0 mt-0.5 font-bold text-sm">
                                💰
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-100">ទទួលបានប្រាក់ទូទាត់តាម KHQR</p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">អ្នកជំងឺបានបាញ់លុយចូលកុងធនាគារជោគជ័យ</p>
                            </div>
                        </a>
                        <a href="{{ route('surgeries.index') }}" class="p-3 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors block">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                🔪
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-800 dark:text-slate-100">មានការវះកាត់ជិតដល់ម៉ោង</p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">កាលវិភាគវះកាត់បន្ទប់ទី ២ ម៉ោង ១០:០០ ព្រឹក</p>
                            </div>
                        </a>
                        <a href="{{ route('handovers.index') }}" class="p-3 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors block">
                            <div class="w-8 h-8 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center shrink-0 mt-0.5">
                                🔄
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-800 dark:text-slate-100">ការប្រគល់វេនត្រូវបានបិទ</p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">វេនព្រឹកបានបញ្ជូនរបាយការណ៍រួចរាល់</p>
                            </div>
                        </a>
                    </div>
                    <div class="px-4 py-2 border-t border-slate-100 dark:border-slate-800 text-center bg-slate-50 dark:bg-slate-900/80">
                        <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-teal-700 dark:text-teal-400 hover:underline">មើលទាំងអស់</a>
                    </div>
                </div>
            </div>

            <!-- Vertical Divider -->
            <div class="h-6 w-[1px] bg-slate-200 dark:bg-slate-800"></div>

            <!-- Profile Dropdown -->
            <x-dropdown align="right" width="56">
                <x-slot name="trigger">
                    <button class="flex items-center gap-2.5 p-1 sm:px-3 sm:py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none text-left">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-lg object-cover border border-teal-600 shrink-0">
                        <div class="hidden sm:block leading-tight">
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-100 truncate max-w-[120px]">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->role_name }}</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 dark:text-slate-500 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
                        <p class="text-xs text-slate-400 dark:text-slate-500">តួនាទី៖ <span class="font-semibold text-teal-700 dark:text-teal-400">{{ Auth::user()->role_name }}</span></p>
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate mt-0.5">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <x-dropdown-link :href="route('calendar.index')" class="flex items-center gap-2 text-xs font-semibold text-teal-700 dark:text-teal-400">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('កាលវិភាគ & នាឡិកា') }}</span>
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('settings.index')" class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ __('ការកំណត់ប្រព័ន្ធ') }}</span>
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('profile.show')" class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ __('ព័ត៌មាន Profile') }}</span>
                    </x-dropdown-link>

                    <div class="border-t border-slate-100 dark:border-slate-800"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault(); this.closest('form').submit();"
                                         class="flex items-center gap-2 text-xs text-rose-600 hover:text-rose-700 dark:text-rose-400 dark:hover:bg-rose-950/40 hover:bg-rose-50">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>{{ __('ចាកចេញពីប្រព័ន្ធ') }}</span>
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>

<script>
    function updateHeaderClock() {
        const now = new Date();
        const hours = String(now.getHours() % 12 || 12).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = now.getHours() >= 12 ? 'PM' : 'AM';

        const clockEl = document.getElementById('header_live_clock');
        if (clockEl) {
            clockEl.textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
        }
    }
    setInterval(updateHeaderClock, 1000);
    updateHeaderClock();
</script>
