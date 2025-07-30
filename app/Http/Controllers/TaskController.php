<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::latest()->paginate(10);
        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $employees = User::whereHas('role', function ($query) {
            $query->where('name', 'employee');
        })->pluck('name', 'id');

        return view('task.create', compact('employees'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date|after_or_equal:today',
            'assigned_to' => 'required|exists:users,id'
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        abort(403);
    }

    public function edit(Task $task)
    {
        $employees = User::whereHas('role', function ($query) {
            $query->where('name', 'employee');
        })->pluck('name', 'id');

        return view('task.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date|after_or_equal:today',
            'assigned_to' => 'required|exists:users,id'
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json(array('success' => true));
    }

    public function myTasks()
    {
        $user = Auth::user();

        $tasks = Task::where('assigned_to', $user->id)->latest()->paginate(10);

        return view('task.myTasks', compact('tasks'));
    }
}
