<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('កែប្រែទិន្នន័យឧបករណ៍ពេទ្យ #') }}{{ $equipment->id }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ធ្វើបច្ចុប្បន្នភាពឈ្មោះឧបករណ៍ និងផ្នែកទទួលបន្ទុក</p>
            </div>
            <a href="{{ route('equipments.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8">
            <form action="{{ route('equipments.update', $equipment) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">សាខាមន្ទីរពេទ្យ <span class="text-rose-500">*</span></label>
                        <select name="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $equipment->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ផ្នែកមន្ទីរពេទ្យ (Department) <span class="text-rose-500">*</span></label>
                        <select name="department_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $equipment->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ឈ្មោះឧបករណ៍ពេទ្យ <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ $equipment->name }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ស្ថានភាពឧបករណ៍ <span class="text-rose-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                        <option value="functional" {{ $equipment->status === 'functional' ? 'selected' : '' }}>ដំណើរការល្អ (Functional)</option>
                        <option value="maintenance" {{ $equipment->status === 'maintenance' ? 'selected' : '' }}>កំពុងជួសជុល (Maintenance)</option>
                        <option value="critical" {{ $equipment->status === 'critical' ? 'selected' : '' }}>គ្រោះថ្នាក់ / ខូច (Critical)</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('equipments.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors">
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
