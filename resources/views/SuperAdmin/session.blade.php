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
            <h1 class="text-3xl font-bold text-gray-800">Add Session</h1>
            <p class="text-gray-600 mt-2">Fill in the details to add a new Session</p>
        </div>
        

        <!-- Form Section -->   
        <div class="bg-white rounded-lg form-shadow p-6 mb-8 flex justify-center">
            <form class="flex flex-col w-[70%]" method="POST" action="{{ route('session.store') }}">
                @csrf
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Session Information</h2>
                    <div  class="flex flex-col-2 justify-evenly">
                        <div>
                            <label for="sessionStart" class="block text-sm font-medium text-gray-700 mb-1">
                                Session Starts at
                            </label>
                            <input type="date" id="sessionStart"  name="sessionStart"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter institute name">
                        </div>
    
                        <div>
                            <label for="sessionEnd" class="block text-sm font-medium text-gray-700 mb-1">
                                Session ends at
                            </label>
                            <input type="date" id="sessionEnd"  name="sessionEnd"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter institute name">
                        </div>

                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="md:col-span-2 flex justify-center mt-8">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add Session
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Sessions List</h2>
                
            </div>


            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Session Starts At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Session Ends At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Empty state for now -->
                        @foreach ($sessions as $session)
                            <tr>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $session['sessionStart'] }}</td>
                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $session['sessionEnd'] }}</td>
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

        </div>
    </div>
    </div>

@endsection

