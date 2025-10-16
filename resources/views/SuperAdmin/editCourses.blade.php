@extends('layouts.superAdmin')
@section('page-title', 'Edit Course')

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
            <h1 class="text-3xl font-bold text-gray-800">Edit Course</h1>
            <p class="text-gray-600 mt-2">Refill in the details to edit the Course</p>
        </div>


        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8 flex justify-center">
            <form class="flex flex-col w-[70%]" method="POST" action="{{ route('course.update', $course) }}">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Course Information</h2>
                    <div class="flex justify-evenly">
                        <div>
                            <label for="edit_courseName" class="block text-sm font-medium text-gray-700 mb-1">
                                Course Name
                            </label>
                            <input type="text" id="edit_courseName" name="edit_courseName" value="{{ $course->courseName }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter Course name">
                        </div>

                        <div>
                            <label for="edit_courseDuration" class="block text-sm font-medium text-gray-700 mb-1">
                                Select Duration
                            </label>

                            <input list="edit_coursedurations" name="edit_courseDuration" id="courseDuration" value="{{ $course->courseDuration }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Type or select a duration">

                            <datalist id="coursedurations">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }} {{ $i == 1 ? 'month' : 'months' }}"></option>
                                @endfor
                            </datalist>

                        </div>

                    </div>
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-2 flex justify-center mt-8">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i> Update Course
                    </button>
                </div>
            </form>
        </div>

    </div>
    </div>

@endsection
