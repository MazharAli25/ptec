@extends('layouts.admin')
@section('title', 'Change Account Password')
@section('body-classes', 'bg-gray-100 pt-10 pl-65')
@section('main-content')
    
        <!-- Container -->
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow p-6">

            <!-- Title -->
            <h2 class="text-xl font-semibold mb-6">Change Account Password</h2>

            <!-- Search Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-medium mb-1">User ID</label>
                    <input type="text" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
                       name="userId" placeholder="1234">
                </div>

                {{-- <div>
                    <label class="block text-sm font-medium mb-1">User Role</label>
                    <select class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                        <option>Student</option>
                        <option>Teacher</option>
                        <option>Admin</option>
                    </select>
                </div> --}}

                <div class="flex items-end">
                    <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                        Search
                    </button>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="flex flex-col md:flex-row gap-6 items-start">

                <!-- Profile Image -->
                <div class="w-32 h-40 border rounded overflow-hidden">
                    <img src=""
                        alt="Profile"
                        class="w-full h-full object-cover">
                </div>

                <!-- User Details -->
                <div class="flex-1 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">User ID</label>
                        <input type="text" value="" readonly
                            class="w-full bg-gray-100 border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Username</label>
                        <input type="text" value="" readonly
                            class="w-full bg-gray-100 border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" value="" readonly
                            class="w-full bg-gray-100 border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Password without spaces</label>
                        <input type="password" id="newPassword"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
                            placeholder="New password">
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="mt-8 text-center">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Save
                </button>
            </div>
        </div>

        <!-- Optional JS -->
        <script>
            function changePassword() {
                const password = document.getElementById('newPassword').value;

                if (!password || password.includes(' ')) {
                    alert('Password cannot be empty or contain spaces.');
                    return;
                }

                alert('Password changed successfully (demo).');
            }
        </script>

@endsection
