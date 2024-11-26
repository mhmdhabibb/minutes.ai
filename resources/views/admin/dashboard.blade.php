@extends('admin.layouts.base')

@section('title', 'admin.dashboard')

@section('content')

        
<div class="flex items-center justify-between px-10 py-4">
    <button id="hamburger" class="p-2 mr-4 text-black lg:hidden focus:outline-none">
        <i class="fas fa-bars"></i>
    </button>
    <h1 class="text-3xl font-bold leading-relaxed hidden md:block">Welcome back!</h1>
    <div class="flex items-center">
        <img alt="User avatar" class="rounded-lg" height="50" src="{{ asset('asset/img/avatar.png') }}" width="50"/>
    </div>                
</div>      
                  
<div class="p-10 mb-12 mt-3">
    <div class="grid grid-cols-1 gap-6 mb-4 md:grid-cols-2 lg:grid-cols-6"> 
        <div class="p-6 bg-purple-900 border-gray-100 rounded-md">
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
             --}}

    <table class="p-6 w-full font-sans border-2  border-[#EBEFF2] shadow-sm">
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


        
    </div>
@endsection
