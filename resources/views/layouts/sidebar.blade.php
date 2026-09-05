<!-- Left Sidebar Navigation -->
<aside
    :class="{
        'translate-x-0': sidebarOpen,
        '-translate-x-full': !sidebarOpen,
        'lg:translate-x-0': true,
        'lg:w-64': !sidebarCollapsed,
        'lg:w-20': sidebarCollapsed
    }"
    class="fixed inset-y-0 left-0 z-40 bg-slate-900/90 dark:bg-slate-950/90 backdrop-blur-xl text-slate-300 flex flex-col transition-all duration-300 ease-in-out border-r border-slate-800/80 shadow-2xl shrink-0"
    x-cloak
>
    <!-- Sidebar Header / Brand Logo -->
    <div class="h-16 flex items-center justify-between px-4 border-b border-slate-800/80 bg-slate-950/40 backdrop-blur-md">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden group">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-teal-500 via-teal-600 to-sky-500 text-white flex items-center justify-center font-extrabold text-xl shadow-lg shadow-teal-500/25 shrink-0 group-hover:scale-105 transition-transform duration-300">
                S
            </div>
            <div class="flex flex-col whitespace-nowrap transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed, 'block': !sidebarCollapsed }">
                <span class="font-extrabold text-white text-base tracking-tight leading-none">SmartCare <span class="text-teal-400">HMS</span></span>
                <span class="text-[10px] text-teal-400/90 font-medium tracking-wider uppercase mt-1">ប្រព័ន្ធគ្រប់គ្រងមន្ទីរពេទ្យ</span>
            </div>
        </a>

        <!-- Collapse Toggle Button (Desktop Only) -->
        <button
            @click="sidebarCollapsed = !sidebarCollapsed"
            class="hidden lg:flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
            :title="sidebarCollapsed ? 'ពង្រីក Sidebar' : 'បង្រួម Sidebar'"
        >
            <svg class="w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': sidebarCollapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>

    <!-- Navigation Links Scroll Area -->
    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1.5 scrollbar-thin scrollbar-thumb-slate-800">

        <!-- Navigation Section Label -->
        <div class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2" :class="{ 'lg:text-center lg:px-0': sidebarCollapsed }">
            <span :class="{ 'lg:hidden': sidebarCollapsed }">ម៉ឺនុយចម្បង</span>
            <span class="hidden" :class="{ 'lg:inline': sidebarCollapsed }">•••</span>
        </div>

        <!-- 1. Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('dashboard') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('ទំព័រដើម') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('ទំព័រដើម') }}</span>
            @if(request()->routeIs('dashboard'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- Calendar & Live Clock Feature Navigation -->
        <a href="{{ route('calendar.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('calendar.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('កាលវិភាគ & នាឡិកា') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0 text-amber-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('កាលវិភាគ & នាឡិកា') }}</span>
            @if(request()->routeIs('calendar.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- 2. Patients -->
        <a href="{{ route('patients.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('patients.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('អ្នកជំងឺ') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('គ្រប់គ្រងអ្នកជំងឺ') }}</span>
            @if(request()->routeIs('patients.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- 3. Handovers -->
        <a href="{{ route('handovers.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('handovers.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('ប្រគល់វេន') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('ប្រគល់-ទទួលវេន') }}</span>
            @if(request()->routeIs('handovers.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- 4. Medical Records / OPD -->
        <a href="{{ route('medical-records.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('medical-records.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('OPD / ពិគ្រោះ') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('OPD / ពិគ្រោះជំងឺ') }}</span>
            @if(request()->routeIs('medical-records.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- 5. Surgeries -->
        <a href="{{ route('surgeries.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('surgeries.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('ការវះកាត់') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('ការវះកាត់') }}</span>
            @if(request()->routeIs('surgeries.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- 6. Nursing Logs -->
        <a href="{{ route('nursing-logs.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('nursing-logs.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('កំណត់ត្រាថែទាំ') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.684a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('កំណត់ត្រាថែទាំ') }}</span>
            @if(request()->routeIs('nursing-logs.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- 7. ER & Equipment -->
        <a href="{{ route('equipments.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('equipments.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('ER / ឧបករណ៍') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('ER / ឧបករណ៍ពេទ្យ') }}</span>
            @if(request()->routeIs('equipments.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <!-- 8. Invoices -->
        <a href="{{ route('invoices.index') }}"
           class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('invoices.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
           :title="sidebarCollapsed ? '{{ __('វិក្កយបត្រ') }}' : ''">
            <div class="w-6 h-6 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('វិក្កយបត្រ & ការទូទាត់') }}</span>
            @if(request()->routeIs('invoices.*'))
                <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
            @endif
        </a>

        <div class="pt-4 mt-4 border-t border-slate-800">
            <div class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2" :class="{ 'lg:text-center lg:px-0': sidebarCollapsed }">
                <span :class="{ 'lg:hidden': sidebarCollapsed }">ការកំណត់</span>
                <span class="hidden" :class="{ 'lg:inline': sidebarCollapsed }">⚙️</span>
            </div>

            <!-- System Settings -->
            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('settings.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
               :title="sidebarCollapsed ? '{{ __('ការកំណត់ប្រព័ន្ធ') }}' : ''">
                <div class="w-6 h-6 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('ការកំណត់ប្រព័ន្ធ') }}</span>
                @if(request()->routeIs('settings.*'))
                    <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
                @endif
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.show') }}"
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-medium text-sm transition-all group relative {{ request()->routeIs('profile.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}"
               :title="sidebarCollapsed ? '{{ __('ព័ត៌មាន Profile') }}' : ''">
                <div class="w-6 h-6 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="truncate transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">{{ __('ព័ត៌មាន Profile') }}</span>
                @if(request()->routeIs('profile.*'))
                    <span class="absolute right-2 w-1.5 h-1.5 rounded-full bg-teal-300" :class="{ 'lg:hidden': sidebarCollapsed }"></span>
                @endif
            </a>
        </div>
    </div>

    <!-- Sidebar Footer / Quick User Card -->
    <div class="p-3 border-t border-slate-800 bg-slate-950/60">
        <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-800/50 hover:bg-slate-800 transition-colors">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-lg object-cover border border-teal-500 shrink-0">
            <div class="flex-1 min-w-0 transition-opacity duration-200" :class="{ 'lg:hidden': sidebarCollapsed }">
                <p class="text-sm font-semibold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                <p class="text-xs text-teal-400 truncate mt-0.5">{{ Auth::user()->role_name }}</p>
            </div>
        </div>
    </div>
</aside>

<!-- Backdrop overlay for mobile drawer -->
<div
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-30 bg-slate-950/60 backdrop-blur-sm lg:hidden"
    x-cloak
></div>
