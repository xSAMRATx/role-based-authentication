<nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between fixed top-0 left-0 right-0 z-20">
    <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-orange-500">MyApp</a>

    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2">
            <a href="{{ route('myProfile') }}" class="flex items-center space-x-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                class="w-8 h-8 rounded-full border" />
            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
            </a>
        </div>

        <a href="#" onclick="event.preventDefault(); logout();" title="Logout">
            <i class="fa-solid fa-power-off text-2xl text-orange-500 hover:text-orange-800 transition"></i>
        </a>
    </div>
</nav>

<!-- Axios CDN -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Sweetalert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function logout() {
        axios.post("{{ route('logout') }}", {}, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                window.location.href = "{{ route('manual.login.form') }}";
            })
            .catch(error => {
                console.error('Logout failed:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Logout Failed',
                    text: 'Something went wrong while logging out or login again.',
                    confirmButtonColor: '#e3342f'
                });
            });
    }
</script>
