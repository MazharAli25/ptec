@extends('layouts.superAdmin')
@section('page-title', 'Add Admin')

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
            <h1 class="text-3xl font-bold text-gray-800">Add Admin</h1>
            <p class="text-gray-600 mt-2">Fill in the details to add a new admin</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8 flex justify-center">
            <form method="POST" action="{{ route('admin.update', encrypt($admin->id)) }}" class="w-[70%] space-y-2">
                @csrf
                @method('PUT')
                <!-- Director Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">
                        Director Information
                    </h2>

                    <!-- Institute Selection -->
                    <div>
                        <label for="institute_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Select Institute
                            {{-- <span class="text-red-500">(Choose an institute before filling credentials)</span> --}}
                        </label>
                        <select id="institute_id" name="institute_id"
                            class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select an option</option>
                            @foreach ($insts as $inst)
                                <option value="{{ $inst->id }}"
                                    {{ old('institute_id', $admin->institute_id ) == $inst->id ? 'selected' : '' }}>
                                    {{ $inst->institute_name }} 
                            @endforeach
                        </select>
                    </div>

                    <!-- Two-column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-6">
                        <!-- Admin Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                User Name
                            </label>
                            <input type="text" id="name" name="name" maxlength="30" value="{{ $admin->name }}"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter Admin name">
                        </div>

                        <!-- Admin Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                User Email
                            </label>
                            <input type="email" id="email" name="email" maxlength="50" value="{{ $admin->email }}"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter Admin email">
                        </div>
                    </div>

                    <!-- Two-column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <input type="tel" id="phone" name="phone" maxlength="11" id="phone"
                                value="{{ $admin->phone }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter phone number">
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Reset Password
                            </label>
                            <input type="password" id="password" name="password" maxlength="25"
                                value="{{ $admin->password }}"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter New Password">
                        </div>

                    </div>
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="active" {{ $admin->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $admin->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
                        Update Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // PHONE NUMBER FORMAT
        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('input', (e) => {
            // Remove all non-digit characters
            let value = e.target.value.replace(/\D/g, '');

            // Limit to 11 digits
            value = value.slice(0, 11);

            e.target.value = value;
        });
    </script>

@endsection
