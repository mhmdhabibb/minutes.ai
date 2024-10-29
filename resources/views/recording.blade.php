<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recording Audio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-[410px]">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-lg font-semibold">Recording Audio</h1>
                <p class="text-sm text-gray-500">Recording is in progress...</p>
            </div>
            <button onclick="" class="focus:outline-none">
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
            <button class="border border-blue-600 text-blue-600 py-2 px-4 rounded w-full hover:bg-blue-50">Cancel</button>
        </div>
    </div>

    <script>
        let recording = true; 
        let timerInterval;
        let seconds = 0;
        let paused = false; 

        // Start Timer 
        function startTimer() {
            timerInterval = setInterval(() => {
                seconds++;
                let minutes = Math.floor(seconds / 60);
                let secs = seconds % 60;
                document.getElementById('timer').textContent = `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
            }, 1000);
        }

        // Stop Recording 
        document.getElementById('stop-recording').addEventListener('click', function() {
            recording = false;
            clearInterval(timerInterval);
            document.getElementById('timer').textContent = "00:00"; 
        });

        // Pause/Start 
        document.getElementById('pause-button').addEventListener('click', function() {
            if (paused) {
                paused = false;
                this.textContent = 'Pause';
                startTimer();
            } else {
                paused = true;
                this.textContent = 'Start';
                clearInterval(timerInterval);
            }
        });

        startTimer();
    </script>
</body>
</html>
