<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DASHBOARD')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #mobile-sidebar {
            transition: transform 0.5s ease; 
            transform: translateX(-100%);
        }
        #mobile-sidebar.show {
            transform: translateX(0); 
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gotu&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex">
        @include('admin.layouts.sidebar')

        <div class="flex-1 p-12">
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>
    

    @stack('scripts')
    <script>
        const menuItems = document.querySelectorAll('.menu-item');
        const hamburger = document.getElementById('hamburger');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        
    
        hamburger.addEventListener('click', () => {
            mobileSidebar.classList.remove('hidden'); 
            setTimeout(() => mobileSidebar.classList.add('show'), 10); 
        });
    
        closeSidebar.addEventListener('click', () => {
            mobileSidebar.classList.remove('show'); 
            setTimeout(() => mobileSidebar.classList.add('hidden'), 300); 
        });
    </script>

    
</body>
</html>