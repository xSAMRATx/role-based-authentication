<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h2>

        @if(session('error'))
            <div class="mb-4 text-red-600 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li class="mb-1">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

            <input type="password" name="password" placeholder="Password"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Don't have an account?
            <a href="{{ route('manual.register.form') }}" class="text-blue-600 hover:underline">Register here</a>
        </p>
    </div>

</body>
</html>
