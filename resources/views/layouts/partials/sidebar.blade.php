@php
    $user = Auth::user();
@endphp

<aside class="w-64 bg-white shadow-md p-6 hidden md:block sticky top-16 h-[calc(100vh-64px)] overflow-auto">
    <nav class="space-y-4">
        <a href="{{ route('dashboard') }}"
            class="block py-2 px-4 rounded hover:bg-blue-100 {{ request()->routeIs('dashboard') ? 'bg-blue-200 font-semibold' : '' }}">
            Dashboard
        </a>
        @auth
            <a href="{{ route('myProfile') }}"
                class="block py-2 px-4 rounded hover:bg-blue-100 {{ request()->routeIs('myProfile') ? 'bg-blue-200 font-semibold' : '' }}">
                My Profile
            </a>
        @endauth

        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('hr manager'))
            <a href="{{ route('employees.index') }}"
                class="block py-2 px-4 rounded hover:bg-blue-100 {{ request()->routeIs('employees.*') ? 'bg-blue-200 font-semibold' : '' }}">
                Employee
            </a>

            <a href="{{ route('tasks.index') }}"
                class="block py-2 px-4 rounded hover:bg-blue-100 {{ request()->routeIs('tasks.*') ? 'bg-blue-200 font-semibold' : '' }}">
                Task
            </a>
        @endif

        @if (Auth::user()->hasRole('employee'))
            <a href="{{ route('myTasks') }}"
                class="block py-2 px-4 rounded hover:bg-blue-100 {{ request()->routeIs('mytasks') ? 'bg-blue-200 font-semibold' : '' }}">
                My Tasks
            </a>
        @endif
    </nav>
</aside>
