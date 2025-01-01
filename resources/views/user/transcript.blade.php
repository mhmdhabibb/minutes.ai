@extends('user.layouts.app')

@section('title', 'Transcript')

@section('content')

    {{-- Header --}}
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Transcription and Summary</h2>

    <!-- Transcription Section -->
    <div class="mb-6">
        <h4 class="text-gray-900 font-semibold text-sm mb-1">Transcription:</h4>
        <p class="text-gray-600 text-sm">{{ $transcription }}</p>
    </div>

    <!-- Summary Section -->
    <div class="mb-6">
        <h4 class="text-gray-900 font-semibold text-sm mb-1">Summary:</h4>
        <p class="text-gray-600 text-sm">{{ $summary }}</p>
    </div>

    <div class="flex justify-end mt-6">
        <button class="px-4 py-2 text-gray-700 font-semibold rounded mr-2 border border-blue-500 hover:bg-blue-500 hover:text-white transition-colors">Cancel</button>
        <button class="px-4 py-2 bg-blue-600 text-white font-semibold rounded">Save</button>
    </div>
</div>

@endsection