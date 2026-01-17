@extends('layouts.superAdmin')
@section('page-title', 'Examination Marks')

@section('main-content')

    <!-- Main Content -->
    <div class="flex-1 p-8 ml-[19vw]">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Exam Marks</h1>
            <p class="text-gray-600 mt-2">Fill in the details to assign exam marks</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8">
            <form method="POST" action="{{ route('examination-criteria.store') }}" class="w-full">
                @csrf

                <!-- Title -->
                <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">
                    Assign Exam Marks
                </h2>

                <!-- Top Inputs: Diploma & Semester -->
                <div class="flex flex-wrap justify-between items-center gap-6 w-full mb-6">
                    <!-- Diploma -->
                    <div class="flex-1 min-w-[250px]">
                        <label for="theoryMarks" class="block text-sm font-medium text-gray-700 mb-1">
                            Theory Marks
                        </label>
                        <input type="number" name="theoryMarks" id="theoryMarks"
                            class="w-full px-4 py-2 outline-none border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter Theory Marks" value="{{ old('theoryMarks') }}">
                        @error('theorylMarks')
                            <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Practical Marks --}}
                    <div class="flex-1 min-w-[250px]">
                        <label for="practicallMarks" class="block text-sm font-medium text-gray-700 mb-1">
                            Practical Marks
                        </label>
                        <input type="number" name="practicalMarks" id="practicallMarks"
                            class="w-full px-4 py-2 border outline-none border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter Practical Marks" value="{{ old('practicallMarks') }}">
                        @error('practicallMarks')
                            <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Course Selection Table -->
                <h2 class="font-medium text-gray-700">Select Subjects From Here (below are the subjects which are assigned to
                    diplomas):</h2>
                <div class="border border-gray-200 rounded-lg overflow-hidden mb-8">
                    <table class="min-w-full divide-y divide-gray-200 examination-marks-table">
                        <thead class="bg-gray-200">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider w-12">
                                    <input type="checkbox" id="selectAll" class="cursor-pointer">
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider">
                                    Subject Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider">
                                    Session
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- @foreach ($courses as $course)
                                <tr>
                                    <td class="px-6 py-3 text-center">
                                        <input type="checkbox" name="courseIDs[]" value="{{ $course['ID'] }}"
                                            class="course-checkbox cursor-pointer">
                                    </td>
                                    <td class="px-6 py-3 text-gray-700 text-sm font-medium">
                                        {{ $course->course->courseName }}
                                    </td>
                                    <td class="px-6 py-3 text-gray-700 text-sm font-medium">
                                        <input type="hidden" name="sessionID" value="{{ $course->diploma->session->id }}">
                                        {{ $course->diploma->session->session }}
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('.examination-marks-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4">' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4 mb-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right mr-3 text-sm text-gray-500"i>>',
                pageLength: 100,
                stateSave: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('examination-criteria.create') }}"
                },
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search here...",
                    lengthMenu: "_MENU_"
                },
                initComplete: function() {
                    $('.dt-input')
                        .addClass(
                            'border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm'
                        )
                        .css({
                            'width': '200px',
                            'padding': '6px 10px',
                        });
                    $('.dt-length select')
                        .addClass(
                            'border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm'
                        )
                        .css({
                            'width': '80px',
                            'padding': '6px 10px'
                        });
                    $('.dt-length').addClass(
                        'px-3 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm');
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'course_name',
                        name: 'course.courseName'
                    },
                    {
                        data: 'session',
                        name: 'session',
                    }
                ],


            })

            $(document).on('change', '#selectAll', function() {
                $('.course-checkbox').prop('checked', this.checked);
            });

            $(document).on('change', '.course-checkbox', function() {
                let total = $('.course-checkbox').length;
                let checked = $('.course-checkbox:checked').length;

                $('#selectAll').prop('checked', total === checked);
            });

            // Save last searched word in sessionStorage
            $('.dt-input').on('keyup change', function() {
                sessionStorage.setItem('datatableSearch', $(this).val());
            });

            // Restore old searched word (if any)
            var oldSearch = sessionStorage.getItem('datatableSearch');
            if (oldSearch) {
                table.search(oldSearch).draw();
                $('.dt-input').val(oldSearch);
            }

            // Clear sessionStorage when leaving/reloading the page
            window.addEventListener('beforeunload', function() {
                sessionStorage.clear();
            });
        });
    </script>
@endsection
