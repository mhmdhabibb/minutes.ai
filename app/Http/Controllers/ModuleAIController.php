<?php

namespace App\Http\Controllers;

use App\Models\ModuleAI;
use Illuminate\Http\Request;

class ModuleAIController extends Controller
{
    public function index()
    {
        $modules = ModuleAI::latest()->get();
        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        return view('modules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'version' => 'required|numeric',
            'type' => 'required',
            'description' => 'required'
        ]);

        ModuleAI::create($request->all());
        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    public function edit(ModuleAI $module)
    {
        return view('modules.edit', compact('module'));
    }

    public function update(Request $request, ModuleAI $module)
    {
        $request->validate([
            'name' => 'required',
            'version' => 'required|numeric',
            'type' => 'required',
            'description' => 'required'
        ]);

        $module->update($request->all());
        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    public function destroy(ModuleAI $module)
    {
        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');
    }
}