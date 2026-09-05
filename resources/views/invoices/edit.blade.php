<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('កែប្រែវិក្កយបត្រ ៖ ') }} <span class="font-mono text-teal-800">{{ $invoice->invoice_number }}</span>
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">ធ្វើបច្ចុប្បន្នភាពទឹកប្រាក់ បញ្ចុះតម្លៃ និង វិធីសាស្ត្រទូទាត់</p>
            </div>
            <a href="{{ route('invoices.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                ត្រឡប់ក្រោយ
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8">
            <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">សាខាមន្ទីរពេទ្យ <span class="text-rose-500">*</span></label>
                        <select name="branch_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $invoice->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ជ្រើសរើសអ្នកជំងឺ <span class="text-rose-500">*</span></label>
                        <select name="patient_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $invoice->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ភ្ជាប់ជាមួយសំណុំរឿងពិគ្រោះ OPD (បើមាន)</label>
                    <select name="medical_record_id" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                        <option value="">-- មិនភ្ជាប់ --</option>
                        @foreach($records as $rec)
                        <option value="{{ $rec->id }}" {{ $invoice->medical_record_id == $rec->id ? 'selected' : '' }}>
                            OPD #{{ $rec->id }} - {{ $rec->patient->name ?? 'អ្នកជំងឺ' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-5 rounded-xl border border-slate-200">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">សរុបទឹកប្រាក់ ($ USD) <span class="text-rose-500">*</span></label>
                        <input type="number" step="0.01" name="total_amount" value="{{ $invoice->total_amount }}" required class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-mono focus:border-teal-600 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ការបញ្ចុះតម្លៃ ($ USD)</label>
                        <input type="number" step="0.01" name="discount" value="{{ $invoice->discount }}" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-mono focus:border-teal-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">ស្ថានភាពទូទាត់ប្រាក់ <span class="text-rose-500">*</span></label>
                        <select name="payment_status" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            <option value="paid" {{ $invoice->payment_status === 'paid' ? 'selected' : '' }}>ទូទាត់រួច (Paid)</option>
                            <option value="unpaid" {{ $invoice->payment_status === 'unpaid' ? 'selected' : '' }}>មិនទាន់ទូទាត់ (Unpaid)</option>
                            <option value="partially_paid" {{ $invoice->payment_status === 'partially_paid' ? 'selected' : '' }}>ទូទាត់ខ្លះ (Partially Paid)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">វិធីសាស្ត្រទូទាត់ប្រាក់ <span class="text-rose-500">*</span></label>
                        <select name="payment_method" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">
                            <option value="Cash" {{ $invoice->payment_method === 'Cash' ? 'selected' : '' }}>សាច់ប្រាក់ (Cash)</option>
                            <option value="ABA / KHQR" {{ $invoice->payment_method === 'ABA / KHQR' ? 'selected' : '' }}>ABA / KHQR (Scan)</option>
                            <option value="Credit Card" {{ $invoice->payment_method === 'Credit Card' ? 'selected' : '' }}>កាតធនាគារ (Credit/Debit Card)</option>
                            <option value="Insurance" {{ $invoice->payment_method === 'Insurance' ? 'selected' : '' }}>ធានារ៉ាប់រង (Insurance Claim)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">កំណត់ត្រា ឬ កត់សម្គាល់បន្ថែម</label>
                    <textarea name="notes" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-600 outline-none">{{ $invoice->notes }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('invoices.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors">
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
