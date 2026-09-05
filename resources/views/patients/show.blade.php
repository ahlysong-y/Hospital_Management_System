<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ព័ត៌មានលម្អិតអ្នកជំងឺ ៖ ') }} <span class="text-teal-800">{{ $patient->name }}</span>
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ព័ត៌មានផ្ទាល់ខ្លួន ប្រវត្តិពិគ្រោះ OPD ការវះកាត់ និងការទូទាត់ប្រាក់</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('patients.edit', $patient) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors">
                    កែប្រែទិន្នន័យ
                </a>
                <a href="{{ route('patients.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                    ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Patient Info Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-teal-800 border border-teal-100 flex items-center justify-center font-bold text-2xl shrink-0">
                    {{ mb_substr($patient->name, 0, 1) }}
                </div>
                <div class="flex-1 space-y-1">
                    <div class="flex flex-wrap items-center gap-3">
                        <h3 class="text-xl font-bold text-slate-800">{{ $patient->name }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                            {{ $patient->gender === 'male' ? 'ប្រុស' : ($patient->gender === 'female' ? 'ស្រី' : 'ផ្សេងៗ') }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-teal-50 text-teal-800 border border-teal-100">
                            {{ $patient->branch->name ?? 'សាខាមិនទាន់រៀបចំ' }}
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-4 text-xs text-slate-500 font-mono">
                        <span>ថ្ងៃកំណើត ៖ {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d-M-Y') : 'មិនបានបញ្ជាក់' }}</span>
                        <span>•</span>
                        <span>ទូរស័ព្ទ ៖ {{ $patient->phone_number ?? '-' }}</span>
                        <span>•</span>
                        <span>អាសយដ្ឋាន ៖ {{ $patient->address ?? 'គ្មានអាសយដ្ឋាន' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid for History Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- OPD Medical Records -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h4 class="font-bold text-slate-800 text-base flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        ប្រវត្តិពិគ្រោះជំងឺក្រៅ (OPD Records)
                    </h4>
                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md">{{ count($patient->medicalRecords) }} កំណត់ត្រា</span>
                </div>

                <div class="space-y-3">
                    @forelse($patient->medicalRecords as $record)
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 text-xs space-y-1.5">
                        <div class="flex items-center justify-between text-slate-500 font-mono">
                            <span>កាលបរិច្ឆេទ ៖ {{ $record->created_at->format('d-M-Y H:i A') }}</span>
                            <span class="text-teal-800 font-semibold">{{ $record->doctor->name ?? 'គ្រូពេទ្យ' }}</span>
                        </div>
                        <p class="font-bold text-slate-800 text-sm">រោគសញ្ញា ៖ {{ $record->symptoms }}</p>
                        @if($record->physical_examination)
                        <p class="text-slate-600">ពិនិត្យ ៖ {{ $record->physical_examination }}</p>
                        @endif
                        <p class="text-slate-700 font-medium">ផែនការព្យាបាល ៖ {{ $record->treatment_plan }}</p>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 py-4 text-center">គ្មានប្រវត្តិពិគ្រោះជំងឺ OPD នៅឡើយទេ</p>
                    @endforelse
                </div>
            </div>

            <!-- Surgeries History -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h4 class="font-bold text-slate-800 text-base flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L5.6 15.1a2 2 0 00-1.92 2.56l.32.96a2 2 0 001.92 1.36h12.16a2 2 0 001.92-1.36l.32-.96a2 2 0 00-.892-2.232z"></path>
                        </svg>
                        កាលវិភាគ / ប្រវត្តិវះកាត់ (Surgeries)
                    </h4>
                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md">{{ count($patient->surgeries) }} ករណី</span>
                </div>

                <div class="space-y-3">
                    @forelse($patient->surgeries as $surgery)
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 text-xs space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-slate-500">{{ \Carbon\Carbon::parse($surgery->scheduled_at)->format('d-M-Y H:i A') }}</span>
                            <span class="px-2 py-0.5 rounded-md font-semibold text-[11px]
                                {{ $surgery->status === 'completed' ? 'bg-teal-100 text-teal-800' : '' }}
                                {{ $surgery->status === 'in_progress' ? 'bg-amber-100 text-amber-800' : '' }}
                                {{ $surgery->status === 'pending' ? 'bg-slate-200 text-slate-700' : '' }}
                                {{ $surgery->status === 'cancelled' ? 'bg-rose-100 text-rose-800' : '' }}">
                                {{ $surgery->status }}
                            </span>
                        </div>
                        <p class="font-bold text-slate-800 text-sm">បន្ទប់វះកាត់ ៖ {{ $surgery->room_number }}</p>
                        <p class="text-slate-600">គ្រូពេទ្យវះកាត់ ៖ {{ $surgery->surgeon->name ?? '-' }}</p>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 py-4 text-center">គ្មានប្រវត្តិវះកាត់នៅឡើយទេ</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Invoices List for Patient -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h4 class="font-bold text-slate-800 text-base flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    ប្រវត្តិវិក្កយបត្រ និងការទូទាត់ប្រាក់ (Invoices)
                </h4>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold uppercase">
                            <th class="py-3 px-4">លេខវិក្កយបត្រ</th>
                            <th class="py-3 px-4">កាលបរិច្ឆេទ</th>
                            <th class="py-3 px-4">ប្រាក់ត្រូវទូទាត់</th>
                            <th class="py-3 px-4">វិធីសាស្ត្រ</th>
                            <th class="py-3 px-4">ស្ថានភាព</th>
                            <th class="py-3 px-4 text-right">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($invoices as $inv)
                        <tr>
                            <td class="py-3 px-4 font-mono font-bold text-teal-800">{{ $inv->invoice_number }}</td>
                            <td class="py-3 px-4 font-mono text-slate-600">{{ $inv->created_at->format('d-M-Y') }}</td>
                            <td class="py-3 px-4 font-mono font-bold text-slate-900">${{ number_format($inv->final_amount, 2) }}</td>
                            <td class="py-3 px-4 text-slate-700">{{ $inv->payment_method }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-md font-semibold text-[11px]
                                    {{ $inv->payment_status === 'paid' ? 'bg-teal-100 text-teal-800' : 'bg-rose-100 text-rose-800' }}">
                                    {{ $inv->payment_status }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <a href="{{ route('invoices.show', $inv) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold">
                                    មើល / Print
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-400">គ្មានប្រវត្តិវិក្កយបត្រនៅឡើយទេ</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
