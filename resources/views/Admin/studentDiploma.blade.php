@extends('layouts.admin');
@section('page-title', 'Request For Certificate')

@section('main-content')

    <!-- Top search form -->
    <div class="pl-[22vw] pr-[5vw] mt-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h4 class="text-center text-[25px] font-semibold mb-6">ASSIGN DIPLOMA TO STUDENTS</h4>

            <form action="{{ route('studentDiploma.create') }}" method="GET">
                <div class="mt-3">
                    <label for="id" class="block text-sm font-medium text-gray-700 mb-1">
                        Search Student By Name
                    </label>

                    <div class="flex flex-row gap-3">
                        <input type="text" name="id" id="id"
                            class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 w-[60%]"
                            placeholder="Enter Student ID">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded text-[14px] hover:bg-green-700 transition-all">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($student->count() > 0)
        @php
            $student = $student[0];
        @endphp

        <!-- Student info area -->
        <div class="pl-[16vw]">
            <div class="bg-white rounded-lg p-8 mt-8 max-w-[1000px] mx-auto">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Student Information</h2>

                <div class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-1/3 flex justify-center items-start">
                        @if (!empty($student->image))
                            <img src="{{ asset($student->image) }}" 
                                alt="Student Photo"
                                class="w-40 h-40 object-cover rounded-lg shadow-md border border-gray-200">
                        @else
                            <div
                                class="w-40 h-40 flex items-center justify-center bg-gray-100 text-gray-400 border border-gray-200 rounded-lg shadow-inner">
                                No Image
                            </div>
                        @endif
                    </div>

                    <!-- Student Details Form -->
                    <div class="md:w-2/3">
                        <form method="POST" action="{{ route('studentDiploma.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="student_id"
                                        class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                                    <input type="text" id="student_id" name="student_id" value="{{ $student->id }}"
                                        readonly
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 rounded-lg focus:outline-none">
                                </div>

                                <!-- Student Name -->
                                <div>
                                    <label for="student_name"
                                        class="block text-sm font-medium text-gray-700 mb-1">Student Name</label>
                                    <input type="text" id="student_name" name="student_name"
                                        value="{{ $student->name }}" readonly
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 rounded-lg focus:outline-none">
                                </div>

                                <!-- Father Name -->
                                <div>
                                    <label for="father_name"
                                        class="block text-sm font-medium text-gray-700 mb-1">Father Name</label>
                                    <input type="text" id="father_name" name="father_name"
                                        value="{{ $student->fatherName }}" readonly
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 rounded-lg focus:outline-none">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $student->email }}" readonly
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 rounded-lg focus:outline-none">
                                </div>

                                <!-- Status -->
                                {{-- <div>
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <input type="text" id="status" name="status" value="{{ $student->status }}" readonly
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 rounded-lg focus:outline-none">
                                </div> --}}

                                <!-- Diploma Dropdown -->
                                <div>
                                    <label for="diploma_id"
                                        class="block text-sm font-medium text-gray-700 mb-1">Assign Diploma</label>
                                    <select id="diploma_id" name="diploma_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Diploma</option>
                                        @foreach ($diplomas as $diploma)
                                            {{-- <input type="hidden" name="sessionID" value="{{ $diploma->session->session }}"> --}}
                                            <option value="{{ $diploma->id }}">{{ $diploma->DiplomaName }} ({{$diploma->session->session}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Semester Dropdown -->
                                <div>
                                    <label for="semester_id"
                                        class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                                    <select id="semester_id" name="semester_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Semester</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}">{{ $semester->semesterName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-center mt-8">
                                <button type="submit"
                                    class="px-8 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                                    Assign Diploma
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-center text-gray-400 mt-8">No student found yet. Please search by Student ID.</p>
    @endif

@endsection
