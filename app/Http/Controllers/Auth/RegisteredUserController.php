<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * បង្ហាញទម្រង់ចុះឈ្មោះគណនីបុគ្គលិកថ្មី ( Display Register View )
     */
    public function create()
    {
        $branches = Branch::all();
        $departments = Department::all();

        return view('auth.register', compact('branches', 'departments'));
    }

    /**
     * រក្សាទុកទិន្នន័យចុះឈ្មោះ និង Login ចូលប្រព័ន្ធអូតូ ( Store Registration )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'branch_id'     => ['required', 'exists:branches,id'],
            'role'          => ['required', 'in:admin,doctor,nurse,staff'],
            'phone_number'  => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'branch_id'    => $request->branch_id,
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'phone_number' => $request->phone_number,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'ចុះឈ្មោះគណនីថ្មី និងចូលប្រើប្រព័ន្ធបានជោគជ័យ!');
    }
}
