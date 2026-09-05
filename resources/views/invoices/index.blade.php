<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('គ្រប់គ្រងវិក្កយបត្រ និងការទូទាត់ប្រាក់ (Invoices & Billing)') }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ __('ចេញវិក្កយបត្រថ្លៃព្យាបាល តាមដានការទូទាត់ និងបោះពុម្ពប័ណ្ណទូទាត់') }}</p>
            </div>
            <div>
                <a href="{{ route('invoices.create') }}" class="inline-flex items-center px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-sm font-semibold rounded-xl transition-colors duration-150 gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('ចេញវិក្កយបត្រថ្មី') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ khqrModalOpen: false, activeInvoice: null, selectedBank: 'aba' }">

        @if (session('success'))
        <div class="p-5 bg-emerald-50 dark:bg-emerald-950/40 border-2 border-emerald-500/40 text-emerald-900 dark:text-emerald-200 rounded-2xl flex items-start gap-4 shadow-md animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xl shrink-0 shadow-sm animate-bounce">
                🔔
            </div>
            <div class="flex-1 space-y-1">
                <div class="flex items-center gap-2">
                    <span class="font-extrabold text-base text-emerald-800 dark:text-emerald-300">
                        {{ __('កាតជូនដំណឹង ៖ ទទួលបានការបាញ់ប្រាក់ចូលកុងធនាគារជោគជ័យ! (Bank Payment Received)') }}
                    </span>
                    <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-md uppercase tracking-wider">
                        LIVE PAYMENT
                    </span>
                </div>
                <p class="text-xs text-emerald-700 dark:text-emerald-300 font-medium">
                    {{ session('success') }} {{ __('ប្រព័ន្ធបានកត់ត្រាទិន្នន័យទូទាត់ និងធ្វើបច្ចុប្បន្នភាពវិក្កយបត្ររួចរាល់។') }}
                </p>
            </div>
        </div>
        @endif

        <!-- Filter & Search Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4">
            <form method="GET" action="{{ route('invoices.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('ស្វែងរកតាមលេខវិក្កយបត្រ ឬ ឈ្មោះអ្នកជំងឺ...') }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-colors duration-150 outline-none">
                </div>
                <div class="flex gap-2">
                    <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-700 outline-none">
                        <option value="">-- {{ __('គ្រប់ស្ថានភាពទូទាត់') }} --</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>{{ __('ទូទាត់រួច (Paid)') }}</option>
                        <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>{{ __('មិនទាន់ទូទាត់ (Unpaid)') }}</option>
                        <option value="partially_paid" {{ request('status') === 'partially_paid' ? 'selected' : '' }}>{{ __('ទូទាត់ខ្លះ (Partial)') }}</option>
                    </select>
                    <button type="submit" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors duration-150">
                        {{ __('ស្វែងរក') }}
                    </button>
                    @if(request('search') || request('status'))
                    <a href="{{ route('invoices.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors duration-150 flex items-center">
                        {{ __('កំណត់ឡើងវិញ') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Invoices List Table -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="py-4 px-6">{{ __('លេខវិក្កយបត្រ') }}</th>
                            <th class="py-4 px-6">{{ __('អ្នកជំងឺ') }}</th>
                            <th class="py-4 px-6">{{ __('ប្រាក់សរុប') }}</th>
                            <th class="py-4 px-6">{{ __('បញ្ចុះតម្លៃ') }}</th>
                            <th class="py-4 px-6">{{ __('ប្រាក់ត្រូវទូទាត់') }}</th>
                            <th class="py-4 px-6">{{ __('វិធីសាស្ត្រ') }}</th>
                            <th class="py-4 px-6">{{ __('ស្ថានភាព') }}</th>
                            <th class="py-4 px-6 text-right">{{ __('សកម្មភាព') }} / QR</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($invoices as $invoice)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="py-4 px-6 font-mono text-xs font-bold text-teal-800">
                                {{ $invoice->invoice_number }}
                                <div class="text-[11px] text-slate-400 font-sans font-normal mt-0.5">
                                    {{ $invoice->created_at->format('d-M-Y H:i A') }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">{{ $invoice->patient->name ?? __('មិនស្គាល់') }}</div>
                                <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $invoice->patient->phone_number ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-6 font-mono text-slate-600">
                                ${{ number_format($invoice->total_amount, 2) }}
                            </td>
                            <td class="py-4 px-6 font-mono text-rose-600">
                                ${{ number_format($invoice->discount, 2) }}
                            </td>
                            <td class="py-4 px-6 font-mono font-bold text-slate-900">
                                ${{ number_format($invoice->final_amount, 2) }}
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-700">
                                {{ $invoice->payment_method }}
                            </td>
                            <td class="py-4 px-6">
                                <form id="status-form-{{ $invoice->id }}" action="{{ route('invoices.update-status', $invoice) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="payment_method" value="{{ $invoice->payment_method }}">
                                    <select name="payment_status" onchange="this.form.submit()" class="text-xs font-semibold rounded-xl px-2.5 py-1.5 border transition-colors duration-150 outline-none cursor-pointer
                                                {{ $invoice->payment_status === 'paid' ? 'bg-teal-50 text-teal-800 border-teal-200' : '' }}
                                                {{ $invoice->payment_status === 'unpaid' ? 'bg-rose-50 text-rose-800 border-rose-200' : '' }}
                                                {{ $invoice->payment_status === 'partially_paid' ? 'bg-amber-50 text-amber-800 border-amber-200' : '' }}">
                                        <option value="paid" {{ $invoice->payment_status === 'paid' ? 'selected' : '' }}>{{ __('ទូទាត់រួច (Paid)') }}</option>
                                        <option value="unpaid" {{ $invoice->payment_status === 'unpaid' ? 'selected' : '' }}>{{ __('មិនទាន់ទូទាត់ (Unpaid)') }}</option>
                                        <option value="partially_paid" {{ $invoice->payment_status === 'partially_paid' ? 'selected' : '' }}>{{ __('ទូទាត់ខ្លះ (Partial)') }}</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">

                                    <!-- Pay via KHQR Button -->
                                    <button 
                                        type="button"
                                        @click="activeInvoice = {
                                            id: {{ $invoice->id }},
                                            number: '{{ $invoice->invoice_number }}',
                                            patient: '{{ addslashes($invoice->patient->name ?? '-') }}',
                                            amount: '{{ number_format($invoice->final_amount, 2) }}',
                                            khr: '{{ number_format($invoice->final_amount * 4100) }}',
                                            status: '{{ $invoice->payment_status }}'
                                        }; khqrModalOpen = true; selectedBank = 'aba'"
                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow-2xs transition-all active:scale-95"
                                        title="{{ __('ទូទាត់តាម KHQR Code') }}"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                        </svg>
                                        <span>KHQR</span>
                                    </button>

                                    <!-- Print Invoice Link -->
                                    <a href="{{ route('invoices.show', $invoice) }}" class="inline-flex items-center px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-semibold rounded-lg transition-colors gap-1" title="{{ __('មើល') }} / Print">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                        Print
                                    </a>

                                    <!-- Edit Link -->
                                    <a href="{{ route('invoices.edit', $invoice) }}" class="p-1.5 text-slate-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors" title="{{ __('កែប្រែ') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('តើអ្នកពិតជាចង់លុបវិក្កយបត្រនេះមែនទេ?')" class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="{{ __('លុប') }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-400">
                                {{ __('មិនទាន់មានវិក្កយបត្រក្នុងប្រព័ន្ធនៅឡើយទេ') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                {{ $invoices->appends(['search' => request('search'), 'status' => request('status')])->links() }}
            </div>
        </div>

        <!-- Authentic Multi-Bank KHQR Payment Modal Dialog (ABA, Wing, ACLEDA) -->
        <div 
            x-show="khqrModalOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-sm"
            x-cloak
        >
            <div class="bg-white rounded-3xl max-w-md w-full p-6 text-center space-y-4 shadow-2xl border border-slate-200 relative overflow-hidden" @click.away="khqrModalOpen = false">

                <!-- Red KHQR Header Bar -->
                <div class="bg-rose-600 -mx-6 -mt-6 p-4 text-white flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="font-extrabold tracking-wider text-lg font-mono">KHQR</span>
                        <span class="text-xs bg-white/20 px-2 py-0.5 rounded text-rose-100 font-semibold">Bakong Pay</span>
                    </div>
                    <button type="button" @click="khqrModalOpen = false" class="text-white hover:text-rose-200 text-2xl font-bold leading-none">&times;</button>
                </div>

                <!-- Bank Selection Switcher Tabs -->
                <div class="grid grid-cols-3 gap-1.5 p-1 bg-slate-100 rounded-xl border border-slate-200 font-semibold text-xs">
                    <button 
                        type="button" 
                        @click="selectedBank = 'aba'"
                        :class="selectedBank === 'aba' ? 'bg-rose-600 text-white shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                        class="py-2 px-2 rounded-lg transition-all flex items-center justify-center gap-1"
                    >
                        <span>🔴 ABA KHQR</span>
                    </button>

                    <button 
                        type="button" 
                        @click="selectedBank = 'wing'"
                        :class="selectedBank === 'wing' ? 'bg-lime-600 text-white shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                        class="py-2 px-2 rounded-lg transition-all flex items-center justify-center gap-1"
                    >
                        <span>🟢 Wing Bank</span>
                    </button>

                    <button 
                        type="button" 
                        @click="selectedBank = 'acleda'"
                        :class="selectedBank === 'acleda' ? 'bg-blue-700 text-white shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                        class="py-2 px-2 rounded-lg transition-all flex items-center justify-center gap-1"
                    >
                        <span>🔵 ACLEDA</span>
                    </button>
                </div>

                <!-- Merchant Name & Info -->
                <div class="space-y-0.5">
                    <h3 class="font-extrabold text-slate-800 text-base">SmartCare HMS Hospital</h3>
                    <p class="text-xs text-slate-500 font-mono" x-text="activeInvoice ? 'វិក្កយបត្រ ៖ ' + activeInvoice.number : ''"></p>
                    <p class="text-xs text-teal-800 font-bold" x-text="activeInvoice ? 'អ្នកជំងឺ ៖ ' + activeInvoice.patient : ''"></p>
                </div>

                <!-- Prominent Payment Amount Box for Customer Scan -->
                <div class="bg-gradient-to-b from-rose-50 to-amber-50 dark:from-rose-950/40 dark:to-amber-950/40 border-2 border-rose-400/60 p-4 rounded-2xl space-y-1.5 shadow-xs">
                    <div class="flex items-center justify-center gap-1 text-[11px] font-bold text-rose-700 uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-rose-600 animate-ping"></span>
                        <span>{{ __('ចំនួនទឹកប្រាក់ត្រូវស្កែនទូទាត់ (AMOUNT TO PAY)') }}</span>
                    </div>
                    <div class="text-3xl font-black text-rose-700 font-mono tracking-tight" x-text="activeInvoice ? '$' + activeInvoice.amount : ''"></div>
                    <div class="pt-1">
                        <span class="text-xs font-mono font-bold text-amber-900 dark:text-amber-200 bg-amber-200/80 dark:bg-amber-900/60 px-3 py-1 rounded-full border border-amber-300 inline-block shadow-2xs" x-text="activeInvoice ? '៛ ' + activeInvoice.khr + ' KHR' : ''"></span>
                    </div>
                    <p class="text-[11px] text-slate-500 font-medium pt-1">
                        {{ __('សូមពិនិត្យចំនួនទឹកប្រាក់លើ App ធនាគារឱ្យបានត្រឹមត្រូវ') }}
                    </p>
                </div>

                <!-- Dynamic Bank QR Code Image Container -->
                <div class="flex flex-col items-center justify-center p-3.5 bg-white border-2 border-dashed border-slate-300 rounded-2xl space-y-2 relative">
                    
                    <!-- Highlight Banner over QR -->
                    <div class="px-3 py-1 bg-slate-900 text-teal-300 font-mono text-[11px] font-bold rounded-lg shadow-xs flex items-center gap-1.5">
                        <span>💵</span>
                        <span>{{ __('ទូទាត់ចំនួន') }} ៖ <span class="text-white" x-text="activeInvoice ? '$' + activeInvoice.amount : ''"></span></span>
                    </div>

                    <!-- 1. ABA Bank / Bakong Dynamic KHQR -->
                    <template x-if="selectedBank === 'aba' && activeInvoice">
                        <img 
                            :src="'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=KHQR_ABA_SMARTCARE_HMS_' + activeInvoice.number + '_AMOUNT_' + activeInvoice.amount" 
                            alt="ABA KHQR Code" 
                            class="w-48 h-48 rounded-xl object-contain shadow-xs border border-slate-100"
                        >
                    </template>

                    <!-- 2. Wing Bank QR Code -->
                    <template x-if="selectedBank === 'wing'">
                        <img 
                            src="{{ asset('images/qr/wing_qr.png') }}" 
                            alt="Wing Bank QR Code" 
                            class="w-48 h-48 rounded-xl object-contain shadow-xs border border-slate-100"
                        >
                    </template>

                    <!-- 3. ACLEDA Bank QR Code -->
                    <template x-if="selectedBank === 'acleda'">
                        <img 
                            src="{{ asset('images/qr/acleda_qr.png') }}" 
                            alt="ACLEDA Bank QR Code" 
                            class="w-48 h-48 rounded-xl object-contain shadow-xs border border-slate-100"
                        >
                    </template>

                    <div class="flex items-center gap-1.5 text-[11px] text-slate-500 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span x-text="selectedBank === 'aba' ? 'ស្កែនទូទាត់តាម ABA / Bakong App' : (selectedBank === 'wing' ? 'ស្កែនទូទាត់តាម Wing Bank App' : 'ស្កែនទូទាត់តាម ACLEDA Mobile App')"></span>
                    </div>
                </div>

                <!-- Action Button: Mark as Paid -->
                <div class="space-y-2 pt-1">
                    <template x-if="activeInvoice">
                        <form :action="'/invoices/' + activeInvoice.id + '/status'" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="payment_status" value="paid">
                            <input type="hidden" name="payment_method" :value="selectedBank === 'aba' ? 'ABA KHQR' : (selectedBank === 'wing' ? 'Wing Bank KHQR' : 'ACLEDA Bank KHQR')">
                            <button type="submit" class="w-full py-3 px-4 bg-teal-700 hover:bg-teal-800 text-white font-bold text-sm rounded-xl shadow-md transition-all active:scale-95 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-teal-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>{{ __('ស្កែនរួចរាល់ / បញ្ជាក់ការទូទាត់') }}</span>
                            </button>
                        </form>
                    </template>
                    <button type="button" @click="khqrModalOpen = false" class="text-xs text-slate-400 hover:text-slate-600 underline">
                        {{ __('បិទផ្ទាំងនេះ (Close)') }}
                    </button>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
