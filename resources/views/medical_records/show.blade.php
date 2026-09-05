<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ព័ត៌មានលម្អិតសំណុំរឿងពិគ្រោះ OPD #') }}{{ $medicalRecord->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ព័ត៌មានរោគសញ្ញា ការពិនិត្យរាងកាយ និងប្រវត្តិព្យាបាល</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('medical-records.edit', $medicalRecord) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors">
                    កែប្រែ
                </a>
                <a href="{{ route('medical-records.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                    ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6">
            <div class="flex justify-between items-start border-b border-slate-100 pb-4">
                <div>
                    <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-teal-50 text-teal-800 border border-teal-100">
                        {{ $medicalRecord->record_type }}
                    </span>
                    <h3 class="text-xl font-bold text-slate-800 mt-2">{{ $medicalRecord->patient->name ?? 'អ្នកជំងឺ' }}</h3>
                    <p class="text-xs text-slate-500 font-mono">ទូរស័ព្ទ ៖ {{ $medicalRecord->patient->phone_number ?? '-' }}</p>
                </div>
                <div class="text-right text-xs text-slate-500 font-mono">
                    <p>កាលបរិច្ឆេទ ៖ {{ $medicalRecord->created_at->format('d-M-Y H:i A') }}</p>
                    <p class="mt-1">សាខា ៖ {{ $medicalRecord->branch->name ?? '-' }}</p>
                    <p class="mt-1">គ្រូពេទ្យ ៖ {{ $medicalRecord->doctor->name ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-4 text-sm text-slate-700">
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1 text-teal-800">រោគសញ្ញា (Symptoms) ៖</h4>
                    <p class="leading-relaxed">{{ $medicalRecord->symptoms }}</p>
                </div>

                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1 text-teal-800">ការពិនិត្យរាងកាយ (Physical Examination) ៖</h4>
                    <p class="leading-relaxed">{{ $medicalRecord->physical_examination ?? 'គ្មានទិន្នន័យពិនិត្យរាងកាយ' }}</p>
                </div>

                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1 text-teal-800">ផែនការព្យាបាល & ឱសថ (Treatment Plan) ៖</h4>
                    <p class="leading-relaxed font-semibold text-slate-900">{{ $medicalRecord->treatment_plan }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
