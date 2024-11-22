<!-- resources/views/auth/signup.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-center bg-repeat" style="background-image: url('{{ asset('asset/img/signup.jpg') }}'); background-size: contain;">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800">Sign up</h2>
        <p class="text-center text-gray-500">Let’s get you all set up so you can access your personal account.</p>

        <!-- Signup Form -->
        <form method="POST" action="{{ route('signup') }}" class="space-y-4">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 mt-1 border border-gray-300 rounded" placeholder="John Doe" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 mt-1 border border-gray-300 rounded" placeholder="john.doe@gmail.com" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full p-2 mt-1 border border-gray-300 rounded" required>
                    <button type="button" class="absolute inset-y-0 right-2 text-gray-500 focus:outline-none">
                        <!-- Eye icon for show/hide password -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 mt-1 border border-gray-300 rounded" required>
                    <button type="button" class="absolute inset-y-0 right-2 text-gray-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-center">
                <input type="checkbox" id="terms" name="terms" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500" required>
                <label for="terms" class="ml-2 text-sm text-gray-600">I agree to all the Terms and Privacy Policies</label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full p-2 text-white bg-purple-600 rounded hover:bg-purple-700">Create account</button>
            </div>

            <!-- Already have an account -->
            <p class="text-center text-gray-600">
                Already have an account? <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Login</a>
            </p>
        </form>
    </div>
</body>
</html>
