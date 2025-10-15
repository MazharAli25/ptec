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
            <h1 class="text-3xl font-bold text-gray-800">Add Institute</h1>
            <p class="text-gray-600 mt-2">Fill in the details to add a new institute</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST" action="{{ route('institute.store') }}">
                @csrf
                <!-- Institute Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Institute Information</h2>

                    <div>
                        <label for="instituteName" class="block text-sm font-medium text-gray-700 mb-1">
                            Institute Name
                        </label>
                        <input type="text" id="instituteName"  name="instituteName"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter institute name">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                            Address
                        </label>
                        <textarea id="address" rows="3" name="address"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter institute address"></textarea>
                    </div>
                </div>

                <!-- Director Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Admin Information</h2>

                    <div>
                        <label for="directorName" class="block text-sm font-medium text-gray-700 mb-1">
                            Admin Name
                        </label>
                        <input type="text" id="directorName" name="directorName"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter director name">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter phone number">
                        </div>

                        <div>
                            <label for="directorEmail" class="block text-sm font-medium text-gray-700 mb-1">
                                Admin Email
                            </label>
                            <input type="email" id="directorEmail" name="directorEmail"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter director email">
                        </div>
                    </div>

                    <div class="grid  grid-cols-1 gap-4"> 
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Admin Password
                            </label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter Admin Password">
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            name="status">
                            <option value="active">Active</option>
                            <option value="unactive">unactive</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-2 flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add Institute
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Institute List</h2>
                <div class="text-sm text-gray-500">
                    Showing <span class="font-medium">0</span> institutes
                </div>
            </div>


            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Institute Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Director</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Empty state for now -->
                        @foreach ($insts as $inst)
                            <tr>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $inst['institute_name'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $inst['director_name'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $inst['director_phone'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $inst['status'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <!-- Edit Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-edit mr-1.5 text-xs"></i>
                                        Edit
                                    </a>

                                    <!-- View Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                                        <i class="fas fa-eye mr-1.5 text-xs"></i>
                                        View
                                    </a>

                                    <!-- Delete Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        <i class="fas fa-trash mr-1.5 text-xs"></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination (Placeholder) -->
            <div class="flex items-center justify-between mt-4 px-2">
                <div class="text-sm text-gray-700">
                    Showing 0 to 0 of 0 results
                </div>
                <div class="flex space-x-2">
                    <button
                        class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-500 bg-gray-50 cursor-not-allowed"
                        disabled>
                        Previous
                    </button>
                    <button
                        class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-500 bg-gray-50 cursor-not-allowed"
                        disabled>
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
