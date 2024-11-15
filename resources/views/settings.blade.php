<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/> 
    <style>
        #mobile-sidebar {
            transition: transform 0.5s ease; 
            transform: translateX(-100%);
        }
        #mobile-sidebar.show {
            transform: translateX(0); 
        }
        #record-popup {
            display: none;
            backdrop-filter: blur(15px);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-white w-1/5 min-h-screen p-10 hidden md:hidden lg:block">
            <div class="flex justify-center items-center mb-20">
                <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="h-16">
            </div>
            <nav class="space-y-6">
                <a class="text-lg flex items-center p-2 rounded menu-item" href="#" data-page="dashboard">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <a class="text-lg flex items-center p-2 rounded menu-item bg-[#624b6e]" href="#" data-page="settings">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <a class="text-lg flex items-center p-2 rounded menu-item" href="#" data-page="logout">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-6">Settings</h1>
            <div class="bg-white p-8 rounded-lg shadow-md">

                <!-- Profile Section -->
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-4">Profile</h2>
                    <div class="flex flex-col md:flex-row items-start mb-10">
                        <!-- Profile Image and Upload Button -->
                        <div class="relative w-48 h-48 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center">
                            <img id="profile-pic" src="profile-pic.jpg" alt="Profile Picture" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                <button onclick="document.getElementById('photo-upload').click();" class="text-white text-sm bg-gray-600 px-4 py-2 rounded">Upload Photo</button>
                                <input type="file" id="photo-upload" class="hidden" accept="image/*" onchange="previewPhoto(event)">
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:ml-10 w-full md:w-auto">
                            <div>
                                <label class="block font-medium">Name</label>
                                <div class="relative mt-2">
                                    <span class="absolute inset-y-0 left-0 pl-2 flex items-center text-gray-400">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" id="name" class="p-2 pl-8 w-full border rounded" placeholder="John Doe">
                                </div>
                            </div>
                            <div>
                                <label class="block font-medium">Email</label>
                                <div class="relative mt-2">
                                    <span class="absolute inset-y-0 left-0 pl-2 flex items-center text-gray-400">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" id="email" class="p-2 pl-8 w-full border rounded" placeholder="john@example.com">
                                </div>
                            </div>
                            <div>
                                <label class="block font-medium">Phone Number</label>
                                <div class="relative mt-2">
                                    <span class="absolute inset-y-0 left-0 pl-2 flex items-center text-gray-400">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" id="phone" class="p-2 pl-8 w-full border rounded" placeholder="+1234567890">
                                </div>
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
                            <input type="password" id="current-password" class="mt-2 p-2 w-full border rounded" placeholder="********">
                        </div>
                        <div>
                            <label class="block font-medium">New Password</label>
                            <input type="password" id="new-password" class="mt-2 p-2 w-full border rounded" placeholder="********">
                        </div>
                        <div>
                            <label class="block font-medium">Confirm New Password</label>
                            <input type="password" id="confirm-password" class="mt-2 p-2 w-full border rounded" placeholder="********">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button onclick="clearForm()" class="bg-gray-300 px-4 py-2 rounded mr-4 hover:bg-gray-400">Cancel</button>
                    <button onclick="saveSettings()" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Save</button>
                </div>
            </div>
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

        function saveSettings() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (newPassword && newPassword === confirmPassword) {
                localStorage.setItem('password', newPassword);
                alert('Password updated successfully');
            } else if (newPassword !== confirmPassword) {
                alert('New password and confirm password do not match.');
                return;
            }

            localStorage.setItem('name', name);
            localStorage.setItem('email', email);
            localStorage.setItem('phone', phone);

            alert('Settings saved successfully');
            
            // Redirect to the dashboard page
            window.location.href = 'http://127.0.0.1:8000/dashboard'; // Update this URL if needed
        }

        function clearForm() {
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('current-password').value = '';
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('name').value = localStorage.getItem('name') || '';
            document.getElementById('email').value = localStorage.getItem('email') || '';
            document.getElementById('phone').value = localStorage.getItem('phone') || '';
        });
    </script>
</body>
</html>
