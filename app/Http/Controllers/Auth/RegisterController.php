<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $role_id = Role::where('name', 'employee')->first()->id;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role_id,
        ]);

        Employee::create([
            'user_id' => $user->id,
            'role_id' => $user->role_id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.employee')->with('success', 'Registration successful!');
    }
}
