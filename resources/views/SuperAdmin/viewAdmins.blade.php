@extends('layouts.superAdmin')
@section('page-title', 'View Admins')

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
            <h1 class="text-3xl font-bold text-gray-800">Institutes Admins</h1>
            <p class="text-gray-600 mt-2">View the details of institutes admins</p>
        </div>

        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs text-[25px] text-gray-800 uppercase tracking-wider">
                                Admin Institute</th>
                            <th class="px-6 py-3 text-left text-xs text-[25px] text-gray-800 uppercase tracking-wider">
                                Admin Name</th>
                            <th class="px-6 py-3 text-left text-xs text-[25px] text-gray-800 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-left text-xs text-[25px] text-gray-800 uppercase tracking-wider">
                                Phone</th>
                            <th class="px-6 py-3 text-left text-xs text-[25px] text-gray-800 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs text-[25px] text-gray-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Empty state for now -->
                        @foreach ($admins as $admin)
                            <tr>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $admin->institute->institute_name }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $admin['name'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $admin['email'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $admin['phone'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $admin['status'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <!-- Edit Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-edit text-base"></i>
                                    </a>

                                    <!-- View Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                                        <i class="fas fa-eye text-base"></i>
                                    </a>

                                    <!-- Delete Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        <i class="fas fa-trash text-base"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>

@endsection
