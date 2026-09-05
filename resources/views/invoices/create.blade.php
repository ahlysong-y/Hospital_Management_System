<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('ចេញវិក្កយបត្រថ្មី (Issue New Invoice)') }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ទម្រង់បង្កើត និងចេញវិក្កយបត្រថ្លៃព្យាបាលជូនអ្នកជំងឺ</p>
            </div>
            <a href="{{ route('invoices.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8">
            <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Branch & Patient -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">សាខាមន្ទីរពេទ្យ <span class="text-rose-500">*</span></label>
                        <select name="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ជ្រើសរើសអ្នកជំងឺ <span class="text-rose-500">*</span></label>
                        <select name="patient_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            <option value="">-- ជ្រើសរើសអ្នកជំងឺ --</option>
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->phone_number ?? 'គ្មានលេខទូរស័ព្ទ' }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Medical Record Link (Optional) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ភ្ជាប់ជាមួយសំណុំរឿងពិគ្រោះ OPD (បើមាន)</label>
                    <select name="medical_record_id" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                        <option value="">-- មិនភ្ជាប់ (General Invoice) --</option>
                        @foreach($records as $rec)
                        <option value="{{ $rec->id }}">
                            OPD #{{ $rec->id }} - {{ $rec->patient->name ?? 'អ្នកជំងឺ' }} (រោគសញ្ញា: {{ Str::limit($rec->symptoms, 40) }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Amount Breakdown -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-5 rounded-xl border border-slate-200">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">សរុបទឹកប្រាក់ ($ USD) <span class="text-rose-500">*</span></label>
                        <input type="number" step="0.01" name="total_amount" required placeholder="0.00" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-mono focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ការបញ្ចុះតម្លៃ ($ USD)</label>
                        <input type="number" step="0.01" name="discount" value="0.00" placeholder="0.00" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-mono focus:border-teal-600 outline-none">
                    </div>
                </div>

                <!-- Payment Status & Method -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ស្ថានភាពទូទាត់ប្រាក់ <span class="text-rose-500">*</span></label>
                        <select name="payment_status" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            <option value="paid">ទូទាត់រួច (Paid)</option>
                            <option value="unpaid">មិនទាន់ទូទាត់ (Unpaid)</option>
                            <option value="partially_paid">ទូទាត់ខ្លះ (Partially Paid)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">វិធីសាស្ត្រទូទាត់ប្រាក់ <span class="text-rose-500">*</span></label>
                        <select name="payment_method" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            <option value="Cash">សាច់ប្រាក់ (Cash)</option>
                            <option value="ABA / KHQR">ABA / KHQR (Scan)</option>
                            <option value="Credit Card">កាតធនាគារ (Credit/Debit Card)</option>
                            <option value="Insurance">ធានារ៉ាប់រង (Insurance Claim)</option>
                        </select>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">កំណត់ត្រា ឬ កត់សម្គាល់បន្ថែម</label>
                    <textarea name="notes" rows="3" placeholder="ព័ត៌មានបន្ថែមស្តីពីការទូទាត់ថ្លៃថ្នាំ ឬ ការពិនិត្យ..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('invoices.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors">
                        បោះបង់
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-sm font-semibold rounded-xl transition-colors">
                        ចេញវិក្កយបត្រ & បោះពុម្ព
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
