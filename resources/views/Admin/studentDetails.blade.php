@extends('layouts.admin')

@section('page-title', 'Student Details')

@section('main-content')
    <div class="ml-[18vw] min-h-screen bg-gray-50 flex justify-center py-12 px-6">

        <div class="bg-white w-[90%] max-w-6xl rounded-2xl shadow-lg border border-gray-200 overflow-hidden relative">

            <!-- Header Section -->
            <div
                class="bg-gradient-to-r from-green-600 to-green-500 text-white p-8 rounded-t-2xl flex flex-col md:flex-row items-center justify-between shadow-md">
                <div class="flex items-center space-x-6">
                    @if ($student->image)
                        <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo"
                            class="w-32 h-32 rounded-xl object-cover shadow-md border-2 border-white transition-transform hover:scale-105" />
                    @else
                        <div
                            class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-white rounded-xl bg-green-500/20 text-white">
                            <svg class="w-10 h-10 mb-2 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16V4m10 12V4m-9 8l2 2 4-4m5 6H5" />
                            </svg>
                            <p class="text-sm">No Image</p>
                        </div>
                    @endif

                    <div class="">
                        <h2 class="text-3xl font-bold" id="name">{{ $student->name }}</h2>
                        <p class="text-sm text-green-100 mt-1" id="student-id">Student ID: {{ $student->id }}</p>
                        <p class="text-sm text-green-100" id="institute-name">{{ $student->institute->institute_name ?? 'Institute: N/A' }}</p>
                    </div>
                </div>

                <!-- Buttons (Hide in Print) -->
                <div class="mt-6 md:mt-0 flex space-x-3 no-print">
                    <button onclick="window.print()"
                        class="bg-green-100 text-green-700 px-5 py-2 rounded-lg font-semibold hover:bg-green-200 transition-all shadow">
                        Print
                    </button>
                    <a href="{{ route('student.edit', $student->id) }}"
                        class="bg-white text-green-600 px-5 py-2 rounded-lg font-semibold hover:bg-green-100 transition-all shadow">
                        Edit
                    </a>
                    <a href="{{ route('admin.studentList') }}"
                        class="bg-green-700 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-800 transition-all shadow">
                        Back
                    </a>
                </div>
            </div>

            <!-- Student Info -->
            <div class="p-10">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Personal Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <p class="text-gray-500 text-sm">Full Name</p>
                        <p class="font-medium text-gray-800">{{ $student->name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Father Name</p>
                        <p class="font-medium text-gray-800">{{ $student->fatherName }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Date of Birth</p>
                        <p class="font-medium text-gray-800">{{ $student->dob }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">CNIC</p>
                        <p class="font-medium text-gray-800">{{ $student->cnic }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="font-medium text-gray-800">{{ $student->email }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Contact</p>
                        <p class="font-medium text-gray-800">{{ $student->phone }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Gender</p>
                        <p class="font-medium text-gray-800">{{ $student->gender }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-500 text-sm">Address</p>
                        <p class="font-medium text-gray-800">{{ $student->address }}</p>
                    </div>
                </div>

                <!-- Enrollment Details -->
                <div class="mt-10 border-t pt-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Enrollment Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-500 text-sm">Institute</p>
                            <p class="font-medium text-gray-800">{{ $student->institute->institute_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Registration Date</p>
                            <p class="font-medium text-gray-800">{{ $student->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Diplomas & Courses -->
                <div class="mt-10 border-t pt-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Enrolled Diplomas & Courses</h3>

                    @if ($student->studentDiplomas->count() > 0)
                        @foreach ($student->studentDiplomas as $index => $stdDiploma)
                            <div class="mb-8 bg-gray-50 rounded-xl border border-gray-200 shadow-sm p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h4 class="text-lg font-semibold text-green-700">
                                            {{ $stdDiploma->diploma->DiplomaName ?? 'Unnamed Diploma' }}
                                            <span class="text-sm text-gray-500 ml-2">
                                                ({{ $stdDiploma->semester->semesterName ?? 'N/A' }})
                                            </span>
                                        </h4>
                                    </div>
                                    <div>
                                        @if ($stdDiploma->issue_diploma)
                                            <span
                                                class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                                Diploma Issued
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                                In Progress
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if (count($stdDiploma->studentCourses) > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full border border-gray-200 text-sm rounded-lg overflow-hidden">
                                            <thead class="bg-green-600 text-white">
                                                <tr>
                                                    <th class="px-4 py-2 text-left font-semibold">#</th>
                                                    <th class="px-4 py-2 text-left font-semibold">Course Name</th>
                                                    <th class="px-4 py-2 text-left font-semibold">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($stdDiploma->studentCourses as $i => $studentCourse)
                                                    <tr class="hover:bg-gray-50 transition">
                                                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                                                        <td class="px-4 py-2 font-medium text-gray-800">
                                                            {{ $studentCourse->diplomawiseCourse->course->courseName ?? 'N/A' }}
                                                        </td>
                                                        <td class="px-4 py-2">
                                                            @if ($studentCourse->status == 'completed')
                                                                <span
                                                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                                                    Completed
                                                                </span>
                                                            @elseif ($studentCourse->status == 'in-progress')
                                                                <span
                                                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                                                    In Progress
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                                                    Not Started
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic mt-2">No courses found for this diploma.</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 italic">No diplomas or courses assigned to this student yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Hide buttons & clean layout for print -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            #name{
                font-size: 20px !important;
            }

            #name, #student-id, #institute-name {
                color: black !important;
            }
        }
    </style>
@endsection
