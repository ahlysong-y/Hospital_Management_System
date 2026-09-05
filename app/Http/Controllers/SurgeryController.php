<?php

namespace App\Http\Controllers;

use App\Models\Surgery;
use App\Models\Patient;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    /**
     * បង្ហាញបញ្ជីកាលវិភាគវះកាត់ និងស្ថានភាពប្រតិបត្តិការ
     */
    public function index(Request $request)
    {
        $surgeries = Surgery::with(['patient', 'surgeon', 'branch'])
            ->latest()
            ->paginate(10);

        return view('surgeries.index', compact('surgeries'));
    }

    /**
     * ទម្រង់រៀបចំកាលវិភាគ និងត្រៀមបន្ទប់វះកាត់
     */
    public function create()
    {
        $patients = Patient::all();
        $branches = Branch::all();
        // ជ្រើសរើសបុគ្គលិកដែលមាន Role ជា Doctor ឬ Surgeon
        $surgeons = User::whereIn('role', ['doctor', 'surgeon', 'admin'])->get();

        return view('surgeries.create', compact('patients', 'branches', 'surgeons'));
    }

    /**
     * រក្សាទុកកាលវិភាគវះកាត់ចូល Database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'              => 'required|exists:branches,id',
            'patient_id'             => 'required|exists:patients,id',
            'surgeon_id'             => 'required|exists:users,id',
            'room_number'            => 'required|string|max:50',
            'scheduled_at'           => 'required|date',
            'pre_surgery_assessment' => 'nullable|string',
            'status'                 => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        Surgery::create($validated);

        return redirect()->route('surgeries.index')
            ->with('success', 'បានរៀបចំកាលវិភាគវះកាត់ដោយជោគជ័យ!');
    }

    /**
     * បង្ហាញព័ត៌មានលម្អិតកាលវិភាគវះកាត់
     */
    public function show(Surgery $surgery)
    {
        $surgery->load(['patient', 'surgeon', 'branch']);
        return view('surgeries.show', compact('surgery'));
    }

    /**
     * ទម្រង់កែប្រែកាលវិភាគវះកាត់
     */
    public function edit(Surgery $surgery)
    {
        $patients = Patient::all();
        $branches = Branch::all();
        $surgeons = User::whereIn('role', ['doctor', 'surgeon', 'admin'])->get();

        return view('surgeries.edit', compact('surgery', 'patients', 'branches', 'surgeons'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពកាលវិភាគវះកាត់
     */
    public function update(Request $request, Surgery $surgery)
    {
        $validated = $request->validate([
            'branch_id'              => 'required|exists:branches,id',
            'patient_id'             => 'required|exists:patients,id',
            'surgeon_id'             => 'required|exists:users,id',
            'room_number'            => 'required|string|max:50',
            'scheduled_at'           => 'required|date',
            'pre_surgery_assessment' => 'nullable|string',
            'status'                 => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $surgery->update($validated);

        return redirect()->route('surgeries.index')
            ->with('success', 'បានកែប្រែកាលវិភាគវះកាត់ដោយជោគជ័យ!');
    }

    /**
     * លុបទិន្នន័យកាលវិភាគវះកាត់
     */
    public function destroy(Surgery $surgery)
    {
        $surgery->delete();

        return redirect()->route('surgeries.index')
            ->with('success', 'បានលុបទិន្នន័យកាលវិភាគវះកាត់រួចរាល់!');
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពស្ថានភាពការវះកាត់ (ឧ. ចាប់ផ្តើម ឬ បញ្ចប់)
     */
    public function updateStatus(Request $request, Surgery $surgery)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $surgery->update(['status' => $validated['status']]);

        return redirect()->route('surgeries.index')
            ->with('success', 'បានធ្វើបច្ចុប្បន្នភាពស្ថានភាពវះកាត់រួចរាល់!');
    }
}

