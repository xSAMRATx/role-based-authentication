{{-- Header --}}
@include('layouts.partials.header')

{{-- Navbar --}}
@include('layouts.partials.navbar')

<div class="flex flex-1 pt-16 min-h-[calc(100vh-64px)]">
    {{-- Sidebar --}}
    @include('layouts.partials.sidebar')

    {{-- Main content --}}
    <main class="flex-1 p-8 overflow-auto">
        @yield('content')
    </main>
</div>

{{-- Page-specific scripts --}}
@stack('js')
</body>

</html>
