<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Update admin profile information.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:15',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('photo_profile')) {
            $imageName = time() . '.' . $request->photo_profile->extension();
            $request->photo_profile->move(public_path('uploads/admin_profiles'), $imageName);
            $validatedData['photo_profile'] = 'uploads/admin_profiles/' . $imageName;
        }

        // Handle password update
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return response()->json([
                    'message' => 'The current password is incorrect.',
                ], 422);
            }

            if ($request->new_password !== $request->new_password_confirmation) {
                return response()->json([
                    'message' => 'New password and confirmation password do not match.',
                ], 422);
            }

            $validatedData['password'] = Hash::make($request->new_password);
        }

        // Update admin profile
        $admin->update($validatedData);

        return response()->json([
            'message' => 'Profile updated successfully.',
            'admin' => $admin,
        ]);
    }
}
