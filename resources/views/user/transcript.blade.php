@extends('user.layouts.app')

@section('title', 'Transcript')

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
    <h2 class="mb-4 text-2xl font-semibold text-gray-700">{{ $file_name }}</h2>

    <div class="flex items-center mb-12 space-x-4 text-sm text-gray-500">
        <svg class="w-6 h-6 text-blue-600 dark:text-blue" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Z" clip-rule="evenodd"/>
        </svg>
        <span class="text-sm font-semibold text-blue-600">{{ $created_at }}</span>
    </div>

    <div class="mb-6 border-b border-gray-200">
        <ul class="flex text-sm font-medium text-gray-500">
            <li class="mr-6">
                <a href="#" class="text-gray-900">Transcript</a>
            </li>
            <li>
    <a href="{{ route('user.summary', ['id' => $transcription_id]) }}" class="hover:text-gray-900">Summary</a>
</li>

        </ul>
    </div>

    <!-- Summary Section -->
    <div id="summary-section" class="p-4 mb-12 bg-gray-100 rounded-lg shadow-sm">
        <h4 class="mb-2 text-lg font-bold text-gray-900">Summary</h4>
        <p class="text-base text-gray-700 leading-relaxed">
            {{ $summary ?? 'No summary available for this transcript.' }}
        </p>
    </div>

    <div class="mb-4">
        <h4 class="mb-1 text-sm font-semibold text-gray-900">Keywords</h4>
        <p class="text-sm text-gray-600">meeting, transcript, discussion, summary</p>
    </div>

    <div class="mb-12">
        <h4 class="mb-1 text-sm font-semibold text-gray-900">Speakers</h4>
        <p class="text-sm text-gray-600">
            @php
                $speakers = collect($transcripts)->pluck('speaker')->unique()->filter()->values();
                echo $speakers->map(fn($speaker) => ucfirst($speaker))->join(', ');
            @endphp
        </p>
    </div>

    <div class="ml-10 space-y-4">
        @foreach ($transcripts as $segment)
            <div>
                <p class="flex items-center">
                    {{ ucfirst($segment['speaker'] ?? 'Unknown Speaker') }}
                    <svg class="w-4 h-4 ml-2 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-2 font-normal text-gray-500">{{ $segment['start_time'] ?? '00:00' }}</span>
                </p>
                <p class="mt-1 text-sm text-gray-700">{{ $segment['text'] ?? '' }}</p>
            </div>
        @endforeach
    </div>

    <div class="flex justify-between mt-40">
    <!-- Download Button -->
    <button 
        class="px-4 py-2 font-semibold text-gray-700 transition-colors border border-green-500 rounded hover:bg-green-500 hover:text-white"
        onclick="window.location.href='{{ route('user.download_transcript', ['id' => $transcription_id]) }}'">
        Download Transcript
    </button>

    <!-- Save, Cancel, and Edit Buttons -->
    <div>
        <!-- Edit Transcript Button -->
        <button 
            class="px-4 py-2 mr-2 font-semibold text-gray-700 transition-colors border border-green-500 rounded hover:bg-green-500 hover:text-white"
            onclick="window.location.href='{{ route('user.edit_transcript', ['id' => $transcription_id]) }}'">
            Edit Transcript
        </button>

        <!-- Cancel Button -->
        <button 
            class="px-4 py-2 mr-2 font-semibold text-gray-700 transition-colors border border-blue-500 rounded hover:bg-blue-500 hover:text-white"
            onclick="window.location.href='{{ route('user.dashboard') }}'">
            Cancel
        </button>

        <!-- Save Button -->
        <button 
            class="px-4 py-2 font-semibold text-white bg-blue-600 rounded"
            onclick="window.location.href='{{ route('user.dashboard') }}'">
            Save
        </button>
    </div>
</div>


@endsection
