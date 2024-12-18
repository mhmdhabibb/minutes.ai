@extends('admin.layouts.base')

@section('title', 'AI Model Management')

@section('content')
    <main class="flex-1 p-6 overflow-y-auto">
        <h1 class="text-3xl font-bold mb-6"> Model AI Management</h1>

        <div class="mb-8">
            <nav class="flex space-x-4" aria-label="Tabs">
                @foreach(['speech-to-text', 'diarization', 'summarization'] as $category)
                    <button class="px-3 py-2 text-lg font-base text-gray-500 rounded-md hover:text-gray-700 tab-button {{ $loop->first ? 'bg-gray-200 text-gray-700' : '' }}" data-tab="{{ $category }}">
                        {{ ucfirst(str_replace('-', ' ', $category)) }}
                    </button>
                @endforeach
            </nav>
        </div>

        <div id="modelCardsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($models as $category => $modelList)
                @foreach($modelList as $model)
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $model->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $model->description }}</p>
                        <p class="text-sm"><strong>Type:</strong> {{ $model->type }}</p>
                        <p class="text-sm"><strong>Version:</strong> {{ $model->version }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="px-2 py-1 text-xs font-semibold {{ $model->is_active ? 'text-green-800 bg-green-100' : 'text-gray-800 bg-gray-100' }} rounded-full">
                                {{ $model->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <div>
                                <button class="px-2 py-1 text-xs font-medium {{ $model->is_active ? 'text-gray-700 bg-gray-100' : 'text-white bg-blue-600' }} rounded-md mr-2 activate-btn" data-id="{{ $model->id }}" {{ $model->is_active ? 'disabled' : '' }}>
                                    {{ $model->is_active ? 'Activated' : 'Activate' }}
                                </button>
                                <button class="px-2 py-1 text-xs font-medium text-white bg-red-600 rounded-md delete-btn" data-id="{{ $model->id }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>

        <button id="addNewModelBtn" class="mt-6 px-4 py-2 bg-purple-600 text-white rounded-md flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Model
        </button>

        <div id="uploadModelModal" class="fixed inset-0 bg-black bg-opacity-70 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-1/3 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Upload New Model</h3>
                    <form id="uploadModelForm" class="mt-8 text-left">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="modelCategory">
                                Model Category
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="modelCategory" name="category" required>
                                <option value="">Select a model category</option>
                                <option value="speech-to-text">Speech to Text</option>
                                <option value="diarization">Diarization</option>
                                <option value="summarization">Summarization</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Model name" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                Type
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type" name="type" type="text" placeholder="Enter model type" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="version">
                                Version
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="version" name="version" type="text" placeholder="Model version" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Description
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Model description" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="file">
                                Upload File
                            </label>
                            <input class=" shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="file" name="file" type="file" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button id="cancelUploadBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                Cancel
                            </button>
                            <button id="uploadModelBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        document.getElementById('uploadModelForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('/admin/models', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); 
                Swal.fire({
                    icon: 'success',
                    title: 'Model has been added',
                    showConfirmButton: false,
                    timer: 1500
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error adding your model.',
                });
            });
        });
    </script>
    <script>
        // Function to activate a model
        function activateModel(e) {
            const modelId = parseInt(e.target.dataset.id);
            fetch(`/admin/models/${modelId}/activate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                // Update the model's active status in the local models array
                models[currentTab].forEach(model => {
                    model.is_active = model.id === modelId;
                });
                renderModelCards();
                Swal.fire({
                icon: "success",
                title: "Your model has been actived",
                showConfirmButton: false,
                timer: 1500
                });
            })
            .catch(error => console.error('Error:', error));
        }

        // Function to delete a model
        function deleteModel(e) {
            const modelId = parseInt(e.target.dataset.id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/models/${modelId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        models[currentTab] = models[currentTab].filter(model => model.id !== modelId);
                        renderModelCards();
                        Swal.fire({
                        icon: "success",
                        title: "Your model has been deleted",
                        showConfirmButton: false,
                        timer: 1500
                        });
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }
    </script>
    <script>
        let models = @json($models);
        let currentTab = 'speech-to-text';

        // Function to render model cards
        function renderModelCards() {
            const container = document.getElementById('modelCardsContainer');
            container.innerHTML = '';

            models[currentTab].forEach(model => {
                const card = document.createElement('div');
                card.className = 'bg-white shadow rounded-lg p-4';
                card.innerHTML = `
                    <h3 class="text-lg font-semibold mb-2">${model.name}</h3>
                    <p class="text-sm text-gray-600 mb-4">${model.description}</p>
                    <p class="text-sm"><strong>Type:</strong> ${model.type}</p>
                    <p class="text-sm"><strong>Version:</strong> ${model.version}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="px-2 py-1 text-xs font-semibold ${model.is_active ? 'text-green-800 bg-green-100' : 'text-gray-800 bg-gray-100'} rounded-full">
                            ${model.is_active ? 'Active' : 'Inactive'}
                        </span>
                        <div>
                            <button class="px-2 py-1 text-xs font-medium ${model.is_active ? 'text-gray-700 bg-gray-100' : 'text-white bg-blue-600'} rounded-md mr-2 activate-btn" data-id="${model.id}" ${model.is_active ? 'disabled' : ''}>
                                ${model.is_active ? 'Activated' : 'Activate'}
                            </button>
                            <button class="px-2 py-1 text-xs font-medium text-white bg-red-600 rounded-md delete-btn" data-id="${model.id}">
                                Delete
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });

            // Add event listeners for activate and delete buttons
            document.querySelectorAll('.activate-btn').forEach(btn => {
                btn.addEventListener('click', activateModel);
            });
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', deleteModel);
            });
        }

        // Function to switch tabs
        function switchTab(tab) {
            currentTab = tab;
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('bg-gray-200', 'text-gray-700');
                btn.classList.add('text-gray-500');

                if (btn.dataset.tab === tab) {
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                }
            });
            renderModelCards();
        }

        // Function to show upload model form
        function showUploadForm() {
            document.getElementById('uploadModelModal').classList.remove('hidden');
        }

        // Function to hide upload model form
        function hideUploadForm() {
            document.getElementById('uploadModelModal').classList.add('hidden');
            document.getElementById('uploadModelForm').reset();
        }

        // Function to add a new model
        function addNewModel(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            
            fetch('/admin/models', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(newModel => {
                if (!models[newModel.category]) {
                    models[newModel.category] = [];
                }
                models[newModel.category].push(newModel);
                hideUploadForm();
                switchTab(newModel.category);
            })
            .catch(error => console.error('Error:', error));
        }

        // Event listeners
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.addEventListener('click', () => switchTab(btn.dataset.tab));
        });

        document.getElementById('addNewModelBtn').addEventListener('click', showUploadForm);
        document.getElementById('cancelUploadBtn').addEventListener('click', hideUploadForm);
        document.getElementById('uploadModelForm').addEventListener('submit', addNewModel);

        // Initial render
        renderModelCards();
    </script>
    
    @endpush
@endsection