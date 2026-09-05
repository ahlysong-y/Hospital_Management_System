<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('កែប្រែកំណត់ត្រាពិគ្រោះ OPD #') }}{{ $medicalRecord->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ធ្វើបច្ចុប្បន្នភាពរោគសញ្ញា និងផែនការព្យាបាល</p>
            </div>
            <a href="{{ route('medical-records.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8">
            <form action="{{ route('medical-records.update', $medicalRecord) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">សាខាមន្ទីរពេទ្យ <span class="text-rose-500">*</span></label>
                        <select name="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $medicalRecord->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ជ្រើសរើសអ្នកជំងឺ <span class="text-rose-500">*</span></label>
                        <select name="patient_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $medicalRecord->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ប្រភេទសំណុំរឿង <span class="text-rose-500">*</span></label>
                    <select name="record_type" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                        <option value="OPD" {{ $medicalRecord->record_type === 'OPD' ? 'selected' : '' }}>OPD (ពិគ្រោះជំងឺក្រៅ)</option>
                        <option value="General" {{ $medicalRecord->record_type === 'General' ? 'selected' : '' }}>General (ទូទៅ)</option>
                        <option value="Follow-up" {{ $medicalRecord->record_type === 'Follow-up' ? 'selected' : '' }}>Follow-up (ពិនិត្យឡើងវិញ)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">រោគសញ្ញា (Symptoms) <span class="text-rose-500">*</span></label>
                    <textarea name="symptoms" rows="3" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ $medicalRecord->symptoms }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ការពិនិត្យរាងកាយ (Physical Exam)</label>
                    <textarea name="physical_examination" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ $medicalRecord->physical_examination }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ផែនការព្យាបាល & ថ្នាំ (Treatment Plan) <span class="text-rose-500">*</span></label>
                    <textarea name="treatment_plan" rows="3" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ $medicalRecord->treatment_plan }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('medical-records.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-sm font-semibold rounded-xl transition-colors">
                        រក្សាទុកការកែប្រែ
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
