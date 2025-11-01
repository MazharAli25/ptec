@extends('layouts.superAdmin')
@section('page-title', 'Assign Courses To Diploma')

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
            <h1 class="text-3xl font-bold text-gray-800">Assign Course</h1>
            <p class="text-gray-600 mt-2">Fill in the details to assign course to diploma</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8">
            <form method="POST" action="{{ route('diplomawiseCourse.store') }}" class="w-full">
                @csrf

                <!-- Title -->
                <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">
                    Assign Courses to Diploma
                </h2>

                <!-- Top Inputs: Diploma & Semester -->
                <div class="flex flex-wrap justify-between items-center gap-6 w-full mb-6">
                    <!-- Diploma -->
                    <div class="flex-1 min-w-[250px]">
                        <label for="diplomaID" class="block text-sm font-medium text-gray-700 mb-1">
                            Diploma Name
                        </label>
                        <select id="diplomaID" name="diplomaID"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Diploma</option>
                            @foreach ($diplomas as $diploma)
                                <option value="{{ $diploma->id }}">{{ $diploma->DiplomaName }}
                                    ({{ $diploma->session->session }})
                                </option>
                            @endforeach
                        </select>
                        @error('diplomaID')
                            <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Semester -->
                    <div class="flex-1 min-w-[250px]">
                        <label for="semesterID" class="block text-sm font-medium text-gray-700 mb-1">
                            Semester Name
                        </label>
                        <select id="semesterID" name="semesterID"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Semester</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semesterName }}</option>
                            @endforeach
                        </select>
                        @error('semesterID')
                            <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Course Selection Table -->
                <div class="border border-gray-200 rounded-lg overflow-hidden mb-8">
                    <table class="min-w-full divide-y divide-gray-200 assign-course-table">
                        <thead class="bg-gray-200">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider w-12">
                                    <input type="checkbox" id="selectAll" class="cursor-pointer">
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider">
                                    Course Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider">
                                    Course Code
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($courses as $course)
                                <tr>
                                    <td class="px-6 py-3 text-center">
                                        <input type="checkbox" name="courseIDs[]" value="{{ $course->id }}"
                                            class="course-checkbox cursor-pointer">
                                    </td>
                                    <td class="px-6 py-3 text-gray-700 text-sm font-medium">
                                        {{ $course->courseName }}
                                    </td>
                                    <td class="px-6 py-3 text-gray-700 text-sm">
                                        {{ $course->courseCode ?? '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Assign Selected Courses
                    </button>
                </div>
            </form>

        </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAll = document.getElementById("selectAll");
            const checkboxes = document.querySelectorAll(".course-checkbox");

            selectAll.addEventListener("change", function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
        var table = $('.assign-course-table').DataTable({
            dom:  
            '<"mid-toolbar flex gap-4 items-center mb-4 mr-3"lf>' + 
            't' + 
            '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"><"flex-1 text-right text-sm text-gray-500">>',
            pageLength: 100,
            stateSave: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here...",
                lengthMenu: "_MENU_"
            },
            initComplete: function () {
                $('.dt-input')
                    .addClass('border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm')
                    .css({
                        'width': '200px',
                        'padding': '6px 10px',}); 
                $('.dt-length select')
                    .addClass('border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm')
                    .css({
                        'width': '80px',
                        'padding': '6px 10px'
                    });
                $('.dt-length').addClass('px-3 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm');
            },
            columnDefs: [
                {
                    targets: [2], 
                    orderable: false,
                    searchable: false
                },
                {
                    targets:[1],
                    searchable:true,
                }
            ],
            

        })
        // Save last searched word in sessionStorage
        $('.dt-input').on('keyup change', function () {
            sessionStorage.setItem('datatableSearch', $(this).val());
        });

        // Restore old searched word (if any)
        var oldSearch = sessionStorage.getItem('datatableSearch');
        if (oldSearch) {
            table.search(oldSearch).draw();
            $('.dt-input').val(oldSearch);
        }

        // Clear sessionStorage when leaving/reloading the page
        window.addEventListener('beforeunload', function () {
            sessionStorage.clear();
        });
    });
    </script>

@endsection
