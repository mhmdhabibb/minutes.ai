@extends('admin.layouts.base')

@section('title', 'Admin Settings')

@section('content')

{{-- Header --}}
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Settings</h1>
</div>

{{-- Content Box --}}
<div class="bg-white p-8 rounded-lg shadow-md">
    <form id="admin-profile-form">
        <!-- Profile Section -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4">Profile</h2>
            <div class="flex flex-col md:flex-row items-start mb-10">
                <!-- Profile Image and Upload Button -->
                <div class="relative w-48 h-48 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center">
                    <img id="profile-pic" src="{{ Auth::guard('admin')->user()->photo_profile ? asset(Auth::guard('admin')->user()->photo_profile) : asset('asset/img/default-profile.png') }}" alt="Profile Picture" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                        <button type="button" onclick="document.getElementById('photo-upload').click();" class="text-white text-sm bg-gray-600 px-4 py-2 rounded">Upload Photo</button>
                        <input type="file" id="photo-upload" name="photo_profile" class="hidden" accept="image/*" onchange="previewPhoto(event)">
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:ml-6 w-full md:w-auto">
                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text" id="name" name="name" value="{{ Auth::guard('admin')->user()->name }}" class="p-2 w-full border rounded" placeholder="Admin Name">
                    </div>
                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::guard('admin')->user()->email }}" class="p-2 w-full border rounded" placeholder="admin@example.com">
                    </div>
                    <div>
                        <label class="block font-medium">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ Auth::guard('admin')->user()->phone }}" class="p-2 w-full border rounded" placeholder="+1234567890">
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Change Password</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium">Current Password</label>
                    <input type="password" id="current-password" name="current_password" class="p-2 w-full border rounded" placeholder="Current Password">
                </div>
                <div>
                    <label class="block font-medium">New Password</label>
                    <input type="password" id="new-password" name="new_password" class="p-2 w-full border rounded" placeholder="New Password">
                </div>
                <div>
                    <label class="block font-medium">Confirm New Password</label>
                    <input type="password" id="confirm-password" name="new_password_confirmation" class="p-2 w-full border rounded" placeholder="Confirm New Password">
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="reset" class="bg-gray-300 px-4 py-2 rounded mr-4 hover:bg-gray-400">Cancel</button>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Save</button>
        </div>
    </form>
</div>

<script>
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-pic').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    document.getElementById('admin-profile-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch("{{ route('admin.update_profile') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            });

            const data = await response.json();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Settings updated successfully.',
                    showConfirmButton: true,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'An error occurred while updating settings.',
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An unexpected error occurred. Please try again.',
            });
        }
    });
</script>
@endsection
