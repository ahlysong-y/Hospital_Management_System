<?php

namespace App\Http\Controllers;

use App\Models\NursingLog;
use App\Models\Patient;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NursingLogController extends Controller
{
    /**
     * បង្ហាញបញ្ជីកំណត់ត្រាថែទាំអ្នកជំងឺរបស់គិលានុបដ្ឋាយិកា
     */
    public function index(Request $request)
    {
        $logs = NursingLog::with(['patient', 'nurse', 'branch'])
            ->latest()
            ->paginate(10);

        return view('nursing_logs.index', compact('logs'));
    }

    /**
     * ទម្រង់កត់ត្រាការថែទាំអ្នកជំងឺ និងការរៀបចំឱសថ
     */
    public function create()
    {
        $patients = Patient::all();
        $branches = Branch::all();

        return view('nursing_logs.create', compact('patients', 'branches'));
    }

    /**
     * រក្សាទុកកំណត់ត្រាថែទាំចូល Database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'        => 'required|exists:branches,id',
            'patient_id'       => 'required|exists:patients,id',
            'medication_setup' => 'required|string',
            'monitoring_notes' => 'required|string',
            'admin_tasks'      => 'nullable|string',
        ]);

        // កំណត់ Nurse ID ដោយយកពីបុគ្គលិកដែលកំពុង Login
        $validated['nurse_id'] = Auth::id();

        NursingLog::create($validated);

        return redirect()->route('nursing-logs.index')
            ->with('success', 'បានរក្សាទុកកំណត់ត្រាថែទាំអ្នកជំងឺដោយជោគជ័យ!');
    }

    /**
     * បង្ហាញព័ត៌មានលម្អិតកំណត់ត្រាថែទាំ
     */
    public function show(NursingLog $nursingLog)
    {
        $nursingLog->load(['patient', 'nurse', 'branch']);
        return view('nursing_logs.show', compact('nursingLog'));
    }

    /**
     * ទម្រង់កែប្រែកំណត់ត្រាថែទាំ
     */
    public function edit(NursingLog $nursingLog)
    {
        $patients = Patient::all();
        $branches = Branch::all();
        return view('nursing_logs.edit', compact('nursingLog', 'patients', 'branches'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពកំណត់ត្រាថែទាំ
     */
    public function update(Request $request, NursingLog $nursingLog)
    {
        $validated = $request->validate([
            'branch_id'        => 'required|exists:branches,id',
            'patient_id'       => 'required|exists:patients,id',
            'medication_setup' => 'required|string',
            'monitoring_notes' => 'required|string',
            'admin_tasks'      => 'nullable|string',
        ]);

        $nursingLog->update($validated);

        return redirect()->route('nursing-logs.index')
            ->with('success', 'បានកែប្រែកំណត់ត្រាថែទាំដោយជោគជ័យ!');
    }

    /**
     * លុបទិន្នន័យកំណត់ត្រាថែទាំ
     */
    public function destroy(NursingLog $nursingLog)
    {
        $nursingLog->delete();

        return redirect()->route('nursing-logs.index')
            ->with('success', 'បានលុបទិន្នន័យកំណត់ត្រាថែទាំរួចរាល់!');
    }
}

