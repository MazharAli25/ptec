@extends('layouts.student')
@section('title', 'My Courses')
@section('main-content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($courses as $course)
            <div
                class="bg-white w-[20vw] rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">

                <!-- Thumbnail -->
                <div class="h-20 bg-gradient-to-r from-green-500 to-green-700 flex items-center justify-center">
                    <i class="fas fa-book-open text-white text-4xl"></i>
                </div>

                <!-- Content -->
                <div class="p-3 space-y-3">

                    <!-- Course Title -->
                    <h3 class="text-lg font-semibold text-gray-800 leading-tight">
                        {{ $course->diplomawiseCourse->course->courseName }}
                    </h3>

                    <!-- Diploma -->
                    <p class="text-sm text-gray-500">
                        Diploma: {{ $course->diplomawiseCourse->diploma->DiplomaName }}
                    </p>

                    <!-- Session -->
                    <p class="text-sm text-gray-500">
                        Session: {{ $course->diplomawiseCourse->session->session }}
                    </p>

                    <!-- Status -->
                    {{-- <span class="inline-block text-xs font-medium px-3 py-1 rounded-full bg-green-100 text-green-700">
                        In Progress
                    </span> --}}

                </div>
            </div>
        @endforeach
    </div>

@endsection
{{-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">My Courses</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Course</th>
                    <th class="px-6 py-3">Diploma</th>
                    <th class="px-6 py-3">Semester</th>
                    <th class="px-6 py-3">Progress</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                <!-- Row -->
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        Web Development
                    </td>

                    <td class="px-6 py-4">
                        Information Technology
                    </td>

                    <td class="px-6 py-4">
                        Semester 2
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                            <span class="text-xs font-medium">65%</span>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            In Progress
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold rounded-lg bg-green-600 hover:bg-green-700 text-white transition">
                            Continue
                        </a>
                    </td>
                </tr>

                <!-- Completed Row -->
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        PHP Basics
                    </td>

                    <td class="px-6 py-4">
                        Information Technology
                    </td>

                    <td class="px-6 py-4">
                        Semester 1
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 100%"></div>
                            </div>
                            <span class="text-xs font-medium">100%</span>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                            Completed
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold rounded-lg bg-gray-600 hover:bg-gray-700 text-white transition">
                            View
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div> --}}
