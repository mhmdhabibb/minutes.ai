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
            <img alt="User avatar" class="rounded-full" height="50" src="{{ asset('asset/img/s.jpg') }}" width="50"/>
        </div>
    </div>   

    {{-- Main Content --}}
    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-10 mb-16">
        <button onclick="openRecordPopup()" class="bg-purple-900 hover:bg-purple-800 text-white w-full h-40 py-4 rounded-lg text-xl flex flex-col items-center justify-center ">
            <i class="fas fa-microphone mb-4 text-3xl"></i>
            Record Audio
        </button>
        <button onclick="openUploadPopup()" class="bg-teal-500 hover:bg-teal-600 text-white w-full h-40 py-4 rounded-lg text-xl flex flex-col items-center justify-center">
            <i class="fas fa-upload mb-4 text-3xl"></i>
            Upload Audio
        </button>
    </div>
    
    {{-- Transcription History --}}
    <div class="mb-12">
    <h2 class="text-xl font-bold mb-4">Transcription History</h2>
   
<div class="space-y-8">
    @foreach($transcriptions as $transcription)
        <div class="mb-6">
            <!-- Date for each transcription history -->
            <p class="text-gray-500 mb-2">{{ \Carbon\Carbon::parse($transcription->created_at)->format('l, d F Y') }}</p>
            
            <!-- Transcription Info Block -->
            <div class="bg-white p-7 rounded-lg shadow flex justify-between items-center">
                <!-- File Name -->
                <p class="text-purple-600 text-xl font-semibold truncate max-w-[70%]">
                    {{ basename($transcription->audio_file_path) }}
                </p>

                <!-- View & Delete Buttons -->
                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                    <!-- View Full Transcription Button -->
                    <a href="{{ route('user.transcription.show', $transcription->id) }}">
                        <button class="border border-blue-500 text-blue-500 py-2 px-4 rounded-lg hover:bg-blue-50">
                            View Transcription
                        </button>
                    </a> 

                    <!-- Delete Button -->
                    <form action="{{ route('user.transcription.delete', $transcription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transcription?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border border-red-500 text-red-500 py-2 px-4 rounded-lg hover:bg-red-50">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>








    {{-- Record Popup --}}
    <div id="record-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-[410px]">
            <div class="flex justify-between items-center  mt-2">
                <h2 class="text-xl font-semibold">Record Audio</h2>
                <button onclick="closeRecordPopup()" class="focus:outline-none">
                    <i class="far fa-times-circle text-2xl text-gray-600 hover:text-gray-500"></i>
                </button>
            </div>
            <p class="text-gray-500 ">Record your Audio and start recording</p>
            <hr class="border-t-2 border-gray-300 my-2 mb-6">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Topic</label>
                <input type="text" placeholder="Fill the topic..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-8">
                <label class="block text-gray-700 mb-2">Select Language</label>
                <div class="relative">
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="english" selected>English</option>
                        <option value="indonesia">Indonesia</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-500 pointer-events-none"></i>
                </div>
            </div>
            <button onclick="startNewRecording()" class="w-full bg-blue-600 text-white py-2 rounded-lg mb-2 hover:bg-blue-700">Start Recording</button>
            <button class="w-full border border-blue-600 text-blue-600 py-2 rounded-lg hover:bg-blue-50">Another Option</button>
        </div>
    </div>

    {{-- Start Recording --}}
    <div id="recording-in-progress" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-[410px]">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-lg font-semibold">Recording Audio</h1>
                    <p class="text-sm text-gray-500">Recording is in progress...</p>
                </div>
                <button onclick="cancelRecording()" class="focus:outline-none">
                    <i class="far fa-times-circle text-2xl text-gray-600 hover:text-gray-500"></i>
                </button>
            </div>
            <hr class="border-t-2 border-gray-300 my-2"> 
            <div class="flex flex-col items-center">
                <div class="text-blue-600 mb-4 mt-8">
                    <i class="fas fa-microphone-alt fa-5x"></i>
                </div>
                <div class="text-lg font-mono mb-6" id="timer">00:00</div>
                <button id="stop-recording" class="bg-green-500 text-white py-2 px-4 rounded mb-2 w-full">
                    <i class="fas fa-stop"></i> Stop Recording
                </button>
                <button id="pause-button" class="border border-blue-600 text-blue-600 py-2 px-4 rounded mb-2 w-full hover:bg-blue-50">Pause</button>
                <button onclick="cancelRecording()" class="border border-blue-600 text-blue-600 py-2 px-4 rounded w-full hover:bg-blue-50">Cancel</button>
            </div>
        </div>
    </div>

    {{-- Upload Popup --}}
