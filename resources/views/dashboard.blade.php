<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 dark:text-white tracking-tight leading-tight flex items-center gap-2">
                    <span class="gradient-text">{{ __('ផ្ទាំងគ្រប់គ្រងបញ្ជាការ (HMS Command Center)') }}</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-teal-500/10 text-teal-600 dark:text-teal-400 border border-teal-500/20">
                        Live 24/7
                    </span>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    {{ __('សូមស្វាគមន៍មកកាន់ប្រព័ន្ធគ្រប់គ្រងមន្ទីរពេទ្យឆ្លាតវៃ SmartCare HMS') }}
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <!-- Triage Action Trigger -->
                <button type="button" @click="$dispatch('open-triage-modal')" class="px-4 py-2 bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-400 hover:to-emerald-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-teal-500/25 transition-all flex items-center gap-2 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>{{ __('+ Triage បន្ទាន់ (Quick Triage)') }}</span>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-8" x-data="{ triageModalOpen: false }" @open-triage-modal.window="triageModalOpen = true">

        <!-- Futuristic Glass Hero Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-teal-950 to-slate-950 p-6 md:p-8 text-white border border-teal-500/30 shadow-2xl glow-teal">
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-teal-500/20 rounded-full blur-3xl pointer-events-none animate-pulse-glow"></div>
            <div class="absolute right-1/3 top-0 w-64 h-64 bg-sky-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="max-w-2xl space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-teal-500/20 border border-teal-500/30 rounded-xl text-xs font-semibold text-teal-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>SmartCare Operating System v2.5</span>
                    </div>
                    <h3 class="text-3xl font-extrabold tracking-tight">
                        {{ __('ជម្រាបសួរ') }}, <span class="text-teal-400">{{ Auth::user()->name ?? 'លោកគ្រូពេទ្យ/អ្នកគ្រូពេទ្យ' }}</span> 👋
                    </h3>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        {{ __('គ្រប់គ្រងសំណុំរឿងអ្នកជំងឺ ការប្រគល់វេនការងារ កាលវិភាគវះកាត់ និងឧបករណ៍វេជ្ជសាស្ត្របានយ៉ាងងាយស្រួល និងច្បាស់លាស់ តាមដានស្ថានភាពក្នុងពេល real-time។') }}
                    </p>
                </div>

                <!-- Live Hospital Pulse Badge -->
                <div class="bg-slate-900/80 backdrop-blur-xl border border-teal-500/40 p-4 rounded-2xl flex items-center gap-4 shrink-0 min-w-[220px]">
                    <div class="w-12 h-12 rounded-xl bg-teal-500/20 text-teal-400 border border-teal-500/30 flex items-center justify-center font-bold text-xl shrink-0 animate-pulse">
                        🏥
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">ស្ថានភាពមន្ទីរពេទ្យ</p>
                        <p class="text-sm font-extrabold text-teal-300">ដំណើរការល្អ ១០០%</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">បន្ទប់សង្គ្រោះ ER ទំនេរ ៤ បន្ទប់</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- Stat Card 1 -->
            <div class="glass-card p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 flex items-center justify-between group hover:border-teal-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-600 dark:text-teal-400 border border-teal-500/20 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-110 transition-transform">
                        👨‍👩‍👧‍👦
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ __('អ្នកជំងឺប្រចាំថ្ងៃ') }}</p>
                        <h4 class="text-xl font-extrabold text-slate-800 dark:text-white mt-0.5">128 នាក់</h4>
                    </div>
                </div>
                <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                    +14.2% 📈
                </span>
            </div>

            <!-- Stat Card 2 -->
            <div class="glass-card p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 flex items-center justify-between group hover:border-sky-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 dark:text-sky-400 border border-sky-500/20 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-110 transition-transform">
                        🩺
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ __('ពិនិត្យ OPD') }}</p>
                        <h4 class="text-xl font-extrabold text-slate-800 dark:text-white mt-0.5">85 ករណី</h4>
                    </div>
                </div>
                <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-sky-500/10 text-sky-600 dark:text-sky-400 border border-sky-500/20">
                    +8.5% 🩺
                </span>
            </div>

            <!-- Stat Card 3 -->
            <div class="glass-card p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 flex items-center justify-between group hover:border-rose-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-110 transition-transform">
                        🔪
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ __('ប្រតិបត្តិការវះកាត់') }}</p>
                        <h4 class="text-xl font-extrabold text-slate-800 dark:text-white mt-0.5">12 ករណី</h4>
                    </div>
                </div>
                <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20">
                    តាមផែនការ 🗓️
                </span>
            </div>

            <!-- Stat Card 4 -->
            <div class="glass-card p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 flex items-center justify-between group hover:border-indigo-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-110 transition-transform">
                        ⚡
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ __('ឧបករណ៍ ER') }}</p>
                        <h4 class="text-xl font-extrabold text-slate-800 dark:text-white mt-0.5">99.4%</h4>
                    </div>
                </div>
                <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20">
                    Ready ⚡
                </span>
            </div>
        </div>

        <!-- Interactive Chart.js Analytics & Live Activity Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Chart.js Canvas (2 Columns on Desktop) -->
            <div class="lg:col-span-2 glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-slate-200/60 dark:border-slate-800/60">
                    <div>
                        <h4 class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                            📊 <span>{{ __('វិភាគស្ថិតិអ្នកជំងឺ និងការប្រគល់វេន (Hospital Analytics)') }}</span>
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ __('អត្រាចុះឈ្មោះអ្នកជំងឺ ការពិគ្រោះ OPD និងកាលវិភាគវះកាត់ប្រចាំសប្តាហ៍') }}</p>
                    </div>

                    <div class="flex items-center gap-2 text-xs font-semibold">
                        <span class="flex items-center gap-1 text-teal-600 dark:text-teal-400"><span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span> អ្នកជំងឺ</span>
                        <span class="flex items-center gap-1 text-sky-600 dark:text-sky-400"><span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span> វះកាត់</span>
                    </div>
                </div>

                <div class="relative h-72 w-full">
                    <canvas id="hmsAnalyticsChart"></canvas>
                </div>
            </div>

            <!-- Live Hospital Feed (1 Column on Desktop) -->
            <div class="glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200/60 dark:border-slate-800/60">
                        <h4 class="text-base font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                            🔔 <span>{{ __('សកម្មភាពចុងក្រោយ (Live Feed)') }}</span>
                        </h4>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                    </div>

                    <div class="divide-y divide-slate-100 dark:divide-slate-800/60 mt-2 space-y-3">
                        <div class="pt-2 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-teal-500/10 text-teal-500 flex items-center justify-center shrink-0 text-sm font-bold">
                                👨‍⚕️
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-100">វេជ្ជបណ្ឌិត សុខា បានកត់ត្រា OPD ថ្មី</p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">អ្នកជំងឺ៖ សុខ ចាន់ថា (ID: P-2026-004)</p>
                                <span class="text-[10px] text-teal-600 dark:text-teal-400 font-mono mt-0.5 inline-block">៥ នាទីមុន</span>
                            </div>
                        </div>

                        <div class="pt-3 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center shrink-0 text-sm font-bold">
                                🔄
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-100">បានបញ្ចប់ការប្រគល់វេនយប់</p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">គិលានុបដ្ឋាយិកា ម៉ារី បានបញ្ជូនវេនព្រឹក</p>
                                <span class="text-[10px] text-amber-600 dark:text-amber-400 font-mono mt-0.5 inline-block">១៥ នាទីមុន</span>
                            </div>
                        </div>

                        <div class="pt-3 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center shrink-0 text-sm font-bold">
                                💰
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-100">ទូទាត់វិក្កយបត្រតាម KHQR ជោគជ័យ</p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">ទឹកប្រាក់៖ $145.00 (Inv #1092)</p>
                                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-mono mt-0.5 inline-block">៣០ នាទីមុន</span>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('patients.index') }}" class="w-full py-2.5 px-4 bg-slate-100 dark:bg-slate-800 hover:bg-teal-500 hover:text-white dark:hover:bg-teal-600 text-slate-700 dark:text-slate-200 text-xs font-bold rounded-xl transition-all text-center block">
                    {{ __('មើលកំណត់ត្រាទាំងអស់ ➔') }}
                </a>
            </div>
        </div>

        <!-- Modules Grid Links -->
        <div>
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-extrabold text-slate-800 dark:text-white">{{ __('ផ្នែក និងមុខងារសំខាន់ៗ (HMS Modules)') }}</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('ជ្រើសរើសផ្នែកខាងក្រោមដើម្បីចូលទៅកាន់ទំព័រគ្រប់គ្រងនីមួយៗ') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <!-- Module 0: Calendar & Live Clock -->
                <a href="{{ route('calendar.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5 glow-teal">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('កាលវិភាគ & នាឡិកា (Calendar)') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('នាឡិកាផ្សាយផ្ទាល់ កាលវិភាគវះកាត់ និងការប្រគល់វេនប្រចាំថ្ងៃ។') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលកាលវិភាគ') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Module 1: Patient Management -->
                <a href="{{ route('patients.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('គ្រប់គ្រងព័ត៌មានអ្នកជំងឺ') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('បញ្ជីឈ្មោះអ្នកជំងឺដែលបានចុះឈ្មោះក្នុងប្រព័ន្ធមន្ទីរពេទ្យ') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលព័ត៌មានលម្អិត') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Module 2: Shift Handover -->
                <a href="{{ route('handovers.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('គ្រប់គ្រងការប្រគល់-ទទួលវេន') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('របាយការណ៍ប្តូរវេន និងការប្រគល់ភារកិច្ចរវាងបុគ្គលិកពេទ្យ') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលព័ត៌មានលម្អិត') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Module 3: Medical Records OPD -->
                <a href="{{ route('medical-records.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('សំណុំរឿងពិនិត្យ (OPD)') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('កត់ត្រាការពិគ្រោះជំងឺ ការពិនិត្យរាងកាយ និងការណែនាំព្យាបាល') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលព័ត៌មានលម្អិត') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Module 4: Surgeries -->
                <a href="{{ route('surgeries.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('កាលវិភាគ & ការវះកាត់') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('ពិនិត្យកាលវិភាគ សួរសុខទុក្ខមុនវះកាត់ និងត្រៀមបន្ទប់វះកាត់') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលព័ត៌មានលម្អិត') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Module 5: Nursing Logs -->
                <a href="{{ route('nursing-logs.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('កំណត់ត្រាថែទាំ (Nursing Logs)') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('កត់ត្រាការរៀបចំឱសថ ការចុះតាមដានអ្នកជំងឺ និងកិច្ចសហការរដ្ឋបាល') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលព័ត៌មានលម្អិត') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Module 6: Equipment Management -->
                <a href="{{ route('equipments.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('ER & ឧបករណ៍ពេទ្យ') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('ពិនិត្យ និងតាមដានស្ថានភាពឧបករណ៍សង្គ្រោះជីវិតតាមផ្នែកនីមួយៗ') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលព័ត៌មានលម្អិត') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Module 7: Invoices & Billing -->
                <a href="{{ route('invoices.index') }}" class="group glass-card p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-teal-500/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1.5">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-500 border border-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h5 class="font-extrabold text-slate-800 dark:text-white group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors">{{ __('វិក្កយបត្រ & ទូទាត់ប្រាក់') }}</h5>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ __('ចេញវិក្កយបត្រថ្លៃព្យាបាល តាមដានការទូទាត់ និងបោះពុម្ពប័ណ្ណទូទាត់') }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                        <span>{{ __('មើលព័ត៌មានលម្អិត') }}</span>
                        <svg class="w-4 h-4 ms-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

            </div>
        </div>

        <!-- Quick Triage Modal -->
        <div x-show="triageModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md" x-cloak>
            <div class="bg-slate-900 border border-slate-800 rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-4 glow-teal">
                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        🚑 <span>{{ __('ចុះឈ្មោះ Triage បន្ទាន់ (Quick Triage Entry)') }}</span>
                    </h3>
                    <button type="button" @click="triageModalOpen = false" class="text-slate-400 hover:text-white text-xl">✕</button>
                </div>
                
                <form action="{{ route('patients.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">ឈ្មោះអ្នកជំងឺ (Patient Name)</label>
                        <input type="text" name="name" required placeholder="ឧ. ចាន់ សុភា" class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-sm text-white focus:ring-2 focus:ring-teal-500/40">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">ភេទ (Gender)</label>
                            <select name="gender" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-sm text-white focus:ring-2 focus:ring-teal-500/40">
                                <option value="male">ប្រុស (Male)</option>
                                <option value="female">ស្រី (Female)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">អាយុ (Age)</label>
                            <input type="number" name="age" required placeholder="28" class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-sm text-white focus:ring-2 focus:ring-teal-500/40">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">លេខទូរស័ព្ទ (Phone Number)</label>
                        <input type="text" name="phone_number" required placeholder="012 345 678" class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-sm text-white focus:ring-2 focus:ring-teal-500/40">
                    </div>

                    <div class="pt-2 flex justify-end gap-2">
                        <button type="button" @click="triageModalOpen = false" class="px-4 py-2 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700">បោះបង់</button>
                        <button type="submit" class="px-5 py-2 bg-teal-500 hover:bg-teal-400 text-white text-xs font-bold rounded-xl shadow-lg shadow-teal-500/25">រក្សាទុកប្រញាប់</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Chart.js Script Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('hmsAnalyticsChart');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['ច័ន្ទ', 'អង្គារ', 'ពុធ', 'ព្រហស្បតិ៍', 'សុក្រ', 'សៅរ៍', 'អាទិត្យ'],
                    datasets: [
                        {
                            label: 'អ្នកជំងឺចុះឈ្មោះ',
                            data: [35, 48, 40, 62, 55, 78, 92],
                            borderColor: '#0d9488',
                            backgroundColor: 'rgba(13, 148, 136, 0.15)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#2dd4bf',
                            pointRadius: 5
                        },
                        {
                            label: 'ការវះកាត់ប្រចាំថ្ងៃ',
                            data: [5, 8, 4, 10, 7, 12, 14],
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#38bdf8',
                            pointRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)'
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    family: 'Kantumruy Pro'
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)'
                            },
                            ticks: {
                                color: '#94a3b8'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>

