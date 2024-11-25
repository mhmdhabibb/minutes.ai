<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice to Text AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-black bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('asset/img/pass.png') }}');">
    <div class=" min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md z-10 relative">
            <a href="{{ route('login') }}" class="inline-flex items-center text-gray-600 mb-8 hover:text-gray-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to login
            </a>
    
            <h1 class="text-3xl font-semibold text-gray-800 mb-2">
                Forgot your password?
            </h1>
    
            <p class="text-gray-600 mb-8">
                Don't worry, happens to all of us. Enter your email below to recover your password
            </p>
            @if (session('status'))
                <div class="bg-green-500 text-white p-2 rounded-lg mb-4">
                    {{ session('status') }}
                </div>
            @endif
    
            <form method="POST" action="">
                @csrf
                
                <div class="relative mb-6 mt-10">
                    <input type="email" id="email" name="email" 
                           class="peer w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            @error('email') @enderror"
                           placeholder=" " value="{{ old('email') }}" required autofocus>
                    <label for="email" 
                           class="absolute text-sm bg-white px-1 transition-all duration-200
                                  text-gray-500 left-3 -top-2
                                  peer-focus:-top-6 peer-focus:text-blue-500 
                                  peer-[:not(:placeholder-shown)]:-top-6 peer-[:not(:placeholder-shown)]:text-gray-700">
                        Email
                    </label>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <a href="">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors mt-2">
                        Submit
                    </button>
                </a>
            </form>
        </div>
    </div>
</body>
