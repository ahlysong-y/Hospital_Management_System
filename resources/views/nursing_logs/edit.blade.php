<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('កែប្រែកំណត់ត្រាថែទាំ #') }}{{ $nursingLog->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ធ្វើបច្ចុប្បន្នភាពការរៀបចំឱសថ និងការតាមដាន</p>
            </div>
            <a href="{{ route('nursing-logs.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8">
            <form action="{{ route('nursing-logs.update', $nursingLog) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">សាខាមន្ទីរពេទ្យ <span class="text-rose-500">*</span></label>
                        <select name="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $nursingLog->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ជ្រើសរើសអ្នកជំងឺ <span class="text-rose-500">*</span></label>
                        <select name="patient_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $nursingLog->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ការរៀបចំឱសថ (Medication Setup) <span class="text-rose-500">*</span></label>
                    <textarea name="medication_setup" rows="3" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ $nursingLog->medication_setup }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ការតាមដានសញ្ញាជីវិត & កត់សម្គាល់ (Monitoring Notes) <span class="text-rose-500">*</span></label>
                    <textarea name="monitoring_notes" rows="3" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ $nursingLog->monitoring_notes }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ភារកិច្ចរដ្ឋបាល & សហការ (Admin Tasks)</label>
                    <textarea name="admin_tasks" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ $nursingLog->admin_tasks }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('nursing-logs.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors">
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
