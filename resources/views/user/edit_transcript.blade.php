@extends('user.layouts.app')

@section('title', 'Edit Transcript')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Transcript for: <span class="text-purple-600">{{ $file_name }}</span></h1>
    
    <form action="{{ route('user.update_transcript', ['id' => $transcription_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Edit File Name -->
        <div class="mb-4">
            <label for="file_name" class="block text-lg font-medium text-gray-700 mb-2">File Name</label>
            <input type="text" id="file_name" name="file_name" 
                   class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                   value="{{ $file_name }}" />
        </div>

        <!-- Edit Transcripts -->
        <table class="w-full text-left border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">Speaker</th>
                    <th class="border border-gray-300 p-2">Start Time</th>
                    <th class="border border-gray-300 p-2">End Time</th>
                    <th class="border border-gray-300 p-2">Text</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transcripts as $key => $transcript)
                <tr class="even:bg-gray-50">
                    <!-- Speaker -->
                    <td class="border border-gray-300 p-2">
                        <input type="text" name="transcripts[{{ $key }}][speaker]" 
                               class="w-full border rounded-lg p-1 focus:outline-none focus:ring-2 focus:ring-purple-600"
                               value="{{ $transcript['speaker'] }}" />
                    </td>

                    <!-- Start Time -->
                    <td class="border border-gray-300 p-2">
                        <input type="text" name="transcripts[{{ $key }}][start_time]" 
                               class="w-full border rounded-lg p-1 focus:outline-none focus:ring-2 focus:ring-purple-600"
                               value="{{ $transcript['start_time'] }}" />
                    </td>

                    <!-- End Time -->
                    <td class="border border-gray-300 p-2">
                        <input type="text" name="transcripts[{{ $key }}][end_time]" 
                               class="w-full border rounded-lg p-1 focus:outline-none focus:ring-2 focus:ring-purple-600"
                               value="{{ $transcript['end_time'] }}" />
                    </td>

                    <!-- Text -->
                    <td class="border border-gray-300 p-2">
                        <textarea name="transcripts[{{ $key }}][text]" 
                                  class="w-full border rounded-lg p-1 focus:outline-none focus:ring-2 focus:ring-purple-600 resize-none"
                                  rows="2">{{ $transcript['text'] }}</textarea>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Save Changes -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('user.dashboard') }}" 
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-4 hover:bg-gray-300">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
