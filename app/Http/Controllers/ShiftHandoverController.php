<?php



namespace App\Http\Controllers;



use App\Models\ShiftHandover;

use App\Models\User;

use App\Models\Branch;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class ShiftHandoverController extends Controller

{

    /**

     * បង្ហាញបញ្ជីរបាយការណ៍ប្រគល់វេនទាំងអស់

     */

    public function index(Request $request)

    {

        $handovers = ShiftHandover::with(['sender', 'receiver', 'branch'])

            ->latest()

            ->paginate(10);



        return view('handovers.index', compact('handovers'));
    }



    /**

     * ទម្រង់បង្កើតការប្រគល់វេនថ្មី

     */

    public function create()

    {

        $currentUserId = Auth::id();

        $users = User::where('id', '!=', $currentUserId)->get();

        $branches = Branch::all();



        return view('handovers.create', compact('users', 'branches'));
    }



    /**

     * រក្សាទុកទិន្នន័យប្រគល់វេនចូល Database

     */

    public function store(Request $request)

    {

        $validated = $request->validate([

            'branch_id'      => 'required|exists:branches,id',

            'to_user_id'     => 'required|exists:users,id',

            'handover_notes' => 'required|string',

            'handover_time'  => 'required|date',

        ]);



        // កំណត់ ID អ្នកប្រគល់វេនដោយយកពី User ដែលកំពុង Login

        $validated['from_user_id'] = Auth::id();



        ShiftHandover::create($validated);



        return redirect()->route('handovers.index')

            ->with('success', 'បានប្រគល់វេនការងារដោយជោគជ័យ!');
    }

    /**
     * បង្ហាញព័ត៌មានលម្អិតការប្រគល់វេន
     */
    public function show(ShiftHandover $handover)
    {
        $handover->load(['sender', 'receiver', 'branch']);
        return view('handovers.show', compact('handover'));
    }

    /**
     * ទម្រង់កែប្រែការប្រគល់វេន
     */
    public function edit(ShiftHandover $handover)
    {
        $users = User::all();
        $branches = Branch::all();
        return view('handovers.edit', compact('handover', 'users', 'branches'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពការប្រគល់វេន
     */
    public function update(Request $request, ShiftHandover $handover)
    {
        $validated = $request->validate([
            'branch_id'      => 'required|exists:branches,id',
            'to_user_id'     => 'required|exists:users,id',
            'handover_notes' => 'required|string',
            'handover_time'  => 'required|date',
        ]);

        $handover->update($validated);

        return redirect()->route('handovers.index')
            ->with('success', 'បានកែប្រែកំណត់ត្រាប្រគល់វេនដោយជោគជ័យ!');
    }

    /**
     * លុបកំណត់ត្រាប្រគល់វេន
     */
    public function destroy(ShiftHandover $handover)
    {
        $handover->delete();

        return redirect()->route('handovers.index')
            ->with('success', 'បានលុបទិន្នន័យប្រគល់វេនរួចរាល់!');
    }
}
