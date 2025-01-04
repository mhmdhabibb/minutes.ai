@extends('user.layouts.app')

@section('title', 'Transcript')

@section('content')

<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Transcription and Summary</h3>

    <div class="mb-6">
        <h4 class="text-xl font-semibold text-gray-700 mb-2">Transcription</h4>
        <div class="p-4 bg-gray-100 rounded-lg shadow-sm">
            <p class="text-gray-800 leading-relaxed">{{ $transcription }}</p>
        </div>
    </div>

    <div>
        <h4 class="text-xl font-semibold text-gray-700 mb-2">Summary</h4>
        <div class="p-4 bg-gray-100 rounded-lg shadow-sm">
            <p class="text-gray-800 leading-relaxed">{{ $summary }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('user.dashboard') }}" class="inline-block px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition duration-200">
            Back to Dashboard
        </a>
    </div>
</div>

@endsection
