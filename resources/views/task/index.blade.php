@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <div class="p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold mb-4">All tasks</h1>

            <div class="mb-4 text-right">
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"><i
                        class="fa-solid fa-plus"></i> Add
                    New</a>
            </div>
        </div>

        <table class="w-full border text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Assigned To</th>
                    <th class="p-2 border">Due Date</th>
                    <th class="p-2 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $index => $task)
                    <tr id="row-{{ $task->id }}" class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $tasks->firstItem() + $index }}</td>
                        <td class="p-2 border">{{ $task->title }}</td>
                        <td class="p-2 border">{{ $task->assignedTo->name ?? '' }}</td>
                        <td class="p-2 border">{{ $task->due_date->format('d M Y') }}
</td>
                        <td class="p-2 border space-x-2 text-center">
                            @if (Auth::user()->hasPermission('edit_task'))
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-green-600 hover:text-gray-700">
                                    <i class="fa-solid fa-pen-to-square" title="Edit"></i>
                                </a>
                            @endif

                            @if (Auth::user()->hasPermission('delete_task'))
                                <button class="btn-delete text-red-600 hover:text-gray-700" data-id="{{ $task->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            @endif
                        </td>
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

@push('js')
    <script>
        const deleteButton = document.querySelector('.btn-delete');

        if (deleteButton) {
            deleteButton.addEventListener('click', async () => {
                const id = deleteButton.dataset.id;

                const result = await Swal.fire({
                    title: 'Are you sure, you want to delete this record?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                });

                if (result.isConfirmed) {
                    try {
                        const response = await axios.delete(`/tasks/${id}`);

                        if (response.data.success) {
                            Swal.fire("Deleted!", "The task has been deleted.", "success");
                            document.getElementById(`row-${id}`)?.remove();
                        }
                    } catch (error) {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                }
            });
        }
    </script>
@endpush
