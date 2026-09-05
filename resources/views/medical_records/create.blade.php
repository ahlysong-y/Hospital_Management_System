<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('កត់ត្រាការពិគ្រោះជំងឺក្រៅ (OPD)') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">បញ្ចូលព័ត៌មានរោគសញ្ញា ការពិនិត្យរាងកាយ និងផែនការព្យាបាល</p>
            </div>
            <a href="{{ route('medical-records.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                ← ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
            <form action="{{ route('medical-records.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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

                    <div>
                        <label for="record_type" class="block text-sm font-medium text-slate-700 mb-2">
                            ប្រភេទកំណត់ត្រា <span class="text-rose-500">*</span>
                        </label>
                        <select name="record_type" id="record_type" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="OPD" {{ old('record_type') == 'OPD' ? 'selected' : '' }}>ពិគ្រោះជំងឺក្រៅ (OPD)</option>
                            <option value="General" {{ old('record_type') == 'General' ? 'selected' : '' }}>ពិនិត្យទូទៅ</option>
                            <option value="Follow-up" {{ old('record_type') == 'Follow-up' ? 'selected' : '' }}>តាមដានបន្ត</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="symptoms" class="block text-sm font-medium text-slate-700 mb-2">
                        រោគសញ្ញា និងសំណុំរឿងអ្នកជំងឺ (Symptoms) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="symptoms" id="symptoms" rows="3" required placeholder="បញ្ជាក់អំពីអាការៈ ឬរោគសញ្ញារបស់អ្នកជំងឺ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('symptoms') }}</textarea>
                    @error('symptoms')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="physical_examination" class="block text-sm font-medium text-slate-700 mb-2">
                        លទ្ធផលពិនិត្យរាងកាយ (Physical Examination)
                    </label>
                    <textarea name="physical_examination" id="physical_examination" rows="3" placeholder="កត់ត្រាសីតុណ្ហភាព សម្ពាធឈាម ឬលទ្ធផលពិនិត្យ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('physical_examination') }}</textarea>
                </div>

                <div>
                    <label for="treatment_plan" class="block text-sm font-medium text-slate-700 mb-2">
                        កែសម្រួល / ផែនការព្យាបាល (Treatment Plan) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="treatment_plan" id="treatment_plan" rows="3" required placeholder="បញ្ចូលឈ្មោះថ្នាំ ឬផែនការណែនាំព្យាបាល..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('treatment_plan') }}</textarea>
                    @error('treatment_plan')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('medical-records.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md">
                        រក្សាទុកការពិគ្រោះ
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
