<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('បន្ថែមកំណត់ត្រាថែទាំថ្មី') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">កត់ត្រាការរៀបចំឱសថ និងការចុះតាមដានអ្នកជំងឺផ្ទាល់</p>
            </div>
            <a href="{{ route('nursing-logs.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                ← ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
            <form action="{{ route('nursing-logs.store') }}" method="POST" class="space-y-6">
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

                <div>
                    <label for="medication_setup" class="block text-sm font-medium text-slate-700 mb-2">
                        ការរៀបចំឱសថ និងឧបករណ៍ (Medication & Equipment Setup) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="medication_setup" id="medication_setup" rows="3" required placeholder="បញ្ជាក់ប្រភេទថ្នាំ សេរ៉ូម ឬឧបករណ៍ដែលបានរៀបចំផ្តល់ឱ្យអ្នកជំងឺ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('medication_setup') }}</textarea>
                    @error('medication_setup')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="monitoring_notes" class="block text-sm font-medium text-slate-700 mb-2">
                        ការចុះថែទាំ និងតាមដានអ្នកជំងឺផ្ទាល់ (Patient Care & Monitoring) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="monitoring_notes" id="monitoring_notes" rows="3" required placeholder="កត់ត្រាសីតុណ្ហភាព ជាតិស្ករ ស្ថានភាពទូទៅរបស់អ្នកជំងឺ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('monitoring_notes') }}</textarea>
                    @error('monitoring_notes')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="admin_tasks" class="block text-sm font-medium text-slate-700 mb-2">
                        កិច្ចសហការ និងការងាររដ្ឋបាល (Collaboration & Admin Tasks)
                    </label>
                    <textarea name="admin_tasks" id="admin_tasks" rows="2" placeholder="កត់ត្រាកិច្ចសហការជាមួយគ្រូពេទ្យ ឬការងាររដ្ឋបាលផ្សេងៗ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('admin_tasks') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('nursing-logs.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md">
                        រក្សាទុកកំណត់ត្រា
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
