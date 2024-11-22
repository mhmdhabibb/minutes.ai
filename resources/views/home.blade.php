<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-white">
    <!-- Navigation -->
    <nav class="w-full bg-black">
        <div class="container mx-auto px-4 py-6 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-14">
            </div>
            <div class="hidden md:flex md:justify-center md:flex-grow mr-16 p-2"> 
                <div class="flex space-x-4 rounded-full border border-white px-6 p-2">
                    <button class="px-4 py-2 text-white hover:bg-gray-700 rounded" data-target="about">About</button>
                    <button class="px-4 py-2 text-white hover:bg-gray-700 rounded" data-target="features">Features</button>
                </div>
            </div>
            <div class="md:hidden relative">
                <button id="hamburger" class="text-white focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <!-- Dropdown menu-->
                <div id="mobile-menu" class="hidden absolute right-0 mt-2 z-20"> 
                    <div class="flex flex-col space-y-2 border border-white rounded-lg p-4  backdrop-blur bg-white bg-opacity-10"> 
                        <button class="px-4 py-2 text-white hover:bg-gray-700 rounded" data-target="about">About</button>
                        <button class="px-4 py-2 text-white hover:bg-gray-700 rounded" data-target="features">Features</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
        document.querySelectorAll('nav button[data-target]').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 80, 
                        behavior: 'smooth' 
                    });
                }
            });
        });
    
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
    
        hamburger.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    
    
    <!-- Hero Section -->
    <section class="w-full bg-black relative min-h-screen">
        <div class="absolute inset-0 h-full bg-gradient-to-t from-purple-900/30 to-transparent"></div>
        <div class="container mx-auto px-4 text-center py-20 relative z-10">
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold text-center leading-tight">
                <span class="bg-gradient-to-r from-[#FF00FF] via-[#FFC0CB] to-[#9370DB] text-transparent bg-clip-text">
                    Transform Your Voice Into Text
                </span>
                <br />
                <span class="bg-gradient-to-r from-[#FFC0CB] via-[#9370DB] to-[#8A2BE2] text-transparent bg-clip-text">
                    With AI Precision
                </span>
            </h1>
        
            <p class="text-gray-400 mt-4 mb-8 max-w-2xl mx-auto" style="font-size: 22px;">
                Canvanotes is a web-based application designed to automatically <br>
                convert voice to text (speech-to-text).
            </p>
            
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-3 rounded-full bg-white text-black text-xl">Try it out</a>
                <a href="{{ route('signup') }}" class="px-6 py-3 rounded-full bg-blue-600 text-xl">Get started free</a>
            </div>
            
            <div class="mt-8">
                <img src="{{ asset('asset/img/convo.svg') }}" alt="AI Illustration" class="mx-auto -mt-8">
            </div>
        </div>
    </section>
    
    
    <!-- About Section -->
    <section id="about" class="container mx-auto px-4 py-16 flex items-center">
        <div class="w-1/2">
            <h2 class="text-4xl font-bold text-indigo-400 mb-4">About</h2>
            <p class="text-gray-400">
                Canvanotes is a web-based application designed to automatically convert voice to text (speech-to-text). 
                This application makes it easy for users to record conversations or speeches, then quickly convert 
                them into text that can be edited, saved or shared.
            </p>
            <p class="text-gray-400 mt-4">
                Was created in 2024, Canvanotes is web-based application, 
                the function is to help the user in transcripting an audio 
                into a text. Transcripting an audio by your voices or files.
            </p>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('asset/img/convn.png') }}" alt="About Illustration" class="ml-auto">
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="features" class="flex items-center justify-center p-16">
        <div class="bg-black bg-gradient-to-b from-black to-purple-900/50 rounded-[40px] p-16 max-w-full w-full">
            <h1 class="text-[#8B5CF6] text-6xl font-bold text-center mb-4">
                Features
            </h1>
            <p class="text-white text-center text-xl mb-16 max-w-3xl mx-auto">
                Intuitive design that allows easy editing, searching, and exporting of transcriptions and summaries
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6"> 
                <!-- Record Audio Card -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-8 flex flex-col items-center text-center">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"></path>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                            <line x1="12" x2="12" y1="19" y2="22"></line>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold mb-4">Record Audio</h2>
                    <p class="text-gray-300">Start recording instantly with a single tap for ease of use.</p>
                </div>
            
                <!-- Auto create summary Card -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-8 flex flex-col items-center text-center">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                            <path d="M3 3v5h5"></path>
                            <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path>
                            <path d="M16 16h5v5"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold mb-4">Auto Create Summary</h2>
                    <p class="text-gray-300">Highlights key points and essential information for quick understanding.</p>
                </div>
            
                <!-- Auto create Transcript Card -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-8 flex flex-col items-center text-center">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold mb-4">Auto Create Transcript</h2>
                    <p class="text-gray-300">Automatically transcribes spoken words into text instantly.</p>
                </div>
            </div>
            
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-black text-white py-28 px-4 md:px-8 relative">
        <div class="absolute top-0 left-0 right-0 h-1/2 bg-gradient-to-b from-purple-900/50 to-transparent"></div>
    
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-5xl font-bold leading-tight">Frequently Asked Questions</h2>
                </div>
                <div class="space-y-4">
                    <div class="bg-white rounded-2xl p-6 text-[#111827]">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleAnswer('answer1', this)">
                            <span class="font-semibold">Are there any limitations applied in an application, such as <br> the application only being able to transcribe in Indonesian or <br>English?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 transition-transform duration-300 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="answer1" class="mt-4 overflow-hidden transition-all duration-300 ease-in-out" style="max-height: 200px;">
                            <p class="text-gray-600">For now, we have decided to use two languages, Indonesian and English.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 text-[#111827]">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleAnswer('answer2', this)">
                            <span class="font-semibold">What is the recording format and tools used for recording?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="answer2" class="mt-4 overflow-hidden transition-all duration-300 ease-in-out" style="max-height: 0;">
                            <p class="text-gray-600">The recording format is typically MP3 or WAV, and we recommend using tools like Zoom or any other digital recording device.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 text-[#111827]">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleAnswer('answer3', this)">
                            <span class="font-semibold">Is the website free?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="answer3" class="mt-4 overflow-hidden transition-all duration-300 ease-in-out" style="max-height: 0;">
                            <p class="text-gray-600">Yes, the basic features of the website are free to use, but there may be premium features available for a fee.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 text-[#111827]">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleAnswer('answer4', this)">
                            <span class="font-semibold">Is this application an extension in Zoom or only available on the web?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="answer4" class="mt-4 overflow-hidden transition-all duration-300 ease-in-out" style="max-height: 0;">
                            <p class="text-gray-600">Currently, the application is only available on the web, but we are planning to develop an extension for Zoom in the future.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function toggleAnswer(answerId, button) {
            const answer = document.getElementById(answerId);
            const svg = button.querySelector('svg');
            
            if (answer.style.maxHeight === '0px') {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                svg.classList.add('rotate-180');
            } else {
                answer.style.maxHeight = '0px';
                svg.classList.remove('rotate-180');
            }
        }
    
        window.onload = function() {
            const firstAnswer = document.getElementById('answer1');
            if (firstAnswer) {
                firstAnswer.style.maxHeight = firstAnswer.scrollHeight + 'px';
            }
        }
    </script>
    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
    
    <!-- CTA Section -->
    <section class="flex flex-col justify-between items-center p-16">
        <div class="bg-black rounded-[40px] w-full max-w-full p-16 flex flex-col items-center justify-center min-h-[600px] relative overflow-hidden">
            <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-purple-900/50 to-transparent"></div>
            
            <div class="relative z-10 text-center">
                <h1 class="text-white text-5xl font-bold mb-4">
                    Effortlessly Transcribe Your Meetings
                </h1>
                <p class="text-white text-xl mb-12">
                    Try It Now
                </p>
                <a href="#" class="inline-flex items-center justify-center bg-gradient-to-r from-purple-900/60 to-transparent border border-gray-800 rounded-full px-8 py-4 text-white text-lg hover:bg-gradient-to-r hover:from-purple-600/50 hover:to-transparent transition-colors">
                    <span class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </span>
                    Get Started For Free
                </a>
            </div>
        </div>
        <footer class="text-black text-sm mt-6"> 
            ©2024 CONVONOTES · All rights reserved.
        </footer>
    </section>
    
</body>
</html> 