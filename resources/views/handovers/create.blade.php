<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('ប្រគល់វេនការងារថ្មី') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">កត់ត្រាព័ត៌មាន និងផ្ញើភារកិច្ចទៅកាន់បុគ្គលិកទទួលវេនបន្ទាប់</p>
            </div>
            <a href="{{ route('handovers.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                ← ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
            <form action="{{ route('handovers.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="branch_id" class="block text-sm font-medium text-slate-700 mb-2">
                            សាខាមន្ទីរពេទ្យ <span class="text-rose-500">*</span>
                        </label>
                        <select name="branch_id" id="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="">-- ជ្រើសរើសសាខា --</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="to_user_id" class="block text-sm font-medium text-slate-700 mb-2">
                            ជ្រើសរើសអ្នកទទួលវេន <span class="text-rose-500">*</span>
                        </label>
                        <select name="to_user_id" id="to_user_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="">-- ជ្រើសរើសបុគ្គលិក --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('to_user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->role ?? 'Staff' }})
                            </option>
                            @endforeach
                        </select>
                        @error('to_user_id')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="handover_time" class="block text-sm font-medium text-slate-700 mb-2">
                        កាលបរិច្ឆេទ និងម៉ោងប្រគល់វេន <span class="text-rose-500">*</span>
                    </label>
                    <input type="datetime-local" name="handover_time" id="handover_time" value="{{ old('handover_time', date('Y-m-d\TH:i')) }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                    @error('handover_time')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="handover_notes" class="block text-sm font-medium text-slate-700 mb-2">
                        កំណត់ត្រាប្រគល់វេន (Handover Notes) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="handover_notes" id="handover_notes" rows="4" required placeholder="បញ្ចូលកំណត់ត្រាសំខាន់ៗអំពីអ្នកជំងឺ ឬការងារត្រូវបន្ត..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('handover_notes') }}</textarea>
                    @error('handover_notes')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('handovers.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md">
                        រក្សាទុកការប្រគល់វេន
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
