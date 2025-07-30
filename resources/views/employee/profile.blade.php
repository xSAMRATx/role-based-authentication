@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 mt-10">
        <div class="flex items-center space-x-6 mb-6">
            <img class="w-24 h-24 object-cover rounded-full shadow-lg border"
                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff"
                alt="Profile Picture">

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-blue-600">{{ ucfirst($user->role->name) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Email</h4>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Phone</h4>
                <p class="text-gray-600">{{ $user->phone ?? '01971xxxxxx' }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Role</h4>
                <p class="text-gray-600">{{ ucfirst($user->role->name) }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700 mb-1">Created At</h4>
                <p class="text-gray-600">{{ $user->created_at->format('F j, Y') }}</p>
            </div>
        </div>
    </div>
@endsection
