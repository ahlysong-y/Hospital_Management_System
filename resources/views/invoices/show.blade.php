<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between no-print" x-data="{ showKhqrModal: false, selectedBank: 'aba' }">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('វិក្កយបត្រលេខ ៖ ') }} <span class="font-mono text-teal-800">{{ $invoice->invoice_number }}</span>
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ប័ណ្ណទូទាត់ប្រាក់ផ្លូវការរបស់មន្ទីរពេទ្យ SmartCare HMS</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- KHQR Payment Button -->
                <button type="button" @click="showKhqrModal = true" class="inline-flex items-center px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold rounded-xl transition-all shadow-xs gap-2 active:scale-95">
                    <svg class="w-5 h-5 text-rose-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    <span>ទូទាត់តាម KHQR Code (ABA / Wing / ACLEDA)</span>
                </button>

                <a href="{{ route('invoices.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                    ត្រឡប់ក្រោយ
                </a>

                <button onclick="window.print()" class="inline-flex items-center px-5 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-sm font-semibold rounded-xl transition-colors gap-2 shadow-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    បោះពុម្ពវិក្កយបត្រ / Save PDF
                </button>
            </div>

            <!-- Multi-Bank KHQR Code Payment Modal inside Header -->
            <div 
                x-show="showKhqrModal" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-sm"
                x-cloak
            >
                <div class="bg-white rounded-3xl max-w-md w-full p-6 text-center space-y-4 shadow-2xl border border-slate-200 relative overflow-hidden" @click.away="showKhqrModal = false">
                    <!-- Red KHQR Header Bar -->
                    <div class="bg-rose-600 -mx-6 -mt-6 p-4 text-white flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="font-extrabold tracking-wider text-lg font-mono">KHQR</span>
                            <span class="text-xs bg-white/20 px-2 py-0.5 rounded text-rose-100 font-semibold">Bakong Pay</span>
                        </div>
                        <button type="button" @click="showKhqrModal = false" class="text-white hover:text-rose-200 text-2xl font-bold leading-none">&times;</button>
                    </div>

                    <!-- Bank Switcher Tabs -->
                    <div class="grid grid-cols-3 gap-1.5 p-1 bg-slate-100 rounded-xl border border-slate-200 font-semibold text-xs">
                        <button 
                            type="button" 
                            @click="selectedBank = 'aba'"
                            :class="selectedBank === 'aba' ? 'bg-rose-600 text-white shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="py-2 px-2 rounded-lg transition-all flex items-center justify-center gap-1"
                        >
                            <span>🔴 ABA</span>
                        </button>

                        <button 
                            type="button" 
                            @click="selectedBank = 'wing'"
                            :class="selectedBank === 'wing' ? 'bg-lime-600 text-white shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="py-2 px-2 rounded-lg transition-all flex items-center justify-center gap-1"
                        >
                            <span>🟢 Wing</span>
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

                    <!-- Merchant Info -->
                    <div class="space-y-0.5">
                        <h3 class="font-extrabold text-slate-800 text-base">SmartCare HMS Hospital</h3>
                        <p class="text-xs text-slate-500 font-mono">វិក្កយបត្រ ៖ #{{ $invoice->invoice_number }}</p>
                        <p class="text-xs text-teal-800 font-bold">អ្នកជំងឺ ៖ {{ $invoice->patient->name ?? '-' }}</p>
                    </div>

                    <!-- Prominent Payment Amount Box for Customer Scan -->
                    <div class="bg-gradient-to-b from-rose-50 to-amber-50 border-2 border-rose-400/60 p-4 rounded-2xl space-y-1.5 shadow-xs">
                        <div class="flex items-center justify-center gap-1 text-[11px] font-bold text-rose-700 uppercase tracking-wider">
                            <span class="w-2 h-2 rounded-full bg-rose-600 animate-ping"></span>
                            <span>ចំនួនទឹកប្រាក់ត្រូវស្កែនទូទាត់ (AMOUNT TO PAY)</span>
                        </div>
                        <div class="text-3xl font-black text-rose-700 font-mono tracking-tight">${{ number_format($invoice->final_amount, 2) }}</div>
                        <div class="pt-1">
                            <span class="text-xs font-mono font-bold text-amber-900 bg-amber-200/80 px-3 py-1 rounded-full border border-amber-300 inline-block shadow-2xs">៛ {{ number_format($invoice->final_amount * 4100) }} KHR</span>
                        </div>
                        <p class="text-[11px] text-slate-500 font-medium pt-1">
                            សូមពិនិត្យចំនួនទឹកប្រាក់លើ App ធនាគារឱ្យបានត្រឹមត្រូវ
                        </p>
                    </div>

                    <!-- Dynamic Bank QR Code Image Container -->
                    <div class="flex flex-col items-center justify-center p-3.5 bg-white border-2 border-dashed border-slate-300 rounded-2xl space-y-2 relative">
                        
                        <!-- Highlight Banner over QR -->
                        <div class="px-3 py-1 bg-slate-900 text-teal-300 font-mono text-[11px] font-bold rounded-lg shadow-xs flex items-center gap-1.5">
                            <span>💵</span>
                            <span>ទូទាត់ចំនួន ៖ <span class="text-white">${{ number_format($invoice->final_amount, 2) }}</span></span>
                        </div>

                        <!-- 1. ABA Bank QR -->
                        <template x-if="selectedBank === 'aba'">
                            <img 
                                src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=KHQR_ABA_SMARTCARE_HMS_{{ $invoice->invoice_number }}_AMOUNT_{{ $invoice->final_amount }}" 
                                alt="ABA KHQR Code" 
                                class="w-48 h-48 rounded-xl object-contain shadow-xs border border-slate-100"
                            >
                        </template>

                        <!-- 2. Wing Bank QR -->
                        <template x-if="selectedBank === 'wing'">
                            <img 
                                src="{{ asset('images/qr/wing_qr.png') }}" 
                                alt="Wing Bank QR Code" 
                                class="w-48 h-48 rounded-xl object-contain shadow-xs border border-slate-100"
                            >
                        </template>

                        <!-- 3. ACLEDA Bank QR -->
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

                    <!-- Confirm Payment Action -->
                    <div class="space-y-2 pt-1">
                        <form action="{{ route('invoices.update-status', $invoice) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="payment_status" value="paid">
                            <input type="hidden" name="payment_method" :value="selectedBank === 'aba' ? 'ABA KHQR' : (selectedBank === 'wing' ? 'Wing Bank KHQR' : 'ACLEDA Bank KHQR')">
                            <button type="submit" class="w-full py-3 px-4 bg-teal-700 hover:bg-teal-800 text-white font-bold text-sm rounded-xl shadow-md transition-all active:scale-95 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-teal-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>ស្កែនរួចរាល់ / បញ្ជាក់ការទូទាត់</span>
                            </button>
                        </form>
                        <button type="button" @click="showKhqrModal = false" class="text-xs text-slate-400 hover:text-slate-600 underline">
                            បិទផ្ទាំងនេះ (Close)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ showKhqrModal: false, selectedBank: 'aba' }">

        @if (session('success'))
        <div class="p-5 bg-emerald-50 border-2 border-emerald-500/40 text-emerald-900 rounded-2xl flex items-start gap-4 shadow-md no-print animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xl shrink-0 shadow-sm animate-bounce">
                🔔
            </div>
            <div class="flex-1 space-y-1">
                <div class="flex items-center gap-2">
                    <span class="font-extrabold text-base text-emerald-800">
                        {{ __('កាតជូនដំណឹង ៖ ទទួលបានការបាញ់ប្រាក់ចូលកុងធនាគារជោគជ័យ! (Bank Payment Received)') }}
                    </span>
                    <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-md uppercase tracking-wider">
                        LIVE PAYMENT
                    </span>
                </div>
                <p class="text-xs text-emerald-700 font-medium">
                    {{ session('success') }} {{ __('ប្រព័ន្ធបានកត់ត្រាទិន្នន័យទូទាត់ និងធ្វើបច្ចុប្បន្នភាពវិក្កយបត្ររួចរាល់។') }}
                </p>
            </div>
        </div>
        @endif

        <!-- Printable Invoice Container -->
        <div id="invoice-receipt" class="bg-white rounded-2xl border border-slate-200 p-8 shadow-xs space-y-8">

            <!-- Hospital Header -->
            <div class="flex justify-between items-start border-b border-slate-200 pb-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-teal-700 text-white flex items-center justify-center font-bold text-2xl">
                        S
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">មន្ទីរពេទ្យស្មាតឃែរ SmartCare HMS</h1>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $invoice->branch->name ?? 'សាខាកណ្តាល' }}</p>
                        <p class="text-xs text-slate-400">ទូរស័ព្ទ៖ {{ $invoice->branch->contact_number ?? '023 888 999' }} | អាសយដ្ឋាន៖ {{ $invoice->branch->location ?? 'រាជធានីភ្នំពេញ' }}</p>
                    </div>
                </div>

                <div class="text-right">
                    <h2 class="text-2xl font-bold text-teal-800 tracking-tight uppercase">វិក្កយបត្រ / INVOICE</h2>
                    <p class="text-sm font-mono font-bold text-slate-800 mt-1">#{{ $invoice->invoice_number }}</p>
                    <p class="text-xs text-slate-500 mt-1">កាលបរិច្ឆេទ៖ {{ $invoice->created_at->format('d-M-Y H:i A') }}</p>
                </div>
            </div>

            <!-- Patient & Info Grid -->
            <div class="grid grid-cols-2 gap-6 bg-slate-50 p-5 rounded-xl border border-slate-200">
                <div>
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ព័ត៌មានអ្នកជំងឺ (Patient Details)</h4>
                    <p class="font-bold text-slate-800 text-base">{{ $invoice->patient->name ?? 'មិនស្គាល់' }}</p>
                    <p class="text-xs text-slate-600 mt-1">ភេទ៖ {{ $invoice->patient->gender === 'male' ? 'ប្រុស' : ($invoice->patient->gender === 'female' ? 'ស្រី' : 'ផ្សេងៗ') }}</p>
                    <p class="text-xs text-slate-600 mt-0.5 font-mono">ទូរស័ព្ទ៖ {{ $invoice->patient->phone_number ?? '-' }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">អាសយដ្ឋាន៖ {{ $invoice->patient->address ?? 'គ្មាន' }}</p>
                </div>

                <div class="text-right">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ព័ត៌មានការទូទាត់ (Payment Summary)</h4>
                    <div class="inline-block">
                        @if($invoice->payment_status === 'paid')
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-teal-100 text-teal-800 border border-teal-200">
                            ✓ ទូទាត់រួចរាល់ (PAID)
                        </span>
                        @elseif($invoice->payment_status === 'unpaid')
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                            ✕ មិនទាន់ទូទាត់ (UNPAID)
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                            ⚠ ទូទាត់ខ្លះ (PARTIAL)
                        </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-600 mt-2">វិធីសាស្ត្រទូទាត់៖ <span class="font-semibold">{{ $invoice->payment_method }}</span></p>
                    
                    <!-- Quick KHQR Button inside Receipt -->
                    @if($invoice->payment_status !== 'paid')
                    <div class="mt-2 no-print">
                        <button type="button" @click="showKhqrModal = true" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-lg shadow-xs transition-all active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                            <span>ទូទាត់តាម KHQR (ABA / Wing / ACLEDA)</span>
                        </button>
                    </div>
                    @endif

                    @if($invoice->medicalRecord)
                    <p class="text-xs text-slate-500 mt-1">គ្រូពេទ្យទទួលបន្ទុក៖ {{ $invoice->medicalRecord->doctor->name ?? '-' }}</p>
                    @endif
                </div>
            </div>

            <!-- Itemized Table -->
            <div>
                <table class="w-full text-left border-collapse border border-slate-200 rounded-xl overflow-hidden">
                    <thead>
                        <tr class="bg-slate-100 border-b border-slate-200 text-xs font-bold text-slate-700 uppercase">
                            <th class="py-3 px-4">ល.រ</th>
                            <th class="py-3 px-4">ការពិពណ៌នា / សេវាព្យាបាល</th>
                            <th class="py-3 px-4 text-right">ចំនួនប្រាក់ ($)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm">
                        <tr>
                            <td class="py-3.5 px-4 font-mono text-xs text-slate-500">01</td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-slate-800">សេវាពិគ្រោះ និងព្យាបាលជំងឺ (OPD / Consultation)</div>
                                @if($invoice->notes)
                                <div class="text-xs text-slate-500 mt-0.5">{{ $invoice->notes }}</div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right font-mono font-medium text-slate-800">
                                ${{ number_format($invoice->total_amount, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Totals Calculation Box & 3 Bank QR Code Stamps -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
                <!-- Multi-Bank QR Codes Printable Stamps -->
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-2 p-2 bg-slate-50 rounded-xl border border-slate-200">
                        <img 
                            src="{{ asset('images/qr/wing_qr.png') }}" 
                            alt="Wing Bank QR" 
                            class="w-12 h-12 rounded object-contain border border-slate-200 bg-white"
                        >
                        <div class="text-[10px]">
                            <p class="font-bold text-slate-800">Wing Bank KHQR</p>
                            <p class="text-slate-500">ស្កែនទូទាត់ប្រាក់</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 p-2 bg-slate-50 rounded-xl border border-slate-200">
                        <img 
                            src="{{ asset('images/qr/acleda_qr.png') }}" 
                            alt="ACLEDA Bank QR" 
                            class="w-12 h-12 rounded object-contain border border-slate-200 bg-white"
                        >
                        <div class="text-[10px]">
                            <p class="font-bold text-slate-800">ACLEDA KHQR</p>
                            <p class="text-slate-500">ស្កែនទូទាត់ប្រាក់</p>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-72 bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2 text-sm">
                    <div class="flex justify-between text-slate-600">
                        <span>សរុបដើម (Subtotal) ៖</span>
                        <span class="font-mono">${{ number_format($invoice->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-rose-600">
                        <span>បញ្ចុះតម្លៃ (Discount) ៖</span>
                        <span class="font-mono">-${{ number_format($invoice->discount, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-slate-900 pt-2 border-t border-slate-200 text-base">
                        <span>ប្រាក់ត្រូវទូទាត់ (Total) ៖</span>
                        <span class="font-mono text-teal-800">${{ number_format($invoice->final_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Signatures Section -->
            <div class="grid grid-cols-2 gap-8 pt-12 text-center text-xs text-slate-600">
                <div>
                    <p class="font-bold text-slate-800">ហត្ថលេខាអ្នកជំងឺ / Patient Signature</p>
                    <div class="h-16"></div>
                    <p class="text-slate-400">....................................................</p>
                </div>
                <div>
                    <p class="font-bold text-slate-800">ហត្ថលេខាបុគ្គលិកបេឡា / Cashier Signature</p>
                    <div class="h-16"></div>
                    <p class="text-slate-400 font-semibold">{{ Auth::user()->name ?? 'មន្ត្រីបេឡា' }}</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Printable Style Overrides -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #invoice-receipt, #invoice-receipt * {
                visibility: visible;
            }
            #invoice-receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
            .no-print, header, nav {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
