@extends('layouts.superAdmin')
@section('page-title', 'Add Institute')

@section('main-content')

    <x-err></x-err>
    <x-success></x-success>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 ml-[20vw]">
            <strong>Whoops! Something went wrong:</strong>
            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Content -->
    <div class="flex-1 p-8 ml-[19vw]">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Settings</h1>
            <p class="text-gray-600 mt-2">Fill in the details to update your information</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8">
            <form method="POST" action="{{ route('superAdmin.update', Auth::guard('super_admin')->user() ) }}" class="space-y-6">
                @csrf
                @method('PUT')
                <!-- Institute Information -->
                <div class="space-y-4 w-full">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Change Password</h2>

                    <div class="flex flex-wrap justify-between gap-4">
                        <!-- Password -->
                        <div class="flex-1 min-w-[250px] relative">
                            <label for="changePassword" class="block text-sm font-medium text-gray-700 mb-1">
                                Enter Your Password
                            </label>
                            <input type="password" id="changePassword" name="changePassword"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10"
                                placeholder="Enter your password">
                            <!-- Eye Icon -->
                            <i class="fa-solid fa-eye absolute right-3 top-9 text-gray-500 cursor-pointer hover:text-gray-700"
                               onclick="togglePassword('changePassword', this)"></i>
                        </div>

                        <!-- Confirm Password -->
                        <div class="flex-1 min-w-[250px] relative">
                            <label for="changePassword_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Confirm Password
                            </label>
                            <input type="password" id="changePassword_confirmation" name="changePassword_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10"
                                placeholder="Confirm password">
                            <!-- Eye Icon -->
                            <i class="fa-solid fa-eye absolute right-3 top-9 text-gray-500 cursor-pointer hover:text-gray-700"
                               onclick="togglePassword('password_confirmation', this)"></i>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword(id, icon) {
            const input = document.getElementById(id);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

@endsection