<div id="upload-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Upload Audio Files</h2>
            <button onclick="closeUploadPopup()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="text-gray-500 mb-6">Select and upload the audio of your choice</p>
        
        <form action="{{ route('transcription.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center mb-6">
                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-4"></i>
                <p class="text-gray-500 mb-2">Choose an audio or drag & drop it here</p>
                <p class="text-gray-400 text-sm mb-4">MP3 or MP4 formats, up to 15MB</p>

                <!-- Input for file selection -->
                <input type="file" name="audio" id="fileInput" class="hidden" accept="audio/mp4, .mp3, .wav, .m4a" onchange="displayFileName()" required>
                <button type="button" onclick="document.getElementById('fileInput').click()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Browse File</button>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Select Language</label>
                <div class="relative">
                    <select name="language" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="english" selected>English</option>
                        <option value="indonesia">Indonesia</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-500 pointer-events-none"></i>
                </div>
            </div>

            <!-- File upload status container -->
            <div id="uploadStatus" class="bg-gray-100 rounded-lg shadow p-4 mb-4 flex items-center" style="display: none;">
                <div class="flex-shrink-0">
                    <i class="fas fa-file-alt text-gray-400 text-3xl"></i>
                </div>
                <div class="ml-4 flex-1">
                    <div id="uploadedFileName" class="text-gray-800 font-medium"></div>
                    <div class="flex items-center">
                        <div id="fileSize" class="text-gray-500 text-sm mr-2"></div>
                        <div id="uploadingStatus" class="text-sm text-blue-500">Uploading...</div>
                        <i class="fas fa-spinner fa-spin text-gray-400 ml-2" id="loadingSpinner"></i>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div id="uploadProgressBar" class="bg-blue-500 h-2.5 rounded-full" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>
                <div class="ml-4">
                    <i class="fas fa-times text-gray-400 cursor-pointer" onclick="removeFile()"></i>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg w-full font-semibold">
                Transcribe
            </button>
        </form>
    </div>
