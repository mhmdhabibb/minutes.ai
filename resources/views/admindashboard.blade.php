<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admindashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gotu&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
        </style>
</head>
<body class="font-sans bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="hidden w-1/5 min-h-screen p-10 text-white bg-black md:hidden lg:block">
            <div class="flex items-center justify-center mb-20">
                <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16">
            </div>
            <nav class="space-y-6">
                <a class="text-lg flex items-center p-2 rounded menu-item bg-[#7A2AEF]" href="#" data-page="dashboard">
                    <i class="mr-2 fas fa-home"></i> Dashboard
                </a>
                <a class="flex items-center p-2 text-lg rounded menu-item" href="#" data-page="Model AI">
                    <i class="mr-2 fas fa-sign-out-alt"></i> Model AI
                </a>
                <a class="flex items-center p-2 text-lg rounded menu-item" href="#" data-page="settings">
                    <i class="mr-2 fas fa-cog"></i> Settings
                </a>
                <a class="flex items-center p-2 text-lg rounded menu-item" href="#" data-page="logout">
                    <i class="mr-2 fas fa-sign-out-alt"></i> Log Out
                </a>
            </nav>
        </div>

        <div class="flex-1">
            <div class="flex items-center justify-between px-10 py-4 bg-white ">
                <button id="hamburger" class="p-2 mr-4 text-black lg:hidden focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-2xl font-bold leading-relaxed">Welcome back!</h1>
                <div class="flex items-center">
                    <img alt="User avatar" class="rounded-lg" height="50" src="{{ asset('asset/img/avatar.png') }}" width="50"/>
                </div>

                
            </div>            
            <div class="p-10 mb-12">
                <div class="grid grid-cols-1 gap-6 mb-4 md:grid-cols-2 lg:grid-cols-6"> 
                    <div class="p-6 bg-[#531EA3] border-gray-100 rounded-md">
                        <div class="text-2xl font-normal text-[#ffff]">Total User</div>
                        <div class="text-2xl font-bold text-[#ffff] ">10</div>
                    </div>
                </div>
                            
            {{-- </div>
            <section class="mx-10 mb-10 ">
                <div class=" w-full p-2 bg-white border border-[#EBEFF2] grid grid-cols-3">

                    <div class="divide-[#EBEFF2]  md:divide-y"> 
                        <div class=" text-xl font-medium text-[#343434]">No</div>
                        <div class=" divide-[#EBEFF2] md:divide-y">
                            <div class="text-xl font-normal text-[#343434]">01</div>
                            <div class="text-xl font-normal text-[#343434]">02</div>
                            <div class="text-xl font-normal text-[#343434]">03</div>
                            <div class="text-xl font-normal text-[#343434]">04</div>   
                            <div class="text-xl font-normal text-[#343434]">05</div>         
                        </div>
                    </div>
                    <div class="divide-[#EBEFF2] md:divide-y">
                        <div class="text-xl font-medium text-[#343434]">Name</div>
                        <div class="divide-[#EBEFF2] md:divide-y">
                            <div class="text-xl font-normal text-[#343434]">Ujang</div>
                            <div class="text-xl font-normal text-[#343434]">Uchiha inoen</div>
                            <div class="text-xl font-normal text-[#343434]">Uchiha imin</div>
                            <div class="text-xl font-normal text-[#343434]">Gojo no inoen</div>
                            <div class="text-xl font-normal text-[#343434]">saitimin</div>
                        </div>
                    </div>

                    <div class="divide-[#EBEFF2]  md:divide-y"> 
                        <div class=" text-xl font-medium text-[#343434]">Email</div>
                        <div class=" divide-[#EBEFF2] md:divide-y">
                            <div class="text-xl font-normal text-[#343434]">Ujang@gmail.com</div>
                            <div class="text-xl font-normal text-[#343434]">Uchiha@gmail.com</div>
                            <div class="text-xl font-normal text-[#343434]">Uchiha@gmail.com</div>
                            <div class="text-xl font-normal text-[#343434]">inoen@gmail.com</div>   
                            <div class="text-xl font-normal text-[#343434]">saitimin@gmail.com</div>          
                        </div>
                        
                    </div>



            </section>
            </div>
             --}}
             <table class="p-6 w-full font-sans border-2  border-[#EBEFF2]">
                    
                <thead class="text-[#343434]">
                    <tr>
                        <th class="px-4 py-2 text-left bg-white ">No</th>
                        <th class="px-4 py-2 text-left bg-white">Name</th>
                        <th class="px-4 py-2 text-left bg-white">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="px-4 py-2 border-t text-[#8E92BC] font-semibold">01</td>
                        <td class="px-4 py-2 border-t">Muhammad habib</td>
                        <td class="px-4 py-2 border-t">muhammadhabib@gmail</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="px-4 py-2 border-t text-[#8E92BC] font-semibold">02</td>
                        <td class="px-4 py-2 border-t">Sarutobi inoen</td>
                        <td class="px-4 py-2 border-t">Sarutobinoen@gmail</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="px-4 py-2 border-t text-[#8E92BC] font-semibold">03</td>
                        <td class="px-4 py-2 border-t">Asep Pendragon</td>
                        <td class="px-4 py-2 border-t">Asep Pendragon@gmail</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="px-4 py-2 border-t text-[#8E92BC] font-semibold">04</td>
                        <td class="px-4 py-2 border-t">Uchiha Imin</td>
                        <td class="px-4 py-2 border-t">Uchiha Imin@gmail</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="px-4 py-2 border-t text-[#8E92BC] font-semibold">05</td>
                        <td class="px-4 py-2 border-t">Mutanti</td>
                        <td class="px-4 py-2 border-t">Mutanti@gmail</td>
                    </tr>
                
                </tbody>
            </table>
        
        
            
                
        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar" class="fixed inset-0 z-50 hidden">
            <div class="w-3/4 h-full p-10 text-white bg-black backdrop-blur bg-opacity-80">
                <div class="flex items-center justify-between mb-20">
                    <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16">
                    <button id="close-sidebar" class="text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="space-y-6">
                    <a class="text-lg flex items-center p-2 rounded menu-item bg-[#7A2AEF]" href="#" data-page="dashboard">
                        <i class="mr-2 fas fa-home"></i> Dashboard
                    </a>
                    <a class="flex items-center p-2 text-lg rounded menu-item" href="#" data-page="settings">
                        <i class="mr-2 fas fa-cog"></i> Model AI
                    </a>
                    <a class="flex items-center p-2 text-lg rounded menu-item" href="#" data-page="logout">
                        <i class="mr-2 fas fa-sign-out-alt"></i> Settings
                    </a>
                    <a class="flex items-center p-2 text-lg rounded menu-item" href="#" data-page="logout">
                        <i class="mr-2 fas fa-sign-out-alt"></i> Log Out
                    </a>
                </nav>
            </div>
        </div>

        
    </div>

   

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
