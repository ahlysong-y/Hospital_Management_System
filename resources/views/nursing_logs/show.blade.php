<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ព័ត៌មានលម្អិតកំណត់ត្រាថែទាំ #') }}{{ $nursingLog->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ព័ត៌មានអ្នកជំងឺ ការរៀបចំឱសថ និងការតាមដានសុខភាព</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('nursing-logs.edit', $nursingLog) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors">
                    កែប្រែ
                </a>
                <a href="{{ route('nursing-logs.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                    ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6">
            <div class="flex justify-between items-start border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-800">{{ $nursingLog->patient->name ?? 'អ្នកជំងឺ' }}</h3>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">ទូរស័ព្ទ ៖ {{ $nursingLog->patient->phone_number ?? '-' }}</p>
                </div>
                <div class="text-right text-xs text-slate-500 font-mono">
                    <p>កាលបរិច្ឆេទ ៖ {{ $nursingLog->created_at->format('d-M-Y H:i A') }}</p>
                    <p class="mt-1">គិលានុបដ្ឋាយិកា ៖ {{ $nursingLog->nurse->name ?? '-' }}</p>
                    <p class="mt-1">សាខា ៖ {{ $nursingLog->branch->name ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-4 text-sm text-slate-700">
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1 text-teal-800">ការរៀបចំឱសថ (Medication Setup) ៖</h4>
                    <p class="leading-relaxed font-semibold text-slate-900">{{ $nursingLog->medication_setup }}</p>
                </div>

                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1 text-teal-800">ការតាមដានសញ្ញាជីវិត & កត់សម្គាល់ (Monitoring Notes) ៖</h4>
                    <p class="leading-relaxed">{{ $nursingLog->monitoring_notes }}</p>
                </div>

                @if($nursingLog->admin_tasks)
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1 text-teal-800">ភារកិច្ចរដ្ឋបាល & សហការ (Admin Tasks) ៖</h4>
                    <p class="leading-relaxed">{{ $nursingLog->admin_tasks }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
