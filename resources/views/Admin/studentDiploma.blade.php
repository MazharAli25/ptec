@extends('layouts.admin');
@section('page-title', 'Request For Certificate')

@section('main-content')
    <style>
        .select2-container .select2-selection--single {
            height: 42px !important;
            border: 1px solid #d1d5db !important;
            /* Tailwind border-gray-300 */
            border-radius: 0.5rem !important;
            /* rounded-lg */
            padding: 6px 10px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 7px !important;
            right: 10px !important;
        }
    </style>

    <!-- Top search form -->
    <div class="pl-[22vw] pr-[5vw] mt-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h4 class="text-center text-[25px] font-semibold mb-6">ASSIGN DIPLOMA TO STUDENTS</h4>

            <form action="{{ route('studentDiploma.create') }}" method="GET">
                <div class="mt-3">
                    <label for="id" class="block text-sm font-medium text-gray-700 mb-1">
                        Search Student By ID
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
            <div class="bg-white rounded-lg p-8 mt-8 max-w-[1000px] mx-auto relative">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Student Information</h2>

                <div class="flex flex-col md:flex-row gap-8">

                    <!-- Left: Student Info -->
                    <div class="md:w-2/3">
                        <form method="POST" action="{{ route('studentDiploma.store') }}">
                            @csrf

                            <!-- student info inputs (unchanged) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Student ID -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                                    <input type="text" name="student_id" value="{{ $student->id }}" readonly
                                        class="w-full px-4 py-2 border bg-gray-100 rounded-lg">
                                </div>

                                <!-- Student Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Student Name</label>
                                    <input type="text" name="student_name" value="{{ $student->name }}" readonly
                                        class="w-full px-4 py-2 border bg-gray-100 rounded-lg">
                                </div>

                                <!-- Father Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Father Name</label>
                                    <input type="text" name="father_name" value="{{ $student->fatherName }}" readonly
                                        class="w-full px-4 py-2 border bg-gray-100 rounded-lg">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" value="{{ $student->email }}" readonly
                                        class="w-full px-4 py-2 border bg-gray-100 rounded-lg">
                                </div>
                            </div>
                    </div>

                    <!-- Right: Photo -->
                    <div class="md:w-1/3 flex justify-end pr-20">
                        @if (!empty($student->image))
                            <img src="{{ asset('Storage/'.$student->image) }}" class="w-40 h-40 object-cover rounded-lg border">
                        @else
                            <div
                                class="w-40 h-40 flex items-center justify-center bg-gray-100 text-gray-400 border rounded-lg">
                                No Image
                            </div>
                        @endif
                    </div>
                </div>

                <!-- NOW this is FULL WIDTH under the photo -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 mb-5">

                    <!-- Diploma -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Assign Diploma</label>
                        <select id="diploma_id" name="diploma_id"
                            class="select2 w-full px-4 py-2 border rounded-lg bg-white">
                            <option value="">Select Diploma</option>
                            @foreach ($diplomas as $diploma)
                                <option value="{{ $diploma->id }}">{{ $diploma->DiplomaName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Session -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Session</label>
                        <select id="session_id" name="session_id"
                            class="select2 w-full px-4 py-2 border rounded-lg bg-white">
                            <option value="">Select Session</option>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Assign Semester</label>
                        <select id="semester_id" name="semester_id"
                            class="select2 w-full px-4 py-2 border rounded-lg bg-white">
                            <option value="">Select Semester</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semesterName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                        Assign Diploma
                    </button>
                </div>

                </form>

            </div>
        </div>
    @else
        <p class="text-center text-gray-400 mt-8">No student found yet. Please search by Student ID.</p>
    @endif

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Please select",
                allowClear: true,
                width: '100%'
            });

            $('#diploma_id').on('change', function() {
                let diplomaId = $(this).val();
                let sessionDropdown = $('#session_id');

                sessionDropdown.empty().append('<option value="">Loading...</option>').trigger('change');

                if (diplomaId) {
                    $.ajax({
                        url: '/get-sessions/' + $('#diploma_id option:selected').text(),
                        type: 'GET',
                        success: function(data) {
                            sessionDropdown.empty().append(
                                '<option value="">Select Session</option>');

                            if (data.length > 0) {
                                $.each(data, function(index, item) {
                                    sessionDropdown.append(
                                        `<option value="${item.id}">${item.name}</option>`
                                    );
                                });
                            } else {
                                sessionDropdown.append(
                                    '<option value="">No sessions found</option>');
                            }

                            sessionDropdown.trigger('change');
                        },
                        error: function() {
                            sessionDropdown.empty().append(
                                '<option value="">Error loading sessions</option>');
                        }
                    });
                } else {
                    sessionDropdown.empty().append('<option value="">Select Session</option>').trigger(
                        'change');
                }
            });
        });
    </script>


@endsection
