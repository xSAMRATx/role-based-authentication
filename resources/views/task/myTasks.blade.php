@php
    $statusColors = [
        'pending' => 'bg-yellow-200 text-yellow-800',
        'in_progress' => 'bg-blue-200 text-blue-800',
        'completed' => 'bg-green-200 text-green-800',
    ];
@endphp

@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
    <div class="p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold mb-4">My Tasks</h1>
        </div>

        <table class="w-full border text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border text-center">Due Date</th>
                    <th class="p-2 border text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $index => $task)
                    <tr id="row-{{ $task->id }}" class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $tasks->firstItem() + $index }}</td>
                        <td class="p-2 border">{{ $task->title ?? '' }}</td>
                        <td class="p-2 border text-center">{{ $task->due_date->format('d M Y') ?? '' }}
                        <td class="p-2 border text-center"><span
                                class="px-2 py-1 rounded text-sm font-medium {{ $statusColors[$task->status] ?? 'bg-gray-200 text-gray-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            <x-pagination :paginator="$tasks" />
        </div>
    </div>
@endsection
