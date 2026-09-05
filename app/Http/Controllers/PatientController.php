<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Branch;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * បង្ហាញបញ្ជីអ្នកជំងឺទាំងអស់ ( index )
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::with('branch')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('patients.index', compact('patients', 'search'));
    }

    /**
     * បង្ហាញទម្រង់ចុះឈ្មោះអ្នកជំងឺថ្មី ( create )
     */
    public function create()
    {
        $branches = Branch::all();
        return view('patients.create', compact('branches'));
    }

    /**
     * បង្ហាញព័ត៌មានលម្អិតអ្នកជំងឺ និងប្រវត្តិនានា ( show )
     */
    public function show(Patient $patient)
    {
        $patient->load(['branch', 'medicalRecords.doctor', 'surgeries.surgeon', 'nursingLogs.nurse']);
        $invoices = \App\Models\Invoice::where('patient_id', $patient->id)->latest()->get();

        return view('patients.show', compact('patient', 'invoices'));
    }


    /**
     * រក្សាទុកទិន្នន័យអ្នកជំងឺថ្មីចូល Database ( store )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'     => 'required|exists:branches,id',
            'name'          => 'required|string|max:255',
            'gender'        => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'phone_number'  => 'nullable|string|max:20',
            'address'       => 'nullable|string',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')
            ->with('success', 'ចុះឈ្មោះអ្នកជំងឺថ្មីបានជោគជ័យ!');
    }

    /**
     * បង្ហាញទម្រង់កែប្រែទិន្នន័យអ្នកជំងឺ ( edit )
     */
    public function edit(Patient $patient)
    {
        $branches = Branch::all();
        return view('patients.edit', compact('patient', 'branches'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពទិន្នន័យអ្នកជំងឺ ( update )
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'branch_id'     => 'required|exists:branches,id',
            'name'          => 'required|string|max:255',
            'gender'        => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'phone_number'  => 'nullable|string|max:20',
            'address'       => 'nullable|string',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')
            ->with('success', 'កែប្រែទិន្នន័យអ្នកជំងឺបានជោគជ័យ!');
    }

    /**
     * លុបទិន្នន័យអ្នកជំងឺ ( destroy )
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'លុបទិន្នន័យអ្នកជំងឺបានជោគជ័យ!');
    }
}