</div>


    

    @if(session('status'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        const recordPopup = document.getElementById('record-popup');
        const uploadPopup = document.getElementById('upload-popup');

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
        }
    </script>

    {{-- Start Recording --}}
    <script>
        let recording = false;
        let timerInterval;
        let seconds = 0;
        let paused = false;
        let mediaRecorder;
        let audioChunks = [];
        let audioUrl = null;

        function startTimer() {
            timerInterval = setInterval(() => {
                if (!paused) {
                    seconds++;
                    let minutes = Math.floor(seconds / 60);
                    let secs = seconds % 60;
                    document.getElementById('timer').textContent = 
                        `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                }
            }, 1000);
        }

        async function startNewRecording() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                mediaRecorder = new MediaRecorder(stream);
                
                mediaRecorder.ondataavailable = (event) => {
                    audioChunks.push(event.data);
                };

                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                    audioUrl = URL.createObjectURL(audioBlob);
                    showPlaybackControls();
                };

                mediaRecorder.start();
                recording = true;
                document.getElementById('record-popup').style.display = 'none';
                document.getElementById('recording-in-progress').style.display = 'flex';
                resetPlaybackUI();
                startTimer();
            } catch (err) {
                console.error('Error accessing microphone:', err);
                alert('Error accessing microphone. Please ensure you have granted microphone permissions.');
            }
        }

        function stopRecording() {
            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                mediaRecorder.stop();
                mediaRecorder.stream.getTracks().forEach(track => track.stop());
            }
            recording = false;
            clearInterval(timerInterval);
            document.getElementById('stop-recording').style.display = 'none';
            document.getElementById('pause-button').style.display = 'none';
        }

        function showPlaybackControls() {
            let audioPlayer = document.getElementById('audio-player');
            if (!audioPlayer) {
                audioPlayer = document.createElement('audio');
                audioPlayer.id = 'audio-player';
                audioPlayer.controls = true;
                audioPlayer.className = 'w-full mb-4';
                
                const controlsContainer = document.querySelector('#recording-in-progress .flex.flex-col.items-center');
                controlsContainer.insertBefore(audioPlayer, controlsContainer.firstChild);
            }
            
            audioPlayer.src = audioUrl;
            
            let saveButton = document.getElementById('save-recording');
            if (!saveButton) {
                saveButton = document.createElement('button');
                saveButton.id = 'save-recording';
                saveButton.className = 'bg-blue-600 text-white py-2 px-4 rounded mb-2 mt-2 w-full';
                saveButton.innerHTML = '<i class="fas fa-save"></i> Save Recording';
                saveButton.onclick = saveRecording;
                
                const controlsContainer = document.querySelector('#recording-in-progress .flex.flex-col.items-center');
                controlsContainer.appendChild(saveButton);
            }
            
            let newRecordingButton = document.getElementById('new-recording');
            if (!newRecordingButton) {
                newRecordingButton = document.createElement('button');
                newRecordingButton.id = 'new-recording';
                newRecordingButton.className = 'border border-blue-600 text-blue-600 py-2 px-4 rounded w-full hover:bg-blue-50';
                newRecordingButton.innerHTML = '<i class="fas fa-microphone"></i> New Recording';
                newRecordingButton.onclick = startNewRecordingSession;
                
                const controlsContainer = document.querySelector('#recording-in-progress .flex.flex-col.items-center');
                controlsContainer.appendChild(newRecordingButton);
            }
        }

        function resetPlaybackUI() {
            const audioPlayer = document.getElementById('audio-player');
            if (audioPlayer) audioPlayer.remove();
            
            const saveButton = document.getElementById('save-recording');
            if (saveButton) saveButton.remove();
            
            const newRecordingButton = document.getElementById('new-recording');
            if (newRecordingButton) newRecordingButton.remove();
            
            document.getElementById('stop-recording').style.display = 'block';
            document.getElementById('pause-button').style.display = 'block';
            
            seconds = 0;
            document.getElementById('timer').textContent = "00:00";
            audioChunks = [];
            audioUrl = null;
        }

        function startNewRecordingSession() {
            resetPlaybackUI();
            startNewRecording();
        }

        function saveRecording() {
            alert('Recording saved successfully!');
            document.getElementById('recording-in-progress').style.display = 'none';
        }

        function cancelRecording() {
            stopRecording();
            resetPlaybackUI();
            audioChunks = [];
            document.getElementById('recording-in-progress').style.display = 'none';
        }

        document.getElementById('stop-recording').addEventListener('click', stopRecording);

        document.getElementById('pause-button').addEventListener('click', function() {
            if (paused) {
                paused = false;
                this.textContent = 'Pause';
                if (mediaRecorder.state === 'paused') {
                    mediaRecorder.resume();
                }
            } else {
                paused = true;
                this.textContent = 'Resume';
                if (mediaRecorder.state === 'recording') {
                    mediaRecorder.pause();
                }
            }
        });
    </script>
    
    {{-- File Input Audio --}}
    <script>
        function displayFileName() {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2) + " MB"; 
    
            document.getElementById('uploadedFileName').textContent = fileName;
            document.getElementById('fileSize').textContent = fileSize;
    
            document.getElementById('uploadStatus').style.display = 'flex'; 
    
            let progress = 0;
            const progressBar = document.getElementById('uploadProgressBar');
            const uploadingStatus = document.getElementById('uploadingStatus');
            const loadingSpinner = document.getElementById('loadingSpinner');
    
            const uploadInterval = setInterval(function() {
                progress += 10;
                progressBar.style.width = progress + '%';
                if (progress >= 100) {
                    clearInterval(uploadInterval);
                    uploadingStatus.textContent = "Completed"; 
                    uploadingStatus.classList.replace('text-blue-500', 'text-green-500');
                    loadingSpinner.classList.replace('fa-spinner', 'fa-check'); 
                    loadingSpinner.classList.remove('fa-spin'); 
                    loadingSpinner.classList.add('text-green-500'); 
                }
            }, 300); 
        }
    
        function removeFile() {
            document.getElementById('fileInput').value = '';
            document.getElementById('uploadStatus').style.display = 'none'; 
        }
    </script>
    
@endsection

