<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AIModelController extends Controller
{
    public function index()
    {
        $models = [
            'speech-to-text' => AIModel::where('category', 'speech-to-text')->get(),
            'diarization' => AIModel::where('category', 'diarization')->get(),
            'summarization' => AIModel::where('category', 'summarization')->get(),
        ];
    
        return view('admin.models.index', compact('models'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'version' => 'required|string|max:50',
            'description' => 'required|string',
            'category' => 'required|in:speech-to-text,diarization,summarization',
            'file' => 'required|file|mimes:zip,rar,7z,h5,pt,bin,pdf|max:102400',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('ai_models');

        $model = AIModel::create([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'version' => $validatedData['version'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'is_active' => false,
            'file_path' => $filePath,
        ]);

        return response()->json($model, 201);
    }

    public function activate($id)
    {
        $model = AIModel::findOrFail($id);
        AIModel::where('category', $model->category)->update(['is_active' => false]);
        $model->update(['is_active' => true]);
        return response()->json(['message' => 'Model activated successfully']);
    }

    public function destroy($id)
    {
        $model = AIModel::findOrFail($id);
        Storage::delete($model->file_path);
        $model->delete();
        return response()->json(['message' => 'Model deleted successfully']);
    }
}