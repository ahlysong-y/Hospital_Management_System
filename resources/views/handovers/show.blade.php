<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ព័ត៌មានលម្អិតការប្រគល់វេន #') }}{{ $handover->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ព័ត៌មានអ្នកប្រគល់ អ្នកទទួល និងកំណត់ត្រាវេនការងារ</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('handovers.edit', $handover) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors">
                    កែប្រែ
                </a>
                <a href="{{ route('handovers.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                    ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 space-y-6">
            <div class="grid grid-cols-2 gap-6 bg-slate-50 p-5 rounded-xl border border-slate-200 text-xs">
                <div>
                    <h4 class="font-bold text-slate-400 uppercase tracking-wider mb-1">អ្នកប្រគល់វេន (Sender) ៖</h4>
                    <p class="font-bold text-slate-800 text-base">{{ $handover->sender->name ?? 'មិនស្គាល់' }}</p>
                    <p class="text-slate-500 mt-0.5">{{ $handover->sender->role ?? 'Staff' }}</p>
                </div>
                <div class="text-right">
                    <h4 class="font-bold text-slate-400 uppercase tracking-wider mb-1">អ្នកទទួលវេន (Receiver) ៖</h4>
                    <p class="font-bold text-slate-800 text-base">{{ $handover->receiver->name ?? 'មិនស្គាល់' }}</p>
                    <p class="text-slate-500 mt-0.5">{{ $handover->receiver->role ?? 'Staff' }}</p>
                </div>
            </div>

            <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-sm space-y-2">
                <h4 class="font-bold text-teal-800 text-xs uppercase tracking-wider">កំណត់ត្រាប្រគល់-ទទួលវេន ៖</h4>
                <p class="leading-relaxed text-slate-800">{{ $handover->handover_notes }}</p>
            </div>

            <div class="flex justify-between items-center text-xs text-slate-500 font-mono pt-4 border-t border-slate-100">
                <span>កាលបរិច្ឆេទប្រគល់ ៖ {{ \Carbon\Carbon::parse($handover->handover_time)->format('d-M-Y H:i A') }}</span>
                <span>សាខា ៖ {{ $handover->branch->name ?? '-' }}</span>
            </div>
        </div>
    </div>
</x-app-layout>
