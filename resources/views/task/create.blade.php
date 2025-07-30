@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Create Task</h1>

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <label for="title">Title<span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="status">Status<span class="text-red-500">*</span></label>
                <select name="status" id="status"
                    class="w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', date('Y-m-d')) }}"
                    class="w-full border rounded px-3 py-2 @error('due_date') border-red-500 @enderror">
                @error('due_date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="assigned_to">Assign To<span class="text-red-500">*</span></label>
                <select name="assigned_to" id="assigned_to" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Employee --</option>
                    @foreach ($employees as $id => $name)
                        <option value="{{ $id }}" {{ old('assigned_to') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('assigned_to')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end items-center space-x-4">
                <a href="{{ route('tasks.index') }}"
                    class="bg-gray-500 text-white hover:bg-gray-600 px-4 py-2 rounded">Cancel</a>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Create</button>
            </div>
        </form>
    </div>
@endsection
