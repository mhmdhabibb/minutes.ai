<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        #mobile-sidebar {
            transition: transform 0.5s ease; 
            transform: translateX(-100%);
        }
        #mobile-sidebar.show {
            transform: translateX(0); 
        }
        #record-popup {
            display: none;
            backdrop-filter: blur(15px);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-white w-1/5 min-h-screen p-10 hidden md:hidden lg:block">
            <div class="flex justify-center items-center mb-20">
                <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16">
            </div>
            <nav class="space-y-6">
                <a class="text-lg flex items-center p-2 rounded menu-item bg-[#624b6e]" href="#" data-page="dashboard">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <a class="text-lg flex items-center p-2 rounded menu-item" href="#" data-page="settings">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <a class="text-lg flex items-center p-2 rounded menu-item" href="#" data-page="logout">
                    <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                </a>
            </nav>
        </div>

        <div class="flex-1 p-12">
            <div class="flex justify-between items-center mb-16">
                <button id="hamburger" class="lg:hidden p-2 mr-4 text-black focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-3xl font-bold">Welcome back!</h1>
                <div class="flex items-center">
                    <img alt="User avatar" class="rounded-full" height="50" src="{{ asset('asset/img/s.jpg') }}" width="50"/>
                </div>
            </div>            

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-10 mb-16">
                <button onclick="openRecordPopup()" class="bg-purple-600 text-white w-full h-40 py-4 rounded-lg text-xl flex flex-col items-center justify-center">
                    <i class="fas fa-microphone mb-4 text-3xl"></i>
                    Record Audio
                </button>
                <button class="bg-teal-500 text-white w-full h-40 py-4 rounded-lg text-xl flex flex-col items-center justify-center">
                    <i class="fas fa-upload mb-4 text-3xl"></i>
                    Upload Audio
                </button>
            </div>
            
            <div>
                <div>
                    <h2 class="text-xl font-bold mb-4">History Summary</h2>
                    <div class="mb-12 relative">
                        <input 
                            class="w-full md:w-1/3 p-4 pl-10 bg-transparent border border-gray-400 rounded-lg placeholder-gray-500" 
                            placeholder="Search Title" 
                            type="text" 
                        />
                        <i class="fas fa-search absolute left-3 top-5 text-gray-400"></i>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <div>
                        <p class="text-gray-500 mb-2">Monday, 01 December 2024</p>
                        <div class="bg-white p-7 rounded-lg shadow flex justify-between items-center">
                            <p class="text-purple-600 text-xl font-semibold">Data Meeting Bpdsm</p>
                            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                                <button class="border border-blue-500 text-blue-500 py-2 px-2 rounded-lg hover:bg-blue-50">Lihat Transcript</button>
                                <button class="bg-blue-500 text-white py-2 px-2 rounded-lg">Download</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-2">Friday, 12 October 2024</p>
                        <div class="bg-white p-7 rounded-lg shadow flex justify-between items-center">
                            <p class="text-purple-600 text-xl font-semibold">Data Meeting Bpdsm</p>
                            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                                <button class="border border-blue-500 text-blue-500 py-2 px-2 rounded-lg hover:bg-blue-50">Lihat Transcript</button>
                                <button class="bg-blue-500 text-white py-2 px-2 rounded-lg">Download</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-2">Wednesday, 08 October 2024</p>
                        <div class="bg-white p-7 rounded-lg shadow flex justify-between items-center">
                            <p class="text-purple-600 text-xl font-semibold">Data Meeting Bpdsm</p>
                            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                                <button class="border border-blue-500 text-blue-500 py-2 px-2 rounded-lg hover:bg-blue-50">Lihat Transcript</button>
                                <button class="bg-blue-500 text-white py-2 px-2 rounded-lg">Download</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar" class="fixed inset-0 z-50 hidden">
            <div class="backdrop-blur bg-black bg-opacity-80 text-white  w-3/4 h-full p-10">
                <div class="flex justify-between items-center mb-20">
                    <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16">
                    <button id="close-sidebar" class="text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="space-y-6">
                    <a class="text-lg flex items-center p-2 rounded menu-item bg-[#624b6e]" href="#" data-page="dashboard">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a class="text-lg flex items-center p-2 rounded menu-item" href="#" data-page="settings">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                    <a class="text-lg flex items-center p-2 rounded menu-item" href="#" data-page="logout">
                        <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                    </a>
                </nav>
            </div>
        </div>

        <div id="record-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-2xl shadow-lg p-6 w-[410px]">
                <div class="flex justify-between items-center  mt-2">
                    <h2 class="text-xl font-semibold">Record Audio</h2>
                    <button onclick="closeRecordPopup()" class="focus:outline-none">
                        <i class="far fa-times-circle text-2xl text-gray-600 hover:text-gray-500"></i>
                    </button>
                </div>
                <p class="text-gray-500 ">Record your Audio and start recording</p>
                <hr class="border-t-2 border-gray-300 my-2 mb-6">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Topic</label>
                    <input type="text" placeholder="Fill the topic..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-8">
                    <label class="block text-gray-700 mb-2">Select Language</label>
                    <div class="relative">
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                            <option value="english" selected>English</option>
                            <option value="indonesia">Indonesia</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-500 pointer-events-none"></i>
                    </div>
                </div>
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg mb-2 hover:bg-blue-700">Start Recording</button>
                <button class="w-full border border-blue-600 text-blue-600 py-2 rounded-lg hover:bg-blue-50">Another Option</button>
            </div>
        </div>
        
    </div>
    @if(session('status'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        const menuItems = document.querySelectorAll('.menu-item');
        const hamburger = document.getElementById('hamburger');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const recordPopup = document.getElementById('record-popup');

        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                menuItems.forEach(i => {
                    i.classList.remove('bg-[#624b6e]');
                });

                item.classList.add('bg-[#624b6e]');
            });
        });

        hamburger.addEventListener('click', () => {
            mobileSidebar.classList.remove('hidden'); 
            setTimeout(() => mobileSidebar.classList.add('show'), 10); 
        });

        closeSidebar.addEventListener('click', () => {
            mobileSidebar.classList.remove('show'); 
            setTimeout(() => mobileSidebar.classList.add('hidden'), 300); 
        });

        function openRecordPopup() {
            recordPopup.style.display = 'flex';
        }

        function closeRecordPopup() {
            recordPopup.style.display = 'none';
        }
    </script>
</body>
</html>
