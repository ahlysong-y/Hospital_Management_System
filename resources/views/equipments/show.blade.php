<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ព័ត៌មានលម្អិតឧបករណ៍ពេទ្យ #') }}{{ $equipment->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ឈ្មោះឧបករណ៍ ផ្នែក ស្ថានភាព និងកាលបរិច្ឆេទត្រួតពិនិត្យ</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('equipments.edit', $equipment) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors">
                    កែប្រែ
                </a>
                <a href="{{ route('equipments.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                    ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6">
            <div class="flex justify-between items-start border-b border-slate-100 pb-4">
                <div>
                    <span class="px-3 py-1 rounded-xl text-xs font-semibold
                        {{ $equipment->status === 'functional' ? 'bg-teal-50 text-teal-800 border border-teal-100' : '' }}
                        {{ $equipment->status === 'maintenance' ? 'bg-amber-50 text-amber-800 border border-amber-100' : '' }}
                        {{ $equipment->status === 'critical' ? 'bg-rose-50 text-rose-800 border border-rose-100' : '' }}">
                        {{ $equipment->status === 'functional' ? 'ដំណើរការល្អ' : ($equipment->status === 'maintenance' ? 'កំពុងជួសជុល' : 'គ្រោះថ្នាក់/ខូច') }}
                    </span>
                    <h3 class="text-xl font-bold text-slate-800 mt-2">{{ $equipment->name }}</h3>
                    <p class="text-xs text-slate-500">ផ្នែក ៖ {{ $equipment->department->name ?? '-' }}</p>
                </div>
                <div class="text-right text-xs text-slate-500 font-mono">
                    <p>ត្រួតពិនិត្យចុងក្រោយ ៖ {{ $equipment->last_checked_at ? \Carbon\Carbon::parse($equipment->last_checked_at)->format('d-M-Y H:i A') : '-' }}</p>
                    <p class="mt-1">សាខា ៖ {{ $equipment->branch->name ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-sm space-y-2">
                <h4 class="font-bold text-teal-800 text-xs uppercase tracking-wider">ការពិពណ៌នា & ព័ត៌មានឧបករណ៍ ៖</h4>
                <p class="text-slate-800 font-semibold">{{ $equipment->name }}</p>
                <p class="text-xs text-slate-500">សាខា ៖ {{ $equipment->branch->name ?? '-' }} | ផ្នែក ៖ {{ $equipment->department->name ?? '-' }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
