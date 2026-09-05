<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('កំណត់ត្រាការថែទាំរបស់គិលានុបដ្ឋាយិកា (Nursing Logs)') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">{{ __('កត់ត្រាការរៀបចំឱសថ ការចុះតាមដានអ្នកជំងឺ និងកិច្ចសហការរដ្ឋបាល') }}</p>
            </div>
            <div>
                <a href="{{ route('nursing-logs.create') }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('បន្ថែមកំណត់ត្រាថែទាំថ្មី') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 transition-all">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="py-4 px-6">{{ __('អ្នកជំងឺ') }}</th>
                            <th class="py-4 px-6">{{ __('ការរៀបចំឱសថ/ឧបករណ៍') }}</th>
                            <th class="py-4 px-6">{{ __('ការចុះថែទាំ និងតាមដាន') }}</th>
                            <th class="py-4 px-6">{{ __('ការងាររដ្ឋបាល/សហការ') }}</th>
                            <th class="py-4 px-6">{{ __('គិលានុបដ្ឋាយិកា') }}</th>
                            <th class="py-4 px-6">{{ __('កាលបរិច្ឆេទ') }}</th>
                            <th class="py-4 px-6 text-right">{{ __('សកម្មភាព') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($logs as $log)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">{{ $log->patient->name ?? __('មិនស្គាល់') }}</div>
                                <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $log->patient->phone_number ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-6 text-slate-700 max-w-xs">
                                <p class="truncate" title="{{ $log->medication_setup }}">
                                    💊 {{ $log->medication_setup }}
                                </p>
                            </td>
                            <td class="py-4 px-6 text-slate-700 max-w-xs">
                                <p class="truncate" title="{{ $log->monitoring_notes }}">
                                    🩺 {{ $log->monitoring_notes }}
                                </p>
                            </td>
                            <td class="py-4 px-6 text-slate-600 max-w-xs">
                                <p class="truncate" title="{{ $log->admin_tasks }}">
                                    {{ $log->admin_tasks ?? '-' }}
                                </p>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-slate-700">{{ $log->nurse->name ?? __('មិនស្គាល់') }}</div>
                            </td>
                            <td class="py-4 px-6 text-slate-600 font-mono text-xs">
                                {{ $log->created_at->format('d-M-Y H:i A') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('nursing-logs.show', $log) }}" class="p-2 text-slate-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors" title="{{ __('មើលព័ត៌មានលម្អិត') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('nursing-logs.edit', $log) }}" class="p-2 text-slate-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors" title="{{ __('កែប្រែ') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('nursing-logs.destroy', $log) }}" method="POST" class="inline">
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
                                {{ __('មិនទាន់មានកំណត់ត្រាថែទាំនៅឡើយទេ') }}
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
