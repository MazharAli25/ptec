@extends('layouts.superAdmin')
@section('page-title', 'Assign Courses To Diploma')

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
                <div class="flex flex-wrap justify-evenly items-center gap-6 w-full mb-6">
                    <!-- Diploma -->
                    <div class="flex-1 min-w-[30%]">
                        <label for="diplomaID" class="block text-sm font-medium text-gray-700 mb-1">Assign
                            Diploma</label>
                        <select id="diplomaID" name="diplomaID"
                            class="select2 w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Diploma</option>
                            @foreach ($diplomas as $diploma)
                                <option value="{{ $diploma->id }}">{{ $diploma->DiplomaName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Session Dropdown -->
                    <div class="flex-1 min-w-[30%]">
                        <label for="session_id" class="block text-sm font-medium text-gray-700 mb-1">Session</label>
                        <select id="session_id" name="session_id"
                            class="select2 w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Session</option>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="flex-1 min-w-[30%]">
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
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider w-[100px]">
                                    <input type="checkbox" id="selectAll" class="cursor-pointer">
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-800 uppercase tracking-wider">
                                    Course Name
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- @foreach ($courses as $course)
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
                            @endforeach --}}
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
        // CheckBoxes
        function bindSelectAll() {
            const selectAll = document.getElementById("selectAll");
            if (!selectAll) return;

            // Only bind if not already bound
            if (selectAll.dataset.bound) return;
            selectAll.dataset.bound = "true";

            selectAll.addEventListener("change", function() {
                document.querySelectorAll(".course-checkbox").forEach(cb => {
                    cb.checked = this.checked;
                });
            });

            // Listen for changes on individual checkboxes
            document.querySelectorAll(".course-checkbox").forEach(cb => {
                cb.addEventListener("change", function() {
                    const allChecked = document.querySelectorAll(".course-checkbox:not(:checked)")
                        .length === 0;
                    selectAll.checked = allChecked;
                });
            });
        }

        // Yajra Datatables
        $(document).ready(function() {
            var table = $('.assign-course-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4">' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4 mb-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right mr-3 text-sm text-gray-500"i>>',
                pageLength: 100,
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('diplomawiseCourse.create') }}"
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
                        orderable: false,
                        searchable: false,
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'courseName',
                        name: 'courseName',
                        className: 'dt-head-center dt-body-center'
                    }
                ],
                drawCallback: function() {
                    // Re-bind the select all logic every time the table is redrawn
                    bindSelectAll();
                }
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

            // Initial bind
            bindSelectAll();
        });

        // Dynamic Inputs
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Please select",
                allowClear: true,
                width: '100%'
            });

            $('#diplomaID').on('change', function() {
                let diplomaId = $(this).val();
                let sessionDropdown = $('#session_id');

                sessionDropdown.empty().append('<option value="">Loading...</option>').trigger('change');

                if (diplomaId) {
                    $.ajax({
                        url: '/super-admin/get-super-sessions/' + $('#diplomaID option:selected')
                            .text(),
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
