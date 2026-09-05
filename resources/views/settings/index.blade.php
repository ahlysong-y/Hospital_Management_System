<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ការកំណត់ប្រព័ន្ធ (System Settings)') }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ __('គ្រប់គ្រងព័ត៌មានមន្ទីរពេទ្យ អត្រាប្តូរប្រាក់ វិក្កយបត្រ និងការជូនដំណឹងប្រព័ន្ធ') }}</p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                {{ __('ត្រឡប់ទៅ Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ activeTab: 'general' }">

        @if (session('success'))
        <div class="p-4 bg-teal-50 border border-teal-200 text-teal-800 rounded-2xl flex items-center gap-3 shadow-2xs">
            <svg class="w-5 h-5 text-teal-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Tab Navigation Navigation Bar -->
        <div class="flex flex-wrap gap-2 border-b border-slate-200 bg-white p-2 rounded-2xl border shadow-2xs">
            <button
                @click="activeTab = 'general'"
                :class="{ 'bg-teal-600 text-white shadow-md shadow-teal-600/20 font-bold': activeTab === 'general', 'text-slate-600 hover:bg-slate-100 font-medium': activeTab !== 'general' }"
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm transition-all"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4"/>
                </svg>
                <span>{{ __('ព័ត៌មានទូទៅមន្ទីរពេទ្យ') }}</span>
            </button>

            <button
                @click="activeTab = 'financial'"
                :class="{ 'bg-teal-600 text-white shadow-md shadow-teal-600/20 font-bold': activeTab === 'financial', 'text-slate-600 hover:bg-slate-100 font-medium': activeTab !== 'financial' }"
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm transition-all"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>{{ __('វិក្កយបត្រ & ហិរញ្ញវត្ថុ') }}</span>
            </button>

            <button
                @click="activeTab = 'notifications'"
                :class="{ 'bg-teal-600 text-white shadow-md shadow-teal-600/20 font-bold': activeTab === 'notifications', 'text-slate-600 hover:bg-slate-100 font-medium': activeTab !== 'notifications' }"
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm transition-all"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span>{{ __('ការជូនដំណឹងប្រព័ន្ធ') }}</span>
            </button>

            <button
                @click="activeTab = 'branches'"
                :class="{ 'bg-teal-600 text-white shadow-md shadow-teal-600/20 font-bold': activeTab === 'branches', 'text-slate-600 hover:bg-slate-100 font-medium': activeTab !== 'branches' }"
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm transition-all"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4"/>
                </svg>
                <span>{{ __('សាខា & ផ្នែកមន្ទីរពេទ្យ') }}</span>
            </button>
        </div>

        <!-- Main Form Container -->
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Tab 1: Hospital Profile -->
            <div x-show="activeTab === 'general'" class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6 shadow-2xs" x-cloak>
                <div class="border-b border-slate-100 pb-4">
                    <h3 class="font-bold text-lg text-slate-800">{{ __('ព័ត៌មានទូទៅមន្ទីរពេទ្យ (Hospital Information)') }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ __('ព័ត៌មាននេះនឹងត្រូវបង្ហាញលើរបាយការណ៍ និងវិក្កយបត្ររបស់មន្ទីរពេទ្យ') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('ឈ្មោះមន្ទីរពេទ្យ (Hospital Name)') }} <span class="text-rose-500">*</span></label>
                        <input type="text" name="hospital_name" value="{{ old('hospital_name', $settings['hospital_name']) }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('លេខទូរស័ព្ទទំនាក់ទំនង (Phone Number)') }}</label>
                        <input type="text" name="hospital_phone" value="{{ old('hospital_phone', $settings['hospital_phone']) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('អ៊ីមែលមន្ទីរពេទ្យ (Hospital Email)') }}</label>
                        <input type="email" name="hospital_email" value="{{ old('hospital_email', $settings['hospital_email']) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('លេខទូរស័ព្ទសង្គ្រោះបន្ទាន់ (Emergency Line 24/7)') }}</label>
                        <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $settings['emergency_contact']) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('អាសយដ្ឋានផ្លូវការ (Official Address)') }}</label>
                        <textarea name="hospital_address" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ old('hospital_address', $settings['hospital_address']) }}</textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-semibold text-sm rounded-xl shadow-xs transition-colors">
                        {{ __('រក្សាទុកការកំណត់') }}
                    </button>
                </div>
            </div>

            <!-- Tab 2: Financial & Invoice Settings -->
            <div x-show="activeTab === 'financial'" class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6 shadow-2xs" x-cloak>
                <div class="border-b border-slate-100 pb-4">
                    <h3 class="font-bold text-lg text-slate-800">{{ __('ការកំណត់វិក្កយបត្រ & ហិរញ្ញវត្ថុ (Invoice & Financial)') }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ __('កំណត់រូបិយប័ណ្ណទូទាត់ អត្រាប្តូរប្រាក់ និងព័ត៌មានលើវិក្កយបត្រ') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('រូបិយប័ណ្ណចម្បង (Currency Symbol)') }}</label>
                        <select name="currency_symbol" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            <option value="$" {{ $settings['currency_symbol'] == '$' ? 'selected' : '' }}>USD ($)</option>
                            <option value="៛" {{ $settings['currency_symbol'] == '៛' ? 'selected' : '' }}>KHR (៛)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('អត្រាប្តូរប្រាក់រៀល (1 USD = KHR)') }}</label>
                        <input type="number" name="exchange_rate" value="{{ old('exchange_rate', $settings['exchange_rate']) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:bg-white focus:border-teal-600 outline-none" placeholder="4100">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('ភាគរយអាករ (Tax / VAT %)') }}</label>
                        <input type="number" step="0.1" name="tax_percentage" value="{{ old('tax_percentage', $settings['tax_percentage']) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:bg-white focus:border-teal-600 outline-none" placeholder="0">
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('សារកំណត់ត្រាក្រោមវិក្កយបត្រ (Invoice Footer Note)') }}</label>
                        <textarea name="invoice_footer_note" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ old('invoice_footer_note', $settings['invoice_footer_note']) }}</textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-semibold text-sm rounded-xl shadow-xs transition-colors">
                        {{ __('រក្សាទុកការកំណត់') }}
                    </button>
                </div>
            </div>

            <!-- Tab 3: System Notification Preferences -->
            <div x-show="activeTab === 'notifications'" class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6 shadow-2xs" x-cloak>
                <div class="border-b border-slate-100 pb-4">
                    <h3 class="font-bold text-lg text-slate-800">{{ __('ការកំណត់ការជូនដំណឹងប្រព័ន្ធ (Notification Preferences)') }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ __('បើក ឬ បិទ ការជូនដំណឹងស្វ័យប្រវត្តិនានានៅលើ Top Bar') }}</p>
                </div>

                <div class="space-y-4">
                    <label class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-2xl hover:bg-slate-100/80 transition-colors cursor-pointer">
                        <div class="space-y-0.5">
                            <span class="text-sm font-bold text-slate-800">{{ __('ការជូនដំណឹងកាលវិភាគវះកាត់ (Surgery Schedule Alerts)') }}</span>
                            <p class="text-xs text-slate-500">{{ __('ជូនដំណឹងនៅពេលមានការវះកាត់ជិតដល់ម៉ោងប្រចាំថ្ងៃ') }}</p>
                        </div>
                        <input type="checkbox" name="enable_surgery_alerts" value="1" {{ $settings['enable_surgery_alerts'] == '1' ? 'checked' : '' }} class="w-5 h-5 text-teal-600 rounded-md border-slate-300 focus:ring-teal-500">
                    </label>

                    <label class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-2xl hover:bg-slate-100/80 transition-colors cursor-pointer">
                        <div class="space-y-0.5">
                            <span class="text-sm font-bold text-slate-800">{{ __('ការជូនដំណឹងប្រគល់-ទទួលវេន (Shift Handover Alerts)') }}</span>
                            <p class="text-xs text-slate-500">{{ __('ជូនដំណឹងនៅពេលគ្រូពេទ្យ/គិលានុបដ្ឋាយិកាផ្ញើរបាយការណ៍ប្រគល់វេន') }}</p>
                        </div>
                        <input type="checkbox" name="enable_handover_alerts" value="1" {{ $settings['enable_handover_alerts'] == '1' ? 'checked' : '' }} class="w-5 h-5 text-teal-600 rounded-md border-slate-300 focus:ring-teal-500">
                    </label>

                    <label class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-2xl hover:bg-slate-100/80 transition-colors cursor-pointer">
                        <div class="space-y-0.5">
                            <span class="text-sm font-bold text-slate-800">{{ __('ការជូនដំណឹងឧបករណ៍ពេទ្យ (Equipment Status Alerts)') }}</span>
                            <p class="text-xs text-slate-500">{{ __('ជូនដំណឹងនៅពេលឧបករណ៍ពេទ្យត្រូវពិនិត្យ ឬ ថែទាំ') }}</p>
                        </div>
                        <input type="checkbox" name="enable_equipment_alerts" value="1" {{ $settings['enable_equipment_alerts'] == '1' ? 'checked' : '' }} class="w-5 h-5 text-teal-600 rounded-md border-slate-300 focus:ring-teal-500">
                    </label>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-semibold text-sm rounded-xl shadow-xs transition-colors">
                        {{ __('រក្សាទុកការកំណត់') }}
                    </button>
                </div>
            </div>
        </form>

        <!-- Tab 4: Hospital Branches & Departments Overview -->
        <div x-show="activeTab === 'branches'" class="space-y-6" x-cloak>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6 shadow-2xs">
                <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800">{{ __('សាខាមន្ទីរពេទ្យ (Registered Hospital Branches)') }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('បញ្ជីសាខាដែលបានចុះឈ្មោះក្នុងប្រព័ន្ធ') }}</p>
                    </div>
                    <span class="px-3 py-1 bg-teal-50 text-teal-700 text-xs font-bold rounded-lg border border-teal-200">
                        {{ __('សរុប') }} {{ count($branches) }} {{ __('សាខា') }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($branches as $branch)
                    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50/50 hover:border-teal-300 transition-colors space-y-2">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-slate-800 text-base">{{ $branch->name }}</h4>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        </div>
                        <p class="text-xs text-slate-600 font-mono">📍 {{ __('ទីតាំង') }}៖ {{ $branch->location }}</p>
                        <p class="text-xs text-slate-600 font-mono">📞 {{ __('ទំនាក់ទំនង') }}៖ {{ $branch->contact_number }}</p>
                        <div class="pt-2 border-t border-slate-200/80 flex items-center justify-between text-xs text-slate-500">
                            <span>{{ __('ចំនួនផ្នែក') }}៖ {{ count($branch->departments) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6 shadow-2xs">
                <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800">{{ __('ផ្នែកជំនាញមន្ទីរពេទ្យ (Hospital Departments)') }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('បញ្ជីផ្នែក ឬ ជំនាញវេជ្ជសាស្ត្រដែលកំពុងដំណើការ') }}</p>
                    </div>
                    <span class="px-3 py-1 bg-teal-50 text-teal-700 text-xs font-bold rounded-lg border border-teal-200">
                        {{ __('សរុប') }} {{ count($departments) }} {{ __('ផ្នែក') }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($departments as $dept)
                    <div class="p-4 rounded-xl border border-slate-200 bg-white space-y-1.5">
                        <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center font-bold text-sm">
                            🏥
                        </div>
                        <h5 class="font-bold text-slate-800 text-sm mt-2">{{ $dept->name }}</h5>
                        <p class="text-[11px] text-slate-500 line-clamp-2">{{ $dept->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
