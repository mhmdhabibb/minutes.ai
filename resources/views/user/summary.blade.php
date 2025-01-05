@extends('user.layouts.app')

@section('title', 'Summary')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-8">
    <button id="hamburger" class="p-2 text-black lg:hidden focus:outline-none">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Profile Image -->
    <div class="ml-auto">
        <div class="rounded-full overflow-hidden border border-gray-300 shadow-sm" style="width: 50px; height: 50px;">
            <img 
                alt="User avatar" 
                class="object-cover w-full h-full" 
                src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('asset/img/default-profile.png') }}" 
            />
        </div>
    </div>
</div>

<!-- Content Box -->
<div class="p-6 mx-auto bg-white rounded-lg shadow-md max-w-7xl">
    <h2 class="mb-4 text-2xl font-semibold text-gray-700">{{ $file_name }} - Summary</h2>

    <div class="flex items-center mb-8 space-x-4 text-sm text-gray-500">
        <svg class="w-6 h-6 text-blue-600 dark:text-blue" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Z" clip-rule="evenodd"/>
        </svg>
        <span class="text-sm font-semibold text-blue-600">{{ $created_at }}</span>
    </div>

    <!-- Summary Section -->
    <div class="p-4 mb-12 bg-gray-100 rounded-lg shadow-sm">
        <h4 class="mb-2 text-lg font-bold text-gray-900">Summary</h4>
        <!-- Add Edit Form -->
        <form action="{{ route('user.update_summary', ['id' => $transcription_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea name="summary" rows="5" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $summary }}</textarea>
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Update Summary
            </button>
        </form>
    </div>

    <!-- Buttons Section -->
    <div class="flex justify-between">
        <button 
            class="px-4 py-2 font-semibold text-gray-700 transition-colors border border-green-500 rounded hover:bg-green-500 hover:text-white"
            onclick="window.location.href='{{ route('user.summary.download', ['id' => $transcription_id]) }}'">
            Download Summary
        </button>
        <button 
            class="px-4 py-2 font-semibold text-gray-700 transition-colors border border-blue-500 rounded hover:bg-blue-500 hover:text-white"
            onclick="window.location.href='{{ route('user.transcript', ['id' => $transcription_id]) }}'">
            Back to Transcript
        </button>
    </div>
</div>

@endsection
