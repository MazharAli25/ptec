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
            <form method="POST" action="{{ route('institute.store') }}" class="space-y-6">
                @csrf

                <!-- Institute Information -->
                <div class="space-y-4 w-full">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Institute Information</h2>

                    <div class="flex flex-wrap justify-between gap-4">
                        <!-- Institute Name -->
                        <div class="flex-1 min-w-[250px]">
                            <label for="instituteName" class="block text-sm font-medium text-gray-700 mb-1">
                                Institute Name
                            </label>
                            <input type="text" id="instituteName" name="instituteName" value="{{ old('instituteName') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter institute name">
                        </div>

                        <!-- Address -->
                        <div class="flex-1 min-w-[250px]">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                Address
                            </label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter institute address">
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

        <!-- Table Section -->
        <div class="bg-white rounded-lg form-shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Institute List</h2>
            </div>

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">Institute Name</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">Address</th>
                            <th class="px-6 py-3 text-center text-[14px] font-semibold text-gray-800 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($insts as $inst)
                            <tr>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $inst['id'] }}
                                </td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $inst['institute_name'] }}
                                </td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $inst['address'] ?: 'Nill' }}
                                </td>
                                <td class="px-6 py-3 w-[35%] text-center text-xs font-medium text-gray-600 tracking-wider">
                                    <a href="{{ route('institute.edit', $inst) }}"
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-edit text-base"></i>
                                    </a>

                                    <form action="{{ route('institute.destroy', $inst) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors inline-flex">
                                            <i class="fas fa-trash text-base"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
