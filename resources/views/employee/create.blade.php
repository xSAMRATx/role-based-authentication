@extends('layouts.app')

@section('title', 'Employee Create')


@section('content')
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Create Employee</h1>

        <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <label for="name">Name<span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email">Email<span class="text-red-500">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="space-y-2">
                <label for="role_id">Role<span class="text-red-500">*</span></label>
                <select name="role_id" id="role_id"
                    class="w-full border rounded px-3 py-2 @error('role_id') border-red-500 @enderror">
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $id => $name)
                        <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                            {{ ucfirst($name) }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end items-center space-x-4">
                <a type="button" href="{{ route('employees.index') }}"
                    class="bg-gray-500 text-white hover:bg-gray-600 px-4 py-2 rounded">Cancel</a>

                <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 float-end">Create</button>
            </div>
        </form>
    </div>
@endsection
