<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('គ្រប់គ្រងព័ត៌មានអ្នកជំងឺ') }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ __('បញ្ជីឈ្មោះអ្នកជំងឺដែលបានចុះឈ្មោះក្នុងប្រព័ន្ធមន្ទីរពេទ្យ') }}</p>
            </div>
            <div>
                <a href="{{ route('patients.create') }}" class="inline-flex items-center px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-sm font-semibold rounded-xl transition-colors duration-150 gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('ចុះឈ្មោះអ្នកជំងឺថ្មី') }}
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

        <!-- Filter & Search Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4">
            <form method="GET" action="{{ route('patients.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('ស្វែងរកតាមឈ្មោះ ឬ លេខទូរស័ព្ទ...') }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-colors duration-150 outline-none">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors duration-150">
                        {{ __('ស្វែងរក') }}
                    </button>
                    @if(request('search'))
                    <a href="{{ route('patients.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors duration-150 flex items-center">
                        {{ __('កំណត់ឡើងវិញ') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="py-4 px-6">{{ __('អ្នកជំងឺ') }}</th>
                            <th class="py-4 px-6">{{ __('ភេទ') }}</th>
                            <th class="py-4 px-6">{{ __('ថ្ងៃខែឆ្នាំកំណើត') }}</th>
                            <th class="py-4 px-6">{{ __('លេខទូរស័ព្ទ') }}</th>
                            <th class="py-4 px-6">{{ __('សាខាមន្ទីរពេទ្យ') }}</th>
                            <th class="py-4 px-6 text-right">{{ __('សកម្មភាព') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($patients as $patient)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-800 border border-teal-100 flex items-center justify-center font-bold text-sm shrink-0">
                                        {{ mb_substr($patient->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-800">{{ $patient->name }}</div>
                                        <div class="text-xs text-slate-400 mt-0.5 truncate max-w-xs">{{ $patient->address ?? __('គ្មានអាសយដ្ឋាន') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($patient->gender === 'male')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ __('ប្រុស') }}
                                </span>
                                @elseif($patient->gender === 'female')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-teal-50 text-teal-800 border border-teal-100">
                                    {{ __('ស្រី') }}
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-600">
                                    {{ __('ផ្សេងៗ') }}
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d-M-Y') : __('មិនបានបញ្ជាក់') }}
                            </td>
                            <td class="py-4 px-6 text-slate-600 font-mono text-xs">
                                {{ $patient->phone_number ?? '-' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $patient->branch->name ?? __('មិនទាន់រៀបចំ') }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('patients.show', $patient) }}" class="p-2 text-slate-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors duration-150" title="{{ __('មើលព័ត៌មានលម្អិត') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('patients.edit', $patient) }}" class="p-2 text-slate-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors duration-150" title="{{ __('កែប្រែ') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors duration-150" title="{{ __('លុប') }}">
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
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ __('មិនទាន់មានទិន្នន័យអ្នកជំងឺនៅឡើយទេ') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                {{ $patients->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
</x-app-layout>


