@extends('layouts.app')

@section('title', 'Summary')

@section('content')  

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <button id="hamburger" class="p-2 mr-4 text-black lg:hidden focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="hidden text-3xl font-bold text-gray-800 md:block">Welcome back!</h1>
        <div class="flex items-center">
            <img alt="User avatar" class="rounded-full" height="50" src="{{ asset('asset/img/s.jpg') }}" width="50"/>
        </div>
    </div>   

    {{-- Main Content --}}
    <div class="flex flex-col mb-16 space-y-4 md:flex-row md:space-y-0 md:space-x-10">
        <button onclick="openRecordPopup()" class="flex flex-col items-center justify-center w-full h-40 py-4 text-xl text-white bg-purple-900 rounded-lg">
            <i class="mb-4 text-3xl fas fa-microphone"></i>
            Record Audio
        </button>
        <button onclick="openUploadPopup()" class="flex flex-col items-center justify-center w-full h-40 py-4 text-xl text-white bg-teal-500 rounded-lg">
            <i class="mb-4 text-3xl fas fa-upload"></i>
            Upload Audio
        </button>
    </div>
    
    <div>
        <div class="mb-12">
            <h2 class="mb-4 text-xl font-bold">History Summary</h2>
            <div class="relative mb-12">
                <input 
                    class="w-full p-4 pl-10 placeholder-gray-500 bg-transparent border border-gray-400 rounded-lg md:w-1/3" 
                    placeholder="Search Title" 
                    type="text"/>
                <i class="absolute text-gray-400 fas fa-search left-3 top-5"></i>
            </div>
        </div>
    
        <div class="space-y-8">
            <div class="mb-6">
                <p class="mb-2 text-gray-500">Monday, 01 December 2024</p>
                <div class="flex items-center justify-between bg-white rounded-lg shadow p-7">
                    <p class="text-xl font-semibold text-purple-600">Data Meeting Bpdsm</p>
                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                        <a href="{{ route('transcript') }}">
                            <button class="px-2 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50">Lihat Transcript</button>
                        </a>                                  
                    </div>
                </div>
            </div>
    
            <div class="mb-6">
                <p class="mb-2 text-gray-500">Friday, 12 October 2024</p>
                <div class="flex items-center justify-between bg-white rounded-lg shadow p-7">
                    <p class="text-xl font-semibold text-purple-600">Data Meeting Bpdsm</p>
                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                        <a href="{{ route('transcript') }}">
                            <button class="px-2 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50">Lihat Transcript</button>
                        </a>
                    </div>
                </div>
            </div>
    
            <div class="mb-6">
                <p class="mb-2 text-gray-500">Wednesday, 08 October 2024</p>
                <div class="flex items-center justify-between bg-white rounded-lg shadow p-7">
                    <p class="text-xl font-semibold text-purple-600">Data Meeting Bpdsm</p>
                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                        <a href="{{ route('transcript') }}">
                            <button class="px-2 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50">Lihat Transcript</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Record Popup --}}
    <div id="record-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-[410px]">
            <div class="flex items-center justify-between mt-2">
                <h2 class="text-xl font-semibold">Record Audio</h2>
                <button onclick="closeRecordPopup()" class="focus:outline-none">
                    <i class="text-2xl text-gray-600 far fa-times-circle hover:text-gray-500"></i>
                </button>
            </div>
            <p class="text-gray-500 ">Record your Audio and start recording</p>
            <hr class="my-2 mb-6 border-t-2 border-gray-300">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Topic</label>
                <input type="text" placeholder="Fill the topic..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-8">
                <label class="block mb-2 text-gray-700">Select Language</label>
                <div class="relative">
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="english" selected>English</option>
                        <option value="indonesia">Indonesia</option>
                    </select>
                    <i class="absolute text-gray-500 pointer-events-none fas fa-chevron-down right-3 top-3"></i>
                </div>
            </div>
            <button onclick="startNewRecording()" class="w-full py-2 mb-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Start Recording</button>
            <button class="w-full py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">Another Option</button>
        </div>
    </div>

    {{-- Start Recording --}}
    <div id="recording-in-progress" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-[410px]">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-lg font-semibold">Recording Audio</h1>
                    <p class="text-sm text-gray-500">Recording is in progress...</p>
                </div>
                <button onclick="cancelRecording()" class="focus:outline-none">
                    <i class="text-2xl text-gray-600 far fa-times-circle hover:text-gray-500"></i>
                </button>
            </div>
            <hr class="my-2 border-t-2 border-gray-300"> 
            <div class="flex flex-col items-center">
                <div class="mt-8 mb-4 text-blue-600">
                    <i class="fas fa-microphone-alt fa-5x"></i>
                </div>
                <div class="mb-6 font-mono text-lg" id="timer">00:00</div>
                <button id="stop-recording" class="w-full px-4 py-2 mb-2 text-white bg-green-500 rounded">
                    <i class="fas fa-stop"></i> Stop Recording
                </button>
                <button id="pause-button" class="w-full px-4 py-2 mb-2 text-blue-600 border border-blue-600 rounded hover:bg-blue-50">Pause</button>
                <button onclick="cancelRecording()" class="w-full px-4 py-2 text-blue-600 border border-blue-600 rounded hover:bg-blue-50">Cancel</button>
            </div>
        </div>
    </div>

    {{-- Upload Popup --}}
    <div id="upload-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Upload Audio Files</h2>
                <button onclick="closeUploadPopup()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="mb-6 text-gray-500">Select and upload the audio of your choice</p>
            <div class="p-6 mb-6 text-center border-2 border-gray-300 border-dashed rounded-lg">
                <i class="mb-4 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                <p class="mb-2 text-gray-500">Choose an audio or drag & drop it here</p>
                <p class="mb-4 text-sm text-gray-400">MP3 or MP4 formats, up to 15MB</p>
        
                <!-- Input for file selection -->
                <input type="file" id="fileInput" class="hidden" accept="audio/mp4, .mp3, .wav, .m4a" onchange="displayFileName()">
                <button onclick="document.getElementById('fileInput').click()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg">Browse File</button>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-gray-700">Select Language</label>
                <div class="relative">
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="english" selected>English</option>
                        <option value="indonesia">Indonesia</option>
                    </select>
                    <i class="absolute text-gray-500 pointer-events-none fas fa-chevron-down right-3 top-3"></i>
                </div>
            </div>
        
            <!-- File upload status container -->
            <div id="uploadStatus" class="flex items-center p-4 mb-4 bg-gray-100 rounded-lg shadow" style="display: none;">
                <div class="flex-shrink-0">
                    <i class="text-3xl text-gray-400 fas fa-file-alt"></i>
                </div>
                <div class="flex-1 ml-4">
                    <div id="uploadedFileName" class="font-medium text-gray-800"></div>
                    <div class="flex items-center">
                        <div id="fileSize" class="mr-2 text-sm text-gray-500"></div>
                        <div id="uploadingStatus" class="text-sm text-blue-500">Uploading...</div>
                        <i class="ml-2 text-gray-400 fas fa-spinner fa-spin" id="loadingSpinner"></i>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div id="uploadProgressBar" class="bg-blue-500 h-2.5 rounded-full" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>
                <div class="ml-4">
                    <i class="text-gray-400 cursor-pointer fas fa-times" onclick="removeFile()"></i>
                </div>
            </div>
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

