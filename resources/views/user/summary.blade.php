@extends('user.layouts.app')

@section('title', 'Summary')

@section('content')  

<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <button id="hamburger" class="p-2 mr-4 text-black lg:hidden focus:outline-none">
        <i class="fas fa-bars"></i>
    </button>
    <div class="flex items-center ml-auto">
        <img alt="User avatar" class="rounded-full" height="50" src="{{ asset('asset/img/s.jpg') }}" width="50"/>
    </div>
</div>  

{{-- Content Box --}}
<div class="p-6 mx-auto bg-white rounded-lg shadow-md max-w-7xl">
    <h2 class="mb-4 text-2xl font-semibold text-gray-700">Transkrip meeting Bpsdm</h2>

    <!-- Meeting Details -->
    <div class="flex items-center mb-12 space-x-4 text-sm text-gray-500">
        <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd" />
        </svg>
        <span class="text-sm font-semibold text-blue-600">Sep 3 at 12:55 pm</span>
        <div class="flex items-center ml-4 space-x-2">
            <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-semibold text-blue-600">3 Min</span>
        </div>
    </div>

    <!-- Navigation -->
    <div class="mb-4 border-b border-gray-200">
        <ul class="flex text-sm font-medium text-gray-500">
            <li class="mr-6">
                <a href="{{ route('user.transcript') }}" class="hover:text-gray-900">Transcript</a>
            </li>
            <li>
                <a href="{{ route('user.summary') }}" class="text-gray-900">Summary</a>
            </li>
        </ul>
    </div>

    <!-- Opening -->
   
    <div class="mb-6">
        <h4 class="mb-2 text-sm font-semibold text-purple-600">Opening</h4>
        <ul class="ml-4 text-sm text-gray-600 list-disc list-inside">
            <li>Memperkenalkan topik utama dari kuliah ini yang berfokus pada [topik utama].</li>
            <li>Penekanan pentingnya [topik utama] dalam konteks saat ini.</li>
        </ul>
    </div>

    <!-- Main Point -->
    <div class="mb-6">
        <h4 class="mb-2 text-sm font-semibold text-purple-600">Main Point</h4>
        <div class="ml-4">
            <div class="mb-6">
                <h5 class="mb-2 font-semibold text-gray-700">[Sub-topik 1]</h5>
                <ul class="ml-4 text-sm text-gray-600 list-disc list-inside">
                    <li>Penjelasan definisi dan konsep dasar.</li>
                    <li>Contoh relevan yang mendukung pemahaman.</li>
                    <li>Aplikasi dalam situasi nyata.</li>
                </ul>
            </div>
            <div>
                <h5 class="mb-2 font-semibold text-gray-700">[Sub-topik 2]</h5>
                <ul class="ml-4 text-sm text-gray-600 list-disc list-inside">
                    <li>Diskusi tentang teori yang mendasari.</li>
                    <li>Penerapan praktis dan studi kasus.</li>
                    <li>Tantangan dan solusi potensial.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Summary -->
    <div class="mb-6">
        <h4 class="mb-2 text-sm font-semibold text-purple-600">Summary</h4>
        <ul class="ml-4 text-sm text-gray-600 list-disc list-inside">
            <li>Ringkasan dari poin-poin utama yang telah dibahas.</li>
            <li>Kesimpulan terkait [topik utama] dan prospek masa depan.</li>
        </ul>
    </div>

    <!-- Buttons -->
    <div class="flex justify-end mt-40">
        <button 
            class="px-4 py-2 mr-2 font-semibold text-gray-700 transition-colors border border-blue-500 rounded hover:bg-blue-500 hover:text-white"
            onclick="window.location.href='{{ route('user.dashboard') }}'">
            Cancel
        </button>
        <button 
            class="px-4 py-2 font-semibold text-white bg-blue-600 rounded"
            onclick="window.location.href='{{ route('user.dashboard') }}'">
            Save
        </button>
    </div>
    
</div>
@endsection
