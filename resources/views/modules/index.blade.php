<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module AI Management</title>
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
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Welcome back!</h1>
                <a href="{{ route('modules.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    Add Data
                </a>
            </div>

            @if(session('success'))
                <div class="px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white rounded-lg shadow">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Modul AI</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Version</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($modules as $module)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $module->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $module->version }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $module->type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $module->description }}</td>
                            <td class="px-6 py-4 space-x-2 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('modules.edit', $module) }}" class="text-blue-600 hover:text-blue-900">
                                    <svg class="inline w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('modules.destroy', $module) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                        <svg class="inline w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>