<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role->name == 'hr manager') {
            $employees = Employee::whereHas('user.role', function ($query) {
                $query->where('name', 'employee');
            })->paginate(10);
        } else {
            $employees = Employee::with('user')->latest()->paginate(10);
        }

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'admin')->pluck('name', 'id');

        return view('employee.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('123456'), // default password
            'role_id' => $validated['role_id'],
        ]);

        Employee::create([
            'user_id' => $user->id,
            'role_id' => $validated['role_id'] ?? $user->role_id ?? 3,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        $employee = Employee::with('user', 'user.employee')->findOrFail($id);

        return view('employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $roles = Role::where('name', '!=', 'admin')->pluck('name', 'id');

        return view('employee.edit', compact('employee', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
        ]);

        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role_id' => $validated['role_id'],
        ]);

        $employee->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::with('user')->findOrFail($id);

        if ($employee->user) {
            $employee->user->delete();
        }

        $employee->delete();

        return response()->json(array('success' => true));
    }

    public function myProfile()
    {
        $user = Auth::user();

        return view('employee.profile', compact('user'));
    }
}
