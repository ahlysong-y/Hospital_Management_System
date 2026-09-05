<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Patient;
use App\Models\Invoice;
use App\Models\Surgery;
use App\Models\MedicalRecord;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * បង្ហាញទំព័រព័ត៌មាន Profile របស់ Admin / បុគ្គលិក ( Display Admin Profile Page )
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $user->load(['branch', 'department']);
        $branches = Branch::all();

        // ស្ថិតិសង្ខេបសម្រាប់ Admin ក្នុងប្រព័ន្ធ
        $stats = [
            'total_patients font' => Patient::count(),
            'total_invoices font' => Invoice::count(),
            'total_surgeries'     => Surgery::count(),
            'total_records'       => MedicalRecord::count(),
            'total_equipments font'    => Equipment::count(),
        ];

        return view('profile.show', compact('user', 'branches', 'stats'));
    }

    /**
     * ធ្វើបច្ចុប្បន្នភាពព័ត៌មានផ្ទាល់ខ្លួន និង រូបថត Profile ( Update Profile Information & Photo )
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_number'  => ['nullable', 'string', 'max:20'],
            'branch_id'     => ['required', 'exists:branches,id'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ]);

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'បានធ្វើបច្ចុប្បន្នភាពព័ត៌មាន និងរូបថត Profile ដោយជោគជ័យ!');
    }

    /**
     * លុបរូបថត Profile ( Delete Profile Photo )
     */
    public function destroyPhoto(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->update(['profile_photo' => null]);

        return redirect()->route('profile.show')
            ->with('success', 'បានលុបរូបថត Profile រួចរាល់!');
    }


    /**
     * ផ្លាស់ប្តូរពាក្យសម្ងាត់ ( Update Password )
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'បានផ្លាស់ប្តូរពាក្យសម្ងាត់ដោយជោគជ័យ!');
    }
}
