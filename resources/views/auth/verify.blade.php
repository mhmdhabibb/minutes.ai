<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input::-webkit-textfield-decoration-container {
            display: none;
        }
        input[type="password"]::-ms-reveal {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-md z-10 relative">
        <a href="{{ route('login') }}" class="inline-flex items-center text-gray-600 mb-8 hover:text-gray-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to login
        </a>

        <h1 class="text-4xl font-semibold text-gray-900 mb-2">
            Verify code
        </h1>

        <p class="text-gray-600 mb-8">
            An authentication code has been sent to your email.
        </p>

        <form method="POST" action="{{ route('verify.code') }}">
            @csrf
            <div class="relative mb-6 mt-12">
                <input type="password" id="code" 
                       name="code"
                       class="peer w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder=" " required>

                <label for="code" 
                       class="absolute text-sm bg-white px-1 transition-all duration-200
                              text-gray-500 left-3 -top-2
                              peer-focus:-top-6 peer-focus:text-blue-500 
                              peer-[:not(:placeholder-shown)]:-top-6 peer-[:not(:placeholder-shown)]:text-gray-700">
                    Enter Code
                </label>
                <button type="button" id="toggleVisibility" class="absolute right-3 top-3 text-gray-400">
                    <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 hidden">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <div class="mb-6 text-sm">
                <span class="text-gray-600">Didn't receive a code?</span>
                <button type="button" class="text-blue-600 hover:text-blue-700 font-medium ml-1">Resend</button>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Verify
            </button>
        </form>
    </div>

    <script>
        const toggleVisibility = document.getElementById('toggleVisibility');
        const codeInput = document.getElementById('code');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        toggleVisibility.addEventListener('click', function() {
            if (codeInput.type === 'password') {
                codeInput.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                codeInput.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
