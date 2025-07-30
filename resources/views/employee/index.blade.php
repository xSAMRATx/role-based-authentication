@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
    <div class="p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold mb-4">All Employees</h1>

            @if (Auth::user()->hasPermission('add_employee'))
                <div class="mb-4 text-right">
                    <a href="{{ route('employees.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"><i class="fa-solid fa-plus"></i>
                        Add
                        New</a>
                </div>
            @endif

        </div>

        <table class="w-full border text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Phone</th>
                    @if (auth()->user()->role->name !== 'hr manager')
                        <th class="p-2 border">Role</th>
                    @endif
                    <th class="p-2 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $index => $employee)
                    <tr id="row-{{ $employee->id }}" class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $employees->firstItem() + $index }}</td>
                        <td class="p-2 border">{{ $employee->name }}</td>
                        <td class="p-2 border">{{ $employee->email }}</td>
                        <td class="p-2 border">{{ $employee->phone }}</td>
                        @if (auth()->user()->role->name !== 'hr manager')
                            <td class="p-2 border">{{ ucfirst(optional($employee->role)->name) }}</td>
                        @endif
                        <td class="p-2 border space-x-2 text-center">
                            <a href="{{ route('employees.show', $employee->id) }}"
                                class="text-blue-600 hover:text-gray-700">
                                <i class="fa-solid fa-eye" title="Edit"></i>
                            </a>

                            @if (Auth::user()->hasPermission('edit_employee'))
                                <a href="{{ route('employees.edit', $employee->id) }}"
                                    class="text-green-600 hover:text-gray-700">
                                    <i class="fa-solid fa-pen-to-square" title="Edit"></i>
                                </a>
                            @endif

                            @if (Auth::user()->hasPermission('delete_employee'))
                                <button class="btn-delete text-red-600 hover:text-gray-700" data-id="{{ $employee->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            <x-pagination :paginator="$employees" />
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', async () => {
                const id = button.dataset.id;

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
                        const response = await axios.delete(`/employees/${id}`);

                        if (response.data.success) {
                            Swal.fire("Deleted!", "The sale has been deleted.", "success");
                            document.getElementById(`row-${id}`)
                                ?.remove();
                        }
                    } catch (error) {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                }
            });
        });
    </script>
@endpush
