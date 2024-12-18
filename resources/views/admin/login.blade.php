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
        .backdrop-blur {
            backdrop-filter: blur(15px);
        }

    </style>
</head>
<body class=" flex items-center justify-center min-h-screen bg-center bg-repeat" style="background-image: url('{{ asset('asset/img/login.jpg') }}'); background-size: contain;">
    <div class="w-full max-w-md p-10 space-y-4 bg-white bg-opacity-10  backdrop-blur rounded-xl shadow-xl ">
        <h2 class="text-3xl font-bold text-center text-white">Hello Admin</h2>
        <p class="text-center mb text-white">Login to Manage Convonotes Website.</p>
        <!-- Login Form -->
        <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
            @csrf   

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-normal text-white">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 mt-1 border border-gray-300 rounded" placeholder="admin@gmail.com" required value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-normal text-white">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full p-2 mt-1 border border-gray-300 rounded" required>
                    <button type="button" id="toggleVisibility" class="absolute right-3 top-3 text-gray-400 focus:outline-none">
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full p-2 mt-5 text-white bg-purple-600 rounded hover:bg-purple-700">Login</button>
            </div>
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
