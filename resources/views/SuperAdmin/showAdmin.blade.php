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
            <h1 class="text-3xl font-bold text-gray-800">Add Details</h1>
            <p class="text-gray-600 mt-2">View details of an admin</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8 flex justify-center">
            <form method="POST" action="{{ route('admin.store') }}" class="w-[70%] space-y-2">
                @csrf

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
                        <input value="{{ $admin->institute->institute_name }}"
                            class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly>
                        </input>
                    </div>

                    <!-- Two-column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-6">
                        <!-- Admin Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                User Name
                            </label>
                            <input type="text" value="{{ $admin->name }}"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly>
                        </div>

                        <!-- Admin Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                User Email
                            </label>
                            <input type="email" value="{{ $admin->email }}"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly>
                        </div>
                    </div>

                    <!-- Two-column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <input type="tel" value="{{ $admin->phone }}"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly>
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                            </label>
                            <input value="{{ $admin->password }}"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly>
                        </div>

                    </div>
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <input value="{{ $admin->status }}"
                            class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.create') }}"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection