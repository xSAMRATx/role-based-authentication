@extends('layouts.app')

@section('title', 'Employee Profile')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 mt-10">
        <div class="flex items-center space-x-6 mb-6">
            <img class="w-24 h-24 object-cover rounded-full shadow-lg border"
                src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=0D8ABC&color=fff"
                alt="Profile Picture">

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $employee->name }}</h2>
                <p class="text-blue-600">{{ ucfirst($employee->role->name) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Email</h4>
                <p class="text-gray-600">{{ $employee->email }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Phone</h4>
                <p class="text-gray-600">{{ $employee->phone ?? 'N/A' }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Role</h4>
                <p class="text-gray-600">{{ ucfirst($employee->role->name) }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Created At</h4>
                <p class="text-gray-600">{{ $employee->created_at->format('F j, Y') }}</p>
            </div>
        </div>

        <div class="mt-8 flex justify-between">
            <a href="{{ route('employees.index') }}" class="bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded"><i
                    class="fa-solid fa-arrow-left"></i>
                Back</a>

            <a href="{{ route('employees.edit', $employee->id) }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit Profile</a>
        </div>
    </div>
@endsection
