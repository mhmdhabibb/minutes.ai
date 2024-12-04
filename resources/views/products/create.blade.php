@extends('layouts.dashboard')
@section('content')
<style>
    .file-upload {
        display: flex;
        flex-direction: column;
        align-items: start;
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .file-upload label {
        font-size: 16px;
        margin-bottom: 8px;
    }
    .file-upload input[type="file"] {
        padding: 5px;
    }
</style>
<main class="container">
    <section>
        <form action="{{ route('modelai.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Modelai</label> 
                <input type="text" name="name" placeholder="Fill the NameModelAi..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Version</label>
                <input type="text" name="version" placeholder="Fill the Version..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Type</label>
                <input type="text" name="type" placeholder="Fill the Type..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
             <div class="mb-4 ">
                
                <label class="block mb-2 text-gray-700 " for="fileInput">Upload your file</label>
                <div class="p-6 mb-6 text-center border-2 border-gray-300 border-dashed rounded-lg">
                {{-- <input class="" type="file" id="fileInput" name="file"> --}}
                <p class="mb-2 text-gray-500">Choose an Model or drag & drop it here</p>
                <p class="mb-4 text-sm text-gray-400">Maximum file 5MB</p>
        
                <!-- Input for file selection -->
                <input name="description" type="file" id="fileInput" class="hidden" accept="file/, .txt, .py" onchange="displayFileName()">
                <button onclick="document.getElementById('fileInput').click()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg">Browse File</button>

                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Save
                </button>
            </div>

            <script>
                function showFile(event) {
                    var input = event.target;
                    var reader = new FileReader();
                    reader.onload = function() {
                        var dataURL = reader.result;
                        var output = document.getElementById('output');
                        output.src = dataURL;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            </script>
            
    </section>
    
</main>


@endsection