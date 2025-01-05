<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Transcription;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
            'current_password' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/profile_pictures'), $imageName);
            $validatedData['profile_picture'] = 'uploads/profile_pictures/' . $imageName;
        }

        // Handle password update
        if ($request->filled('current_password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'message' => 'Current password is incorrect.',
                ], 422);
            }

            // Verify new password matches confirmation
            if ($request->new_password !== $request->password_confirmation) {
                return response()->json([
                    'message' => 'New password and confirmation do not match.',
                ], 422);
            }

            // Update the password
            $validatedData['password'] = Hash::make($request->new_password);
        }

        // Update user profile
        $user->update($validatedData);

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => $user,
        ]);
    }

    /**
     * Display the user dashboard.
     */
    public function dashboard(Request $request)
{
    // Fetch the search query (if any)
    $search = $request->input('search');

    // Query the transcriptions for the authenticated user
    $transcriptions = Transcription::where('user_id', auth()->id())
        ->when($search, function ($query, $search) {
            $query->where('file_name', 'like', '%' . $search . '%'); // Search by file name
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // Pass the transcriptions and search query to the view
    return view('user.dashboard', [
        'transcriptions' => $transcriptions,
        'search' => $search, // Pass the search query to persist it in the search input
    ]);
}

    
}
