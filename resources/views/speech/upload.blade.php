@extends('layouts.app')

@section('title', 'Upload Audio')

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
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Upload Audio for Transcription</h2>
        
        <form action="/process-audio" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="audio" class="block text-gray-700 font-semibold text-sm">Upload Audio File:</label>
                <input type="file" name="audio" id="audio" class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded mt-4">Upload and Transcribe</button>
        </form>
    </div>
@endsection
