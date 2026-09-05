<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * បង្ហាញបញ្ជីឧបករណ៍ពេទ្យ និងឧបករណ៍សង្គ្រោះជីវិត
     */
    public function index(Request $request)
    {
        $equipments = Equipment::with(['branch', 'department'])
            ->latest()
            ->paginate(10);

        return view('equipments.index', compact('equipments'));
    }

    /**
     * ទម្រង់បន្ថែមឧបករណ៍ពេទ្យថ្មី
     */
    public function create()
    {
        $branches = Branch::all();
        $departments = Department::all();

        return view('equipments.create', compact('branches', 'departments'));
    }

    /**
     * រក្សាទុកទិន្នន័យឧបករណ៍ថ្មីចូល Database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'     => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'name'          => 'required|string|max:255',
            'status'        => 'required|in:functional,maintenance,critical',
        ]);

        $validated['last_checked_at'] = now();

        Equipment::create($validated);

        return redirect()->route('equipments.index')
            ->with('success', 'បានបន្ថែមឧបករណ៍ពេទ្យថ្មីដោយជោគជ័យ!');
    }

    /**
     * បង្ហាញព័ត៌មានលម្អិតឧបករណ៍ពេទ្យ
     */
    public function show(Equipment $equipment)
    {
        $equipment->load(['branch', 'department']);
        return view('equipments.show', compact('equipment'));
    }

    /**
     * ទម្រង់កែប្រែព័ត៌មានឧបករណ៍ពេទ្យ
     */
    public function edit(Equipment $equipment)
    {
        $branches = Branch::all();
        $departments = Department::all();

        return view('equipments.edit', compact('equipment', 'branches', 'departments'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពទិន្នន័យឧបករណ៍ពេទ្យ
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'branch_id'     => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'name'          => 'required|string|max:255',
            'status'        => 'required|in:functional,maintenance,critical',
        ]);

        $validated['last_checked_at'] = now();

        $equipment->update($validated);

        return redirect()->route('equipments.index')
            ->with('success', 'បានកែប្រែទិន្នន័យឧបករណ៍ពេទ្យដោយជោគជ័យ!');
    }

    /**
     * លុបទិន្នន័យឧបករណ៍ពេទ្យ
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipments.index')
            ->with('success', 'បានលុបទិន្នន័យឧបករណ៍ពេទ្យរួចរាល់!');
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពស្ថានភាពឧបករណ៍ (ឧ. ដំណើរការល្អ, ជួសជុល, ឬ គ្រោះថ្នាក់)
     */
    public function updateStatus(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'status' => 'required|in:functional,maintenance,critical',
        ]);

        $equipment->update([
            'status'          => $validated['status'],
            'last_checked_at' => now(),
        ]);

        return redirect()->route('equipments.index')
            ->with('success', 'បានធ្វើបច្ចុប្បន្នភាពស្ថានភាពឧបករណ៍រួចរាល់!');
    }
}

