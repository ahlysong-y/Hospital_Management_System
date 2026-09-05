<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Branch;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * បង្ហាញបញ្ជីវិក្កយបត្រទាំងអស់
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $invoices = Invoice::with(['patient', 'branch', 'medicalRecord'])
            ->when($search, function ($query, $search) {
                return $query->where('invoice_number', 'like', "%{$search}%")
                    ->orWhereHas('patient', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($status, function ($query, $status) {
                return $query->where('payment_status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('invoices.index', compact('invoices', 'search', 'status'));
    }

    /**
     * ទម្រង់ចេញវិក្កយបត្រថ្មី
     */
    public function create()
    {
        $patients = Patient::all();
        $branches = Branch::all();
        $records  = MedicalRecord::with('patient')->latest()->take(20)->get();

        return view('invoices.create', compact('patients', 'branches', 'records'));
    }

    /**
     * រក្សាទុកទិន្នន័យវិក្កយបត្រចូល Database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'         => 'required|exists:branches,id',
            'patient_id'        => 'required|exists:patients,id',
            'medical_record_id' => 'nullable|exists:medical_records,id',
            'total_amount'      => 'required|numeric|min:0',
            'discount'          => 'nullable|numeric|min:0',
            'payment_status'    => 'required|in:unpaid,paid,partially_paid',
            'payment_method'    => 'required|string',
            'notes'             => 'nullable|string',
        ]);

        $discount = $validated['discount'] ?? 0;
        $validated['discount'] = $discount;
        $validated['final_amount'] = max(0, $validated['total_amount'] - $discount);

        // បង្កើតលេខវិក្កយបត្រ អូតូ (Auto-generate invoice number: e.g. INV-20260729-1001)
        $validated['invoice_number'] = 'INV-' . date('Ymd') . '-' . rand(1000, 9999);

        $invoice = Invoice::create($validated);

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'បានចេញវិក្កយបត្រថ្មីដោយជោគជ័យ!');
    }

    /**
     * បង្ហាញវិក្កយបត្រ និងទម្រង់សម្រាប់បោះពុម្ព (Print Receipt)
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['patient', 'branch', 'medicalRecord.doctor']);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពស្ថានភាពទូទាត់ប្រាក់
     */
    public function updateStatus(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:unpaid,paid,partially_paid',
            'payment_method' => 'required|string',
        ]);

        $invoice->update($validated);

        return redirect()->back()
            ->with('success', 'បានធ្វើបច្ចុប្បន្នភាពស្ថានភាពទូទាត់ប្រាក់រួចរាល់!');
    }

    /**
     * ទម្រង់កែប្រែវិក្កយបត្រ
     */
    public function edit(Invoice $invoice)
    {
        $patients = Patient::all();
        $branches = Branch::all();
        $records  = MedicalRecord::with('patient')->latest()->take(20)->get();

        return view('invoices.edit', compact('invoice', 'patients', 'branches', 'records'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពព័ត៌មានវិក្កយបត្រ
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'branch_id'         => 'required|exists:branches,id',
            'patient_id'        => 'required|exists:patients,id',
            'medical_record_id' => 'nullable|exists:medical_records,id',
            'total_amount'      => 'required|numeric|min:0',
            'discount'          => 'nullable|numeric|min:0',
            'payment_status'    => 'required|in:unpaid,paid,partially_paid',
            'payment_method'    => 'required|string',
            'notes'             => 'nullable|string',
        ]);

        $discount = $validated['discount'] ?? 0;
        $validated['discount'] = $discount;
        $validated['final_amount'] = max(0, $validated['total_amount'] - $discount);

        $invoice->update($validated);

        return redirect()->route('invoices.index')
            ->with('success', 'បានកែប្រែទិន្នន័យវិក្កយបត្រដោយជោគជ័យ!');
    }

    /**
     * លុបទិន្នន័យវិក្កយបត្រ
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'បានលុបទិន្នន័យវិក្កយបត្ររួចរាល់!');
    }
}

