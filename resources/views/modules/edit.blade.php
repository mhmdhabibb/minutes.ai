<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Module AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div class="fixed top-0 left-0 w-64 h-full p-4 bg-gray-900">
            <div class="mb-8 text-2xl font-bold text-white">Convonotes</div>
            <nav class="space-y-4">
                <a href="#" class="text-white block py-2.5 px-4 rounded hover:bg-gray-800">Dashboard</a>
                <a href="#" class="text-white block py-2.5 px-4 rounded bg-gray-800">Model AI</a>
                <a href="#" class="text-white block py-2.5 px-4 rounded hover:bg-gray-800">Settings</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="p-8 ml-64">
            <div class="max-w-2xl mx-auto">
                <h1 class="mb-6 text-2xl font-bold">Edit Module</h1>

                <form action="{{ route('modules.update', $module) }}" method="POST" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                            Name
                        </label>
                        <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" 
                               id="name" 
                               type="text" 
                               name="name" 
                               value="{{ $module->name }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="version">
                            Version
                        </label>
                        <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" 
                               id="version" 
                               type="number" 
                               name="version" 
                               value="{{ $module->version }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="type">
                            Type
                        </label>
                        <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" 
                               id="type" 
                               type="text" 
                               name="type" 
                               value="{{ $module->type }}"
                               required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="description">
                            Description
                        </label>
                        <textarea class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" 
                                  id="description" 
                                  name="description" 
                                  required>{{ $module->description }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" 
                                type="submit">
                            Update Module
                        </button>
                        <a href="{{ route('modules.index') }}" 
                           class="inline-block text-sm font-bold text-blue-500 align-baseline hover:text-blue-800">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>