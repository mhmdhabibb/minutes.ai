@extends('user.layouts.app')

@section('title', 'Summary')

@section('content')  

{{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <button id="hamburger" class="lg:hidden p-2 mr-4 text-black focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="text-3xl font-bold text-gray-800 hidden md:block">Welcome back!</h1>
        <div class="flex items-center">
            <div class="rounded-full overflow-hidden border border-gray-300 shadow-sm" style="width: 50px; height: 50px;">
                <img 
                    alt="User avatar" 
                    class="object-cover w-full h-full" 
                    src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('asset/img/default-profile.png') }}" 
                />
            </div>
        </div>
    </div> 

{{-- Main Content --}}
<div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-10 mb-16">
    <button onclick="openRecordPopup()" class="bg-purple-900 hover:bg-purple-800 text-white w-full h-40 py-4 rounded-lg text-xl flex flex-col items-center justify-center">
        <i class="fas fa-microphone mb-4 text-3xl"></i>
        Record Audio
    </button>
    <button onclick="openUploadPopup()" class="bg-teal-500 hover:bg-teal-600 text-white w-full h-40 py-4 rounded-lg text-xl flex flex-col items-center justify-center">
        <i class="fas fa-upload mb-4 text-3xl"></i>
        Upload Audio
    </button>
</div>

<div>
<div class="mb-12 relative">
    <form action="{{ route('user.dashboard') }}" method="GET" class="relative">
        <input 
            class="w-full md:w-1/3 p-4 pl-10 bg-transparent border border-gray-400 rounded-lg placeholder-gray-500" 
            placeholder="Search Title" 
            type="text" 
            name="search" 
            value="{{ request('search') }}" />
        <i class="fas fa-search absolute left-3 top-5 text-gray-400"></i>
    </form>
</div>


    {{-- Dynamic Transcriptions Section --}}
    <div class="space-y-8">
    @forelse ($transcriptions as $transcription)
        <div class="mb-6">
            <p class="text-gray-500 mb-2">{{ $transcription->created_at->format('l, d F Y') }}</p>
            <div class="bg-white p-7 rounded-lg shadow flex justify-between items-center">
                <!-- Display original file name -->
                <p class="text-purple-600 text-xl font-semibold">{{ $transcription->file_name }}</p>
                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                    <a href="{{ route('user.transcript', ['id' => $transcription->id]) }}">
                        <button class="border border-blue-500 text-blue-500 py-2 px-2 rounded-lg hover:bg-blue-50">View Transcript</button>
                    </a>
                    <a href="{{ route('user.edit_transcript', ['id' => $transcription->id]) }}">
                        <button class="border border-green-500 text-green-500 py-2 px-2 rounded-lg hover:bg-green-50">Edit Transcript</button>
                    </a>
                    <!-- Delete Button -->
                    <button 
                        type="button" 
                        onclick="showDeleteModal({{ $transcription->id }}, '{{ $transcription->file_name }}')" 
                        class="flex items-center px-3 py-2 text-red-600 border border-red-600 rounded-lg hover:bg-red-50 hover:text-red-800">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No transcriptions available yet. Upload an audio file to get started!</p>
    @endforelse
</div>

<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Delete Confirmation</h2>
        <p class="text-gray-600 mb-6" id="deleteMessage">Are you sure you want to delete this transcript?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="hideDeleteModal()" class="py-2 px-4 bg-gray-200 rounded-lg hover:bg-gray-300 text-gray-800">Cancel</button>
                <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
            </div>
        </form>
    </div>
</div>




{{-- Record Popup --}}
<div id="record-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-[410px]">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Record Audio</h2>
            <button onclick="closeRecordPopup()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="text-gray-500 mb-4">Record your audio and start processing!</p>
        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Start Recording</button>
    </div>
</div>

{{-- Upload Popup --}}
<div id="upload-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Upload Audio File</h2>
            <button onclick="closeUploadPopup()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="text-gray-500 mb-6">Select and upload the audio of your choice</p>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center mb-6" id="file-upload-container">
            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-4"></i>
            <p class="text-gray-500 mb-2" id="file-upload-text">Choose an audio or drag & drop it here</p>
            <p class="text-gray-400 text-sm mb-4">MP3 or WAV formats, up to 15MB</p>

            <input type="file" id="fileInput" class="hidden" accept=".mp3, .wav" onchange="handleFileUpload()">
            <button onclick="document.getElementById('fileInput').click()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Browse File</button>
        </div>
        <div id="uploadActions" class="hidden">
            <button onclick="processFile()" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 mb-2">Process File</button>
            <button onclick="removeFile()" class="w-full border border-red-600 text-red-600 py-2 rounded-lg hover:bg-red-50">Remove File</button>
        </div>
        <div id="uploadStatus" class="mt-4"></div>
    </div>
</div>

<script>
    const recordPopup = document.getElementById('record-popup');
    const uploadPopup = document.getElementById('upload-popup');
    const fileInput = document.getElementById('fileInput');
    const uploadActions = document.getElementById('uploadActions');
    const fileUploadText = document.getElementById('file-upload-text');
    const uploadStatus = document.getElementById('uploadStatus');

    let selectedFile = null;

    function openRecordPopup() {
        recordPopup.style.display = 'flex';
    }

    function closeRecordPopup() {
        recordPopup.style.display = 'none';
    }

    function openUploadPopup() {
        uploadPopup.style.display = 'flex';
    }

    function closeUploadPopup() {
        uploadPopup.style.display = 'none';
        resetUploadPopup();
    }

    function handleFileUpload() {
        selectedFile = fileInput.files[0];
        if (selectedFile) {
            fileUploadText.textContent = `Selected File: ${selectedFile.name}`;
            uploadActions.style.display = 'block';
        }
    }

    function removeFile() {
        selectedFile = null;
        fileInput.value = '';
        fileUploadText.textContent = "Choose an audio or drag & drop it here";
        uploadActions.style.display = 'none';
    }

    async function processFile() {
        if (!selectedFile) {
            alert('No file selected!');
            return;
        }

        const formData = new FormData();
        formData.append('audio', selectedFile);

        uploadStatus.innerHTML = '<p class="text-blue-500">Uploading...</p>';

        try {
            const response = await fetch('{{ route('upload.audio') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            });

            const data = await response.json();

            if (data.status === 'success') {
                uploadStatus.innerHTML = '<p class="text-green-500">File processed successfully!</p>';
                location.reload(); // Reload to show the new transcription
            } else {
                uploadStatus.innerHTML = `<p class="text-red-500">Error: ${data.message}</p>`;
            }
        } catch (error) {
            uploadStatus.innerHTML = `<p class="text-red-500">Upload failed: ${error.message}</p>`;
        }
    }

    function resetUploadPopup() {
        removeFile();
        uploadStatus.innerHTML = '';
    }
    function showDeleteModal(transcriptionId, fileName) {
        // Show the modal
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Update the message with the file name
        const message = document.getElementById('deleteMessage');
        message.textContent = `Are you sure you want to delete the transcript for "${fileName}"?`;

        // Update the form action
        const form = document.getElementById('deleteForm');
        form.action = `/transcripts/${transcriptionId}`; // Update this route if needed
    }

    function hideDeleteModal() {
        // Hide the modal
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
