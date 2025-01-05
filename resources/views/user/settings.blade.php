@extends('user.layouts.app')

@section('title', 'Settings')

@section('content')

{{-- Header --}}
<div class="flex justify-between items-center mb-8">
    <button id="hamburger" class="lg:hidden p-2 mr-4 text-black focus:outline-none">
        <i class="fas fa-bars"></i>
    </button>
    <h1 class="text-3xl font-bold text-gray-800">Settings</h1>
</div>

{{-- Content Box --}}
<div class="bg-white p-8 rounded-lg shadow-md">
    <!-- Profile Section -->
    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-4">Profile</h2>
        <form id="profile-form">
            <div class="flex flex-col md:flex-row items-start mb-10">
                <!-- Profile Image and Upload Button -->
                <div class="relative w-48 h-48 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center">
                    <img id="profile-pic" src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('asset/img/default-profile.png') }}" alt="Profile Picture" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                        <button type="button" onclick="document.getElementById('photo-upload').click();" class="text-white text-sm bg-gray-600 px-4 py-2 rounded">Upload Photo</button>
                        <input type="file" id="photo-upload" name="profile_picture" class="hidden" accept="image/*" onchange="previewPhoto(event)">
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:ml-6 w-full md:w-auto">
                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="p-2 w-full border rounded" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="p-2 w-full border rounded" placeholder="example@email.com">
                    </div>
                    <div>
                        <label class="block font-medium">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" class="p-2 w-full border rounded" placeholder="+1234567890">
                    </div>
                </div>
            </div>

            <!-- Change Password Section -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Change Password</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                        <input type="password" id="confirm-password" name="password_confirmation" class="p-2 w-full border rounded" placeholder="Confirm New Password">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="button" onclick="clearForm()" class="bg-gray-300 px-4 py-2 rounded mr-4 hover:bg-gray-400">Cancel</button>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Save</button>
            </div>
        </form>
    </div>
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

    async function saveSettings(event) {
        event.preventDefault();

        const formData = new FormData(document.getElementById('profile-form'));

        try {
            const response = await fetch("{{ route('user.update_profile') }}", {
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
                    title: data.message || 'Settings updated successfully.',
                    showConfirmButton: true,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'An error occurred while updating the settings.',
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
        }
    }

    function clearForm() {
        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('current-password').value = '';
        document.getElementById('new-password').value = '';
        document.getElementById('confirm-password').value = '';
    }

    document.getElementById('profile-form').addEventListener('submit', saveSettings);
</script>
@endsection
