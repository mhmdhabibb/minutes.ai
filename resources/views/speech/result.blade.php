@extends('user.layouts.app')

@section('title', 'Transcription and Summary Result')

@section('content')
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <button id="hamburger" class="lg:hidden p-2 mr-4 text-black focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
        <div class="flex items-center ml-auto">
            <img alt="User avatar" class="rounded-full" height="50" src="{{ asset('asset/img/s.jpg') }}" width="50"/>
        </div>
    </div>  

    <!-- Content Box -->
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Transcription Result</h2>
        
        <div class="mb-4">
            <h4 class="text-gray-900 font-semibold text-sm mb-1">Transcription Text:</h4>
            <p class="text-gray-600 text-sm">{{ $transcription }}</p>
        </div>

        <div class="mb-4">
            <h4 class="text-gray-900 font-semibold text-sm mb-1">Summary:</h4>
            <p class="text-gray-600 text-sm">{{ $summary }}</p>
        </div>

        <div class="flex justify-end mt-4">
            <a href="/upload-audio" class="px-4 py-2 text-gray-700 font-semibold rounded mr-2 border border-blue-500 hover:bg-blue-500 hover:text-white transition-colors">Upload Another Audio</a>
        </div>
    </div>
@endsection
