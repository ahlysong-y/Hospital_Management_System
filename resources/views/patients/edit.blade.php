<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('កែប្រែទិន្នន័យអ្នកជំងឺ') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">កែប្រែព័ត៌មានអ្នកជំងឺ៖ {{ $patient->name }}</p>
            </div>
            <a href="{{ route('patients.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                ← ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
            <form action="{{ route('patients.update', $patient) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Branch Selection -->
                <div>
                    <label for="branch_id" class="block text-sm font-medium text-slate-700 mb-2">
                        សាខាមន្ទីរពេទ្យ <span class="text-rose-500">*</span>
                    </label>
                    <select name="branch_id" id="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                        @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id', $patient->branch_id) == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('branch_id')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                            ឈ្មោះពេញអ្នកជំងឺ <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                        @error('name')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender Selection -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            ភេទ <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="flex items-center justify-center p-2.5 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-checked:bg-emerald-50 has-checked:border-emerald-500 has-checked:text-emerald-700">
                                <input type="radio" name="gender" value="male" class="sr-only" {{ old('gender', $patient->gender) == 'male' ? 'checked' : '' }} required>
                                <span class="text-sm font-medium">ប្រុស</span>
                            </label>
                            <label class="flex items-center justify-center p-2.5 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-checked:bg-emerald-50 has-checked:border-emerald-500 has-checked:text-emerald-700">
                                <input type="radio" name="gender" value="female" class="sr-only" {{ old('gender', $patient->gender) == 'female' ? 'checked' : '' }}>
                                <span class="text-sm font-medium">ស្រី</span>
                            </label>
                            <label class="flex items-center justify-center p-2.5 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-checked:bg-emerald-50 has-checked:border-emerald-500 has-checked:text-emerald-700">
                                <input type="radio" name="gender" value="other" class="sr-only" {{ old('gender', $patient->gender) == 'other' ? 'checked' : '' }}>
                                <span class="text-sm font-medium">ផ្សេងៗ</span>
                            </label>
                        </div>
                        @error('gender')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-slate-700 mb-2">
                            ថ្ងៃខែឆ្នាំកំណើត
                        </label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-slate-700 mb-2">
                            លេខទូរស័ព្ទ
                        </label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $patient->phone_number) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-2">
                        អាសយដ្ឋានបច្ចុប្បន្ន
                    </label>
                    <textarea name="address" id="address" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('address', $patient->address) }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('patients.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md">
                        ធ្វើបច្ចុប្បន្នភាព
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
