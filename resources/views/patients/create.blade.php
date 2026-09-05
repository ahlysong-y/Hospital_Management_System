<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('ចុះឈ្មោះអ្នកជំងឺថ្មី') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">សូមបញ្ចូលព័ត៌មានអ្នកជំងឺឱ្យបានត្រឹមត្រូវ</p>
            </div>
            <a href="{{ route('patients.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                ← ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
            <form action="{{ route('patients.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Branch Selection -->
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                            ឈ្មោះពេញអ្នកជំងឺ <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="ឧទាហរណ៍៖ ស៊ន វណ្ណៈ" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
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
                                <input type="radio" name="gender" value="male" class="sr-only" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                <span class="text-sm font-medium">ប្រុស</span>
                            </label>
                            <label class="flex items-center justify-center p-2.5 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-checked:bg-emerald-50 has-checked:border-emerald-500 has-checked:text-emerald-700">
                                <input type="radio" name="gender" value="female" class="sr-only" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <span class="text-sm font-medium">ស្រី</span>
                            </label>
                            <label class="flex items-center justify-center p-2.5 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-checked:bg-emerald-50 has-checked:border-emerald-500 has-checked:text-emerald-700">
                                <input type="radio" name="gender" value="other" class="sr-only" {{ old('gender') == 'other' ? 'checked' : '' }}>
                                <span class="text-sm font-medium">ផ្សេងៗ</span>
                            </label>
                        </div>
                        @error('gender')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-slate-700 mb-2">
                            ថ្ងៃខែឆ្នាំកំណើត
                        </label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                        @error('date_of_birth')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-slate-700 mb-2">
                            លេខទូរស័ព្ទ
                        </label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="ឧទាហរណ៍៖ 012 345 678" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                        @error('phone_number')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address Textarea -->
                <div>
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-2">
                        អាសយដ្ឋានបច្ចុប្បន្ន
                    </label>
                    <textarea name="address" id="address" rows="3" placeholder="បញ្ចូលអាសយដ្ឋានអ្នកជំងឺ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('address') }}</textarea>
                    @error('address')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('patients.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-all">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md">
                        រក្សាទុកទិន្នន័យ
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
