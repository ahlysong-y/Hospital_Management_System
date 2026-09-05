<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('បន្ថែមឧបករណ៍ពេទ្យ / ឧបករណ៍សង្គ្រោះថ្មី') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">បញ្ចូលទិន្នន័យឧបករណ៍សម្រាប់ផ្នែកសង្គ្រោះបន្ទាន់ ឬផ្នែកផ្សេងៗ</p>
            </div>
            <a href="{{ route('equipments.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                ← ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
            <form action="{{ route('equipments.store') }}" method="POST" class="space-y-6">
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
                        <label for="department_id" class="block text-sm font-medium text-slate-700 mb-2">
                            ផ្នែកទទួលបន្ទុកឧបករណ៍ <span class="text-rose-500">*</span>
                        </label>
                        <select name="department_id" id="department_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="">-- ជ្រើសរើសផ្នែក --</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                            ឈ្មោះឧបករណ៍ពេទ្យ <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="ឧទាហរណ៍៖ ម៉ាស៊ីនជំនួយដកដង្ហើម (Ventilator)" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                        @error('name')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-2">
                            ស្ថានភាពដំបូង <span class="text-rose-500">*</span>
                        </label>
                        <select name="status" id="status" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                            <option value="functional" {{ old('status') == 'functional' ? 'selected' : '' }}>🟢 ដំណើរការល្អ (Functional)</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>🟡 កំពុងជួសជុល (Maintenance)</option>
                            <option value="critical" {{ old('status') == 'critical' ? 'selected' : '' }}>🔴 គ្រោះថ្នាក់/ខូច (Critical)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('equipments.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md">
                        រក្សាទុកឧបករណ៍
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
