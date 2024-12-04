{{-- Sidebar --}}



<div id="sidebar" class="hidden w-1/5 min-h-screen p-10 text-white bg-gradient-to-b from-black to-purple-950 md:hidden lg:block">    <div class="flex items-center justify-center mb-20">
    <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16">
</div>
<nav class="space-y-6">
    <a href="{{ route('dashboard') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105 {{ request()->routeIs('dashboard') ? '' : '' }}" data-page="dashboard">
        <i class="mr-2 fas fa-home"></i> Dashboard
    </a>
    <a href="{{ route('adminsettings') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105 {{ request()->routeIs('settings') ? '' : '' }}" data-page="settings">
        <i class="mr-2 fas fa-cog"></i> Model AI
    </a>
    <a href="{{ route('adminsettings') }}" class="text-lg flex items-center p-2 rounded menu-item transition-transform hover:scale-105 {{ request()->routeIs('settings') ? '' : '' }}" data-page="settings">
        <i class="mr-2 fas fa-cog"></i> Settings
    </a>
    <a href="{{ route('home') }}" class="flex items-center p-2 text-lg transition-transform rounded menu-item hover:scale-105">
        <i class="mr-2 fas fa-sign-out-alt"></i> Log Out
    </a>
</nav>
</div>

{{-- Mobile Sidebar --}}
<div id="mobile-sidebar" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full">
<div class="flex flex-col items-center w-full h-full p-10 text-white backdrop-blur bg-gradient-to-b from-black to-purple-950 bg-opacity-90">
    <div class="flex items-center justify-between w-full mb-20">
        <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16 mx-auto">
        <button id="close-sidebar" class="text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <nav class="space-y-6 text-center">
        <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-lg transition-transform rounded menu-item hover:scale-105" data-page="dashboard">
            <i class="mr-2 fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('settings') }}" class="flex items-center p-2 text-lg transition-transform rounded menu-item hover:scale-105" data-page="settings">
            <i class="mr-2 fas fa-cog"></i> Model AI
        </a>
        <a href="{{ route('settings') }}" class="flex items-center p-2 text-lg transition-transform rounded menu-item hover:scale-105" data-page="settings">
            <i class="mr-2 fas fa-cog"></i> Settings
        </a>
        <a href="{{ route('home') }}" class="flex items-center p-2 text-lg transition-transform rounded menu-item hover:scale-105" data-page="logout">
            <i class="mr-2 fas fa-sign-out-alt"></i> Log Out
        </a>
    </nav>
</div>
</div>


