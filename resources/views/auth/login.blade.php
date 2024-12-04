<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <style>
        input::-webkit-textfield-decoration-container {
            display: none;
        }
        input[type="password"]::-ms-reveal {
            display: none;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-center bg-repeat" style="background-image: url('{{ asset('asset/img/login.jpg') }}'); background-size: contain;">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800">Login</h2>
        <p class="text-center text-gray-500">Login to access your Convonotes account.</p>
        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf   

            @if(session('success'))
                <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 mt-1 border border-gray-300 rounded" placeholder="john.doe@gmail.com" required value="{{ old('email') }}">
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full p-2 mt-1 border border-gray-300 rounded" required>
                    <button type="button" id="toggleVisibility" class="absolute text-gray-400 right-3 top-3 focus:outline-none">
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="hidden w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <a href="{{ route('forgot-password') }}" class="text-sm text-purple-600 hover:underline">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full p-2 text-white bg-purple-600 rounded hover:bg-purple-700">Login</button>
            </div>

            <!-- Sign Up Link -->
            <p class="text-center text-gray-600">
                Don't have an account? <a href="{{ route('signup') }}" class="text-purple-600 hover:underline">Sign up</a>
            </p>
        </form>
    </div>

    <script>
        const toggleVisibility = document.getElementById('toggleVisibility');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        toggleVisibility.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
