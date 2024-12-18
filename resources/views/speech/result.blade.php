@extends('user.layouts.app')

@section('title', 'Transcription and Summary Result')

@section('content')
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <button id="hamburger" class="lg:hidden p-2 mr-4 text-black focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
        <div class="flex items-center ml-auto">
            <img alt="User avatar" class="rounded-full" height="50" src="{{ asset('asset/img/s.jpg') }}" width="50" />
        </div>
    </div>  

    <!-- Content Box -->
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Transcription Result</h2>

        <!-- Transcription Section -->
        <div class="mb-4">
            <h4 class="text-gray-900 font-semibold text-sm mb-1">Transcription Text:</h4>
            <div id="transcription-view">
                <p class="text-gray-600 text-sm">{{ $transcription }}</p>
                <button 
                    id="edit-transcription-btn" 
                    class="px-4 py-2 mt-2 text-gray-700 font-semibold rounded border border-blue-500 hover:bg-blue-500 hover:text-white transition-colors">
                    Edit
                </button>
            </div>
            <form id="transcription-edit" action="{{ route('update-result') }}" method="POST" class="hidden">
                @csrf
                <textarea 
                    name="transcription" 
                    class="w-full border border-gray-300 rounded p-2 text-sm text-gray-600"
                    rows="5">{{ $transcription }}</textarea>
                <button 
                    type="submit" 
                    class="px-4 py-2 mt-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 transition-colors">
                    Save
                </button>
                <button 
                    type="button" 
                    id="cancel-transcription-btn" 
                    class="px-4 py-2 mt-2 text-gray-700 font-semibold rounded border border-red-500 hover:bg-red-500 hover:text-white transition-colors">
                    Cancel
                </button>
            </form>
        </div>

        <!-- Summary Section -->
        <div class="mb-4">
            <h4 class="text-gray-900 font-semibold text-sm mb-1">Summary:</h4>
            <div id="summary-view">
                <p class="text-gray-600 text-sm">{{ $summary }}</p>
                <button 
                    id="edit-summary-btn" 
                    class="px-4 py-2 mt-2 text-gray-700 font-semibold rounded border border-blue-500 hover:bg-blue-500 hover:text-white transition-colors">
                    Edit
                </button>
            </div>
            <form id="summary-edit" action="{{ route('update-result') }}" method="POST" class="hidden">
                @csrf
                <textarea 
                    name="summary" 
                    class="w-full border border-gray-300 rounded p-2 text-sm text-gray-600"
                    rows="3">{{ $summary }}</textarea>
                <button 
                    type="submit" 
                    class="px-4 py-2 mt-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 transition-colors">
                    Save
                </button>
                <button 
                    type="button" 
                    id="cancel-summary-btn" 
                    class="px-4 py-2 mt-2 text-gray-700 font-semibold rounded border border-red-500 hover:bg-red-500 hover:text-white transition-colors">
                    Cancel
                </button>
            </form>
        </div>

        <div class="flex justify-end mt-4">
            <a href="/upload-audio" class="px-4 py-2 text-gray-700 font-semibold rounded border border-blue-500 hover:bg-blue-500 hover:text-white transition-colors">
                Upload Another Audio
            </a>
        </div>
    </div>

    <script>
        // Transcription Edit Toggle
        const editTranscriptionBtn = document.getElementById('edit-transcription-btn');
        const cancelTranscriptionBtn = document.getElementById('cancel-transcription-btn');
        const transcriptionView = document.getElementById('transcription-view');
        const transcriptionEdit = document.getElementById('transcription-edit');

        editTranscriptionBtn.addEventListener('click', () => {
            transcriptionView.classList.add('hidden');
            transcriptionEdit.classList.remove('hidden');
        });

        cancelTranscriptionBtn.addEventListener('click', () => {
            transcriptionEdit.classList.add('hidden');
            transcriptionView.classList.remove('hidden');
        });

        // Summary Edit Toggle
        const editSummaryBtn = document.getElementById('edit-summary-btn');
        const cancelSummaryBtn = document.getElementById('cancel-summary-btn');
        const summaryView = document.getElementById('summary-view');
        const summaryEdit = document.getElementById('summary-edit');

        editSummaryBtn.addEventListener('click', () => {
            summaryView.classList.add('hidden');
            summaryEdit.classList.remove('hidden');
        });

        cancelSummaryBtn.addEventListener('click', () => {
            summaryEdit.classList.add('hidden');
            summaryView.classList.remove('hidden');
        });
    </script>
@endsection
