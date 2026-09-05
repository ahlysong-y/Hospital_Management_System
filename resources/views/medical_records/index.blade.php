<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('សំណុំរឿងពិនិត្យ និងប្រវត្តិព្យាបាល (OPD)') }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ __('កត់ត្រាការពិគ្រោះជំងឺ ការពិនិត្យរាងកាយ និងការណែនាំព្យាបាល') }}</p>
            </div>
            <div>
                <a href="{{ route('medical-records.create') }}" class="inline-flex items-center px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-sm font-semibold rounded-xl transition-colors duration-150 gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('កត់ត្រាការពិគ្រោះថ្មី (OPD)') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        @if (session('success'))
        <div class="p-4 bg-teal-50 border border-teal-200 text-teal-800 rounded-2xl flex items-center gap-3">
            <svg class="w-5 h-5 text-teal-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="py-4 px-6">{{ __('អ្នកជំងឺ') }}</th>
                            <th class="py-4 px-6">{{ __('ប្រភេទ') }}</th>
                            <th class="py-4 px-6">{{ __('រោគសញ្ញា / ការពិនិត្យ') }}</th>
                            <th class="py-4 px-6">{{ __('ផែនការព្យាបាល') }}</th>
                            <th class="py-4 px-6">{{ __('គ្រូពេទ្យទទួលបន្ទុក') }}</th>
                            <th class="py-4 px-6">{{ __('សាខាមន្ទីរពេទ្យ') }}</th>
                            <th class="py-4 px-6 text-right">{{ __('សកម្មភាព') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($records as $record)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">{{ $record->patient->name ?? __('មិនស្គាល់') }}</div>
                                <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $record->patient->phone_number ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold bg-teal-50 text-teal-800 border border-teal-100">
                                    {{ $record->record_type }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-600 max-w-xs">
                                <p class="font-medium text-slate-800 text-xs truncate" title="{{ $record->symptoms }}">
                                    {{ __('រោគសញ្ញា') }}៖ {{ $record->symptoms }}
                                </p>
                                @if($record->physical_examination)
                                <p class="text-xs text-slate-400 truncate mt-1" title="{{ $record->physical_examination }}">
                                    {{ __('ពិនិត្យ') }}៖ {{ $record->physical_examination }}
                                </p>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-600 max-w-xs">
                                <p class="truncate text-xs" title="{{ $record->treatment_plan }}">{{ $record->treatment_plan }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-slate-700">{{ $record->doctor->name ?? __('មិនទាន់បញ្ជាក់') }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $record->branch->name ?? __('មិនទាន់រៀបចំ') }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('medical-records.show', $record) }}" class="p-2 text-slate-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors" title="{{ __('មើលព័ត៌មានលម្អិត') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('medical-records.edit', $record) }}" class="p-2 text-slate-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors" title="{{ __('កែប្រែ') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('medical-records.destroy', $record) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="{{ __('លុប') }}">
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
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                {{ __('មិនទាន់មានសំណុំរឿងពិគ្រោះជំងឺនៅឡើយទេ') }}
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                {{ $records->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
