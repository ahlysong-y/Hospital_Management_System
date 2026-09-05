<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('រៀបចំកាលវិភាគវះកាត់ថ្មី') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">បញ្ចូលព័ត៌មានកាលវិភាគ ត្រៀមបន្ទប់ និងការសួរសុខទុក្ខមុនវះកាត់</p>
            </div>
            <a href="{{ route('surgeries.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                ← ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
            <form action="{{ route('surgeries.store') }}" method="POST" class="space-y-6">
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
                        <label for="patient_id" class="block text-sm font-medium text-slate-700 mb-2">
                            ជ្រើសរើសអ្នកជំងឺ <span class="text-rose-500">*</span>
                        </label>
                        <select name="patient_id" id="patient_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="">-- ជ្រើសរើសអ្នកជំងឺ --</option>
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }} ({{ $patient->phone_number ?? 'គ្មានលេខ' }})
                            </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="surgeon_id" class="block text-sm font-medium text-slate-700 mb-2">
                            គ្រូពេទ្យវះកាត់ទទួលបន្ទុក <span class="text-rose-500">*</span>
                        </label>
                        <select name="surgeon_id" id="surgeon_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="">-- ជ្រើសរើសគ្រូពេទ្យវះកាត់ --</option>
                            @foreach($surgeons as $surgeon)
                            <option value="{{ $surgeon->id }}" {{ old('surgeon_id') == $surgeon->id ? 'selected' : '' }}>
                                {{ $surgeon->name }} ({{ $surgeon->role }})
                            </option>
                            @endforeach
                        </select>
                        @error('surgeon_id')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="room_number" class="block text-sm font-medium text-slate-700 mb-2">
                            លេខបន្ទប់វះកាត់ (OR Room) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="room_number" id="room_number" value="{{ old('room_number') }}" required placeholder="ឧទាហរណ៍៖ OR-101" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                        @error('room_number')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="scheduled_at" class="block text-sm font-medium text-slate-700 mb-2">
                            កាលវិភាគវះកាត់ (ថ្ងៃ និងម៉ោង) <span class="text-rose-500">*</span>
                        </label>
                        <input type="datetime-local" name="scheduled_at" id="scheduled_at" value="{{ old('scheduled_at', date('Y-m-d\TH:i')) }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                        @error('scheduled_at')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-2">
                            ស្ថានភាពដំបូង <span class="text-rose-500">*</span>
                        </label>
                        <select name="status" id="status" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>ត្រៀមវះកាត់ (Pending)</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>កំពុងវះកាត់ (In Progress)</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>វះកាត់រួចរាល់ (Completed)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="pre_surgery_assessment" class="block text-sm font-medium text-slate-700 mb-2">
                        ការសួរសុខទុក្ខ និងវាយតម្លៃមុនវះកាត់ (Pre-surgery Assessment)
                    </label>
                    <textarea name="pre_surgery_assessment" id="pre_surgery_assessment" rows="3" placeholder="កត់ត្រាលទ្ធផលពិនិត្យឈាម អេកូ ឬការសួរសុខទុក្ខអ្នកជំងឺ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('pre_surgery_assessment') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('surgeries.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md">
                        រក្សាទុកកាលវិភាគ
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
