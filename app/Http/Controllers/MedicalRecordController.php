<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    /**
     * បង្ហាញបញ្ជីសំណុំរឿងពិនិត្យ និងប្រវត្តិព្យាបាល
     */
    public function index(Request $request)
    {
        $records = MedicalRecord::with(['patient', 'doctor', 'branch'])
            ->latest()
            ->paginate(10);

        return view('medical_records.index', compact('records'));
    }

    /**
     * ទម្រង់កត់ត្រាការពិគ្រោះជំងឺក្រៅ (OPD) ថ្មី
     */
    public function create()
    {
        $patients = Patient::all();
        $branches = Branch::all();

        return view('medical_records.create', compact('patients', 'branches'));
    }

    /**
     * រក្សាទុកសំណុំរឿងព្យាបាលចូល Database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'            => 'required|exists:branches,id',
            'patient_id'           => 'required|exists:patients,id',
            'symptoms'             => 'required|string',
            'physical_examination' => 'nullable|string',
            'treatment_plan'       => 'required|string',
            'record_type'          => 'required|string|in:OPD,General,Follow-up',
        ]);

        // កំណត់ Doctor ID ដោយយកពីគ្រូពេទ្យដែលកំពុង Login
        $validated['doctor_id'] = Auth::id();

        MedicalRecord::create($validated);

        return redirect()->route('medical-records.index')
            ->with('success', 'បានកត់ត្រាសំណុំរឿងពិគ្រោះជំងឺដោយជោគជ័យ!');
    }

    /**
     * បង្ហាញព័ត៌មានលម្អិតសំណុំរឿងពិគ្រោះជំងឺ
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['patient', 'doctor', 'branch']);
        return view('medical_records.show', compact('medicalRecord'));
    }

    /**
     * ទម្រង់កែប្រែកំណត់ត្រាពិគ្រោះជំងឺ
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::all();
        $branches = Branch::all();
        return view('medical_records.edit', compact('medicalRecord', 'patients', 'branches'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពកំណត់ត្រាពិគ្រោះជំងឺ
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'branch_id'            => 'required|exists:branches,id',
            'patient_id'           => 'required|exists:patients,id',
            'symptoms'             => 'required|string',
            'physical_examination' => 'nullable|string',
            'treatment_plan'       => 'required|string',
            'record_type'          => 'required|string|in:OPD,General,Follow-up',
        ]);

        $medicalRecord->update($validated);

        return redirect()->route('medical-records.index')
            ->with('success', 'បានកែប្រែកំណត់ត្រាពិគ្រោះជំងឺដោយជោគជ័យ!');
    }

    /**
     * លុបទិន្នន័យកំណត់ត្រាពិគ្រោះជំងឺ
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return redirect()->route('medical-records.index')
            ->with('success', 'បានលុបទិន្នន័យកំណត់ត្រាពិគ្រោះជំងឺរួចរាល់!');
    }
}

