<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set a Password</title>
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
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-40 h-40 bg-gradient-to-br from-orange-400 to-pink-500 rounded-full opacity-50 transform rotate-45"></div>
        <div class="absolute bottom-20 right-20 w-60 h-60 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full opacity-50 transform -rotate-45"></div>
    </div>

    <div class="bg-white rounded-2xl p-8 w-full max-w-md z-10 relative">
        <h1 class="text-3xl font-semibold text-gray-900 mb-2 mt-4">
            Set a password
        </h1>

        <p class="text-gray-600 mb-10">
            Your previous password has been reset. Please set a new password for your account.
        </p>

        <form action="" method="POST">
            @csrf
            <div class="relative mb-8">
                <input type="password" id="password" 
                       class="peer w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder=" " required>
                <label for="password" 
                       class="absolute text-sm bg-white px-1 transition-all duration-200
                              text-gray-500 left-3 -top-2
                              peer-focus:-top-6 peer-focus:text-blue-500 
                              peer-[:not(:placeholder-shown)]:-top-6 peer-[:not(:placeholder-shown)]:text-gray-700">
                    Create Password
                </label>
                <button type="button" class="absolute right-3 top-3 text-gray-400" onclick="togglePasswordVisibility('password', this)">
                    <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>

            <div class="relative mb-8">
                <input type="password" id="confirm-password" 
                       class="peer w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder=" " required>
                <label for="confirm-password" 
                       class="absolute text-sm bg-white px-1 transition-all duration-200
                              text-gray-500 left-3 -top-2
                              peer-focus:-top-6 peer-focus:text-blue-500 
                              peer-[:not(:placeholder-shown)]:-top-6 peer-[:not(:placeholder-shown)]:text-gray-700">
                    Re-enter Password
                </label>
                <button type="button" class="absolute right-3 top-3 text-gray-400" onclick="togglePasswordVisibility('confirm-password', this)">
                    <svg id="eyeClosedConfirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Set password
            </button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility(id, button) {
            const passwordField = document.getElementById(id);
            const passwordType = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = passwordType;

            const eyeIcon = button.querySelector('svg');
            if (passwordType === 'text') {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            } else {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>';
            }
        }
    </script>
</body>
</html>
