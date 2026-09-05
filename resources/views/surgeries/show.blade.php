<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ព័ត៌មានលម្អិតកាលវិភាគវះកាត់ #') }}{{ $surgery->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ព័ត៌មានអ្នកជំងឺ គ្រូពេទ្យវះកាត់ បន្ទប់វះកាត់ និងការសួរសុខទុក្ខ</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('surgeries.edit', $surgery) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors">
                    កែប្រែ
                </a>
                <a href="{{ route('surgeries.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
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
                        {{ $surgery->status === 'completed' ? 'bg-teal-50 text-teal-800 border border-teal-100' : '' }}
                        {{ $surgery->status === 'in_progress' ? 'bg-amber-50 text-amber-800 border border-amber-100' : '' }}
                        {{ $surgery->status === 'pending' ? 'bg-slate-100 text-slate-700 border border-slate-200' : '' }}
                        {{ $surgery->status === 'cancelled' ? 'bg-rose-50 text-rose-800 border border-rose-100' : '' }}">
                        {{ $surgery->status }}
                    </span>
                    <h3 class="text-xl font-bold text-slate-800 mt-2">{{ $surgery->patient->name ?? 'អ្នកជំងឺ' }}</h3>
                    <p class="text-xs text-slate-500 font-mono">ទូរស័ព្ទ ៖ {{ $surgery->patient->phone_number ?? '-' }}</p>
                </div>
                <div class="text-right text-xs text-slate-500 font-mono">
                    <p>កាលវិភាគ ៖ {{ \Carbon\Carbon::parse($surgery->scheduled_at)->format('d-M-Y H:i A') }}</p>
                    <p class="mt-1">បន្ទប់វះកាត់ ៖ <span class="font-bold text-slate-800">{{ $surgery->room_number }}</span></p>
                    <p class="mt-1">គ្រូពេទ្យ ៖ {{ $surgery->surgeon->name ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-4 text-sm text-slate-700">
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1 text-teal-800">ការសួរសុខទុក្ខ / វាយតម្លៃមុនវះកាត់ (Pre-surgery Assessment) ៖</h4>
                    <p class="leading-relaxed">{{ $surgery->pre_surgery_assessment ?? 'គ្មានទិន្នន័យវាយតម្លៃមុនវះកាត់' }}</p>
                </div>

                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 flex justify-between items-center text-xs">
                    <span class="text-slate-500">សាខាមន្ទីរពេទ្យ ៖ <strong class="text-slate-800">{{ $surgery->branch->name ?? '-' }}</strong></span>
                    <span class="text-slate-500">បង្កើតនៅ ៖ <strong class="text-slate-800">{{ $surgery->created_at->format('d-M-Y H:i A') }}</strong></span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
