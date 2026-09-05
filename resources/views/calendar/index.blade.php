<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight tracking-tight">
                    {{ __('កាលវិភាគ & នាឡិកាផ្សាយផ្ទាល់ (Calendar & Clock)') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">{{ __('តាមដានកាលវិភាគវះកាត់ ការប្រគល់វេន និងការពិគ្រោះជំងឺប្រចាំថ្ងៃ') }}</p>
            </div>

            <!-- Live Digital Clock Display -->
            <div class="flex items-center gap-3 bg-slate-900 text-white dark:bg-slate-800 px-5 py-2.5 rounded-2xl shadow-md border border-slate-700/50">
                <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shrink-0"></div>
                <div class="font-mono text-lg font-bold text-teal-400 tracking-wider" id="live_clock_text">
                    --:--:-- --
                </div>
                <div class="text-xs text-slate-400 border-l border-slate-700 pl-3 font-medium hidden sm:block" id="live_date_text">
                    ----
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ selectedDayEvents: null, selectedDateStr: '' }">

        <!-- Top Header Navigation & Month Selector -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-4 md:p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-xs">
            <div class="flex items-center gap-3">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white font-mono">
                    {{ $currentDate->translatedFormat('F Y') }}
                </h3>
                <span class="px-2.5 py-1 text-xs font-semibold bg-teal-50 dark:bg-teal-900/40 text-teal-700 dark:text-teal-300 rounded-lg border border-teal-200 dark:border-teal-800">
                    {{ count($eventsByDate) }} {{ __('ថ្ងៃមានព្រឹត្តិការណ៍') }}
                </span>
            </div>

            <!-- Month Controls -->
            <div class="flex items-center gap-2">
                <a href="{{ route('calendar.index', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-xl transition-colors" title="{{ __('ខែមុន') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <a href="{{ route('calendar.index') }}" class="px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-xs font-bold rounded-xl transition-colors shadow-xs">
                    {{ __('ថ្ងៃនេះ (Today)') }}
                </a>
                <a href="{{ route('calendar.index', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-xl transition-colors" title="{{ __('ខែបន្ទាប់') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Legend Bar -->
        <div class="flex flex-wrap items-center gap-4 bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 text-xs font-semibold">
            <span class="text-slate-500 dark:text-slate-400">{{ __('សន្ទស្សន៍ព្រឹត្តិការណ៍') }}៖</span>
            <div class="flex items-center gap-1.5 px-3 py-1 bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 rounded-lg border border-rose-200 dark:border-rose-800">
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                <span>{{ __('ការវះកាត់ (Surgeries)') }}</span>
            </div>
            <div class="flex items-center gap-1.5 px-3 py-1 bg-teal-50 dark:bg-teal-950/40 text-teal-700 dark:text-teal-300 rounded-lg border border-teal-200 dark:border-teal-800">
                <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                <span>{{ __('ប្រគល់-ទទួលវេន (Shift Handovers)') }}</span>
            </div>
            <div class="flex items-center gap-1.5 px-3 py-1 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 rounded-lg border border-emerald-200 dark:border-emerald-800">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>{{ __('OPD / ពិគ្រោះជំងឺ (Consultations)') }}</span>
            </div>
        </div>

        <!-- Calendar Main Grid & Side Panel Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Month Calendar Grid (Spans 2 cols) -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-4 sm:p-6 shadow-2xs space-y-4">
                
                <!-- Day Headers (Sun -> Sat) -->
                <div class="grid grid-cols-7 text-center font-bold text-xs text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 pb-3">
                    <div>{{ __('អាទិត្យ') }}</div>
                    <div>{{ __('ចន្ទ') }}</div>
                    <div>{{ __('អង្គារ') }}</div>
                    <div>{{ __('ពុធ') }}</div>
                    <div>{{ __('ព្រហស្បតិ៍') }}</div>
                    <div>{{ __('សុក្រ') }}</div>
                    <div>{{ __('សៅរ៍') }}</div>
                </div>

                <!-- Calendar Days Grid -->
                <div class="grid grid-cols-7 gap-1.5 sm:gap-2">
                    <!-- Empty slots for days before start of month -->
                    @for ($i = 0; $i < $startDayOfWeek; $i++)
                    <div class="h-20 sm:h-24 bg-slate-50/50 dark:bg-slate-950/30 rounded-xl border border-dashed border-slate-100 dark:border-slate-800/50 opacity-40"></div>
                    @endfor

                    <!-- Active days of the month -->
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $dateString = sprintf('%04d-%02d-%02d', $year, $month, $day);
                            $isToday = ($dateString === \Carbon\Carbon::now()->format('Y-m-d'));
                            $hasEvents = isset($eventsByDate[$dateString]);
                            $dayEvents = $eventsByDate[$dateString] ?? [];
                        @endphp

                        <div 
                            @click="selectedDayEvents = {{ json_encode($dayEvents) }}; selectedDateStr = '{{ $dateString }}'"
                            class="h-20 sm:h-24 p-1.5 rounded-xl border transition-all cursor-pointer flex flex-col justify-between group
                                {{ $isToday ? 'border-teal-500 bg-teal-50/30 dark:bg-teal-950/30 font-bold ring-2 ring-teal-500/20' : 'border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:border-teal-400 hover:bg-slate-50 dark:hover:bg-slate-800/80' }}"
                        >
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-mono font-semibold {{ $isToday ? 'text-teal-700 dark:text-teal-400 bg-teal-100 dark:bg-teal-900 px-1.5 py-0.5 rounded-md' : 'text-slate-700 dark:text-slate-300' }}">
                                    {{ $day }}
                                </span>
                                @if($hasEvents)
                                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                                @endif
                            </div>

                            <!-- Events Preview Badges inside day box -->
                            <div class="space-y-1 overflow-hidden">
                                @foreach(array_slice($dayEvents, 0, 2) as $ev)
                                    <div class="text-[10px] truncate font-medium px-1.5 py-0.5 rounded
                                        {{ $ev['type'] === 'surgery' ? 'bg-rose-100 text-rose-800 dark:bg-rose-900/60 dark:text-rose-200' : '' }}
                                        {{ $ev['type'] === 'handover' ? 'bg-teal-100 text-teal-800 dark:bg-teal-900/60 dark:text-teal-200' : '' }}
                                        {{ $ev['type'] === 'opd' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-200' : '' }}">
                                        {{ $ev['time'] }} - {{ $ev['title'] }}
                                    </div>
                                @endforeach

                                @if(count($dayEvents) > 2)
                                    <div class="text-[9px] text-slate-400 font-semibold px-1">
                                        +{{ count($dayEvents) - 2 }} {{ __('ផ្សេងទៀត') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>

            </div>

            <!-- Day Events Detail Side Panel -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-2xs space-y-4">
                <div class="border-b border-slate-100 dark:border-slate-800 pb-3 flex items-center justify-between">
                    <h4 class="font-bold text-slate-800 dark:text-white text-base">
                        {{ __('ព័ត៌មានលម្អិតកាលវិភាគ') }}
                    </h4>
                    <span x-text="selectedDateStr || '{{ \Carbon\Carbon::now()->format('Y-m-d') }}'" class="text-xs font-mono font-semibold text-teal-700 dark:text-teal-400 bg-teal-50 dark:bg-teal-950 px-2.5 py-1 rounded-lg border border-teal-200 dark:border-teal-800"></span>
                </div>

                <!-- Default State: Show Today's Events if none selected -->
                <div class="space-y-3">
                    <template x-if="selectedDayEvents === null">
                        <div>
                            @php
                                $todayStr = \Carbon\Carbon::now()->format('Y-m-d');
                                $todayEvents = $eventsByDate[$todayStr] ?? [];
                            @endphp
                            @if(count($todayEvents) > 0)
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">{{ __('ព្រឹត្តិការណ៍ថ្ងៃនេះ') }} ({{ count($todayEvents) }})៖</p>
                                <div class="space-y-2.5">
                                    @foreach($todayEvents as $ev)
                                    <div class="p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50 space-y-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-bold font-mono text-teal-700 dark:text-teal-400">{{ $ev['time'] }}</span>
                                            <a href="{{ $ev['detail_url'] }}" class="text-[11px] font-semibold text-teal-600 hover:underline">{{ __('មើលព័ត៌មានលម្អិត') }} &rarr;</a>
                                        </div>
                                        <h5 class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ $ev['title'] }}</h5>
                                        @if(isset($ev['doctor']))
                                        <p class="text-xs text-slate-500">👨‍⚕️ {{ __('គ្រូពេទ្យ') }}៖ {{ $ev['doctor'] }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-12 text-center text-slate-400 space-y-2">
                                    <div class="text-3xl">📅</div>
                                    <p class="text-xs">{{ __('សូមចុចលើថ្ងៃណាមួយនៅលើ Calendar ដើម្បីមើលកាលវិភាគ') }}</p>
                                </div>
                            @endif
                        </div>
                    </template>

                    <!-- Interactive Selected Day Event List -->
                    <template x-if="selectedDayEvents !== null">
                        <div>
                            <template x-if="selectedDayEvents.length === 0">
                                <div class="py-12 text-center text-slate-400 space-y-2">
                                    <div class="text-3xl">☕</div>
                                    <p class="text-xs">{{ __('គ្មានកាលវិភាគ ឬ ព្រឹត្តិការណ៍សម្រាប់ថ្ងៃនេះទេ') }}</p>
                                </div>
                            </template>

                            <template x-if="selectedDayEvents.length > 0">
                                <div class="space-y-3">
                                    <template x-for="(ev, index) in selectedDayEvents" :key="index">
                                        <div class="p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50 space-y-1">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs font-bold font-mono text-teal-700 dark:text-teal-400" x-text="ev.time"></span>
                                                <a :href="ev.detail_url" class="text-[11px] font-semibold text-teal-600 hover:underline">{{ __('មើលព័ត៌មានលម្អិត') }} &rarr;</a>
                                            </div>
                                            <h5 class="text-sm font-semibold text-slate-800 dark:text-slate-200" x-text="ev.title"></h5>
                                            <template x-if="ev.doctor">
                                                <p class="text-xs text-slate-500">👨‍⚕️ {{ __('គ្រូពេទ្យ') }}៖ <span x-text="ev.doctor"></span></p>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

        </div>

    </div>

    <!-- Live Real-Time Clock Script -->
    <script>
        function updateLiveClock() {
            const now = new Date();
            const hours = String(now.getHours() % 12 || 12).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = now.getHours() >= 12 ? 'PM' : 'AM';

            const timeStr = `${hours}:${minutes}:${seconds} ${ampm}`;
            const dateStr = now.toLocaleDateString(undefined, { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });

            const clockEl = document.getElementById('live_clock_text');
            const dateEl = document.getElementById('live_date_text');

            if (clockEl) clockEl.textContent = timeStr;
            if (dateEl) dateEl.textContent = dateStr;
        }

        setInterval(updateLiveClock, 1000);
        updateLiveClock();
    </script>
</x-app-layout>
