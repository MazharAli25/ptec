@extends('layouts.superAdmin')
@section('page-title', 'Questions List')

@section('main-content')

    <!-- Main Content -->
    <div class="flex-1 p-8 ml-[19vw]">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Quiz Questions List</h1>
            <p class="text-gray-600 mt-2">View the questions and options of quizzes</p>
        </div>

        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 quiz-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Quiz Name</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Questions</th>
                            <th class="px-6 py-3 text-[14px] text-gray-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $i=1; @endphp
                        {{-- @foreach ($results as $group)
                            @php
                                $first = $group->first();
                            @endphp
                            <tr>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $i }}</td>
                                <td class="px-6 py-3 text-center text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $first->student->name }}</td>
                                <td class="px-6 py-3 text-center text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $first->student->institute->institute_name }}</td>
                                <td class="px-6 py-3 text-center text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $first->ExaminationCriteria->diplomawiseCourse->diploma->DiplomaName }}</td>
                                <td class="px-6 py-3 text-center text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $first->semester->semesterName }}</td>
                                <td class="px-6 py-3 text-center text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $first->session->session }}</td>
                                <td class="text-right">
                                    <a href="{{ route('result.show', $first) }}"
                                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white rounded hover:bg-green-600">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('.quiz-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4 mt-4 ml-4"B>' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right text-sm text-gray-500"i>>',

                buttons: [{
                        extend: 'copy',
                        className: 'bg-green-600 hover:bg-green-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: {
                            columns: [0, 1, 2]
                        } // only ID, Name, Address
                    },
                    {
                        extend: 'excel',
                        className: 'bg-green-600 hover:bg-green-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'bg-blue-500 hover:bg-blue-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'bg-red-600 hover:bg-red-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'bg-yellow-500 hover:bg-yellow-600 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: {
                            columns: [0, 1, 2]
                        } //  exclude Actions column
                    }
                ],
                pageLength: 100,
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('question.index') }}",
                    dataSrc: "data"
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'quiz_name',
                        name: 'quiz_name',
                        className: "w-70"
                    },
                    {
                        data: 'question_text',
                        name: 'question_text'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'dt-head-center dt-body-center'
                    },
                ],
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
        });
    </script>

@endsection
