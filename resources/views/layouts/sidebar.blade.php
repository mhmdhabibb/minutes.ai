{{-- Sidebar --}}
<div id="sidebar" class="bg-gradient-to-b from-black to-purple-950 text-white w-1/5 min-h-screen p-10 hidden md:hidden lg:block">    <div class="flex justify-center items-center mb-20">
        <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16">
    </div>
    <nav class="space-y-6">
        <a href="{{ route('dashboard') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105 {{ request()->routeIs('dashboard') ? '' : '' }}" data-page="dashboard">
            <i class="fas fa-home mr-2"></i> Dashboard
        </a>
        <a href="{{ route('settings') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105 {{ request()->routeIs('settings') ? '' : '' }}" data-page="settings">
            <i class="fas fa-cog mr-2"></i> Settings
        </a>
        <a href="{{ route('home') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105">
            <i class="fas fa-sign-out-alt mr-2"></i> Log Out
        </a>
    </nav>
</div>

{{-- Mobile Sidebar --}}
<div id="mobile-sidebar" class="fixed top-0 left-0 w-full h-full z-50 flex justify-center items-center">
    <div class="backdrop-blur bg-gradient-to-b from-black to-purple-950 bg-opacity-90 text-white w-full h-full p-10 flex flex-col items-center">
        <div class="flex justify-between items-center mb-20 w-full">
            <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16 mx-auto">
            <button id="close-sidebar" class="text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="space-y-6 text-center">
            <a href="{{ route('dashboard') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105" data-page="dashboard">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            <a href="{{ route('settings') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105" data-page="settings">
                <i class="fas fa-cog mr-2"></i> Settings
            </a>
            <a href="{{ route('home') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105" data-page="logout">
                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
            </a>
        </nav>
    </div>
</div>


