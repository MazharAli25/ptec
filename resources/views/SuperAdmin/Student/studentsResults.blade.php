@extends('layouts.superAdmin')
@section('page-title', 'Courses List')

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
            <h1 class="text-3xl font-bold text-gray-800">Results Of Students</h1>
            <p class="text-gray-600 mt-2">View the results of students</p>
        </div>

        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 students-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Std ID</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Student Name</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Institute Name</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Diploma Name</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Semester</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Session</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
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
            var table = $('.students-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4">' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4 mb-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right mr-3 text-sm text-gray-500"i>>',
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('superAdmin.studentsResults') }}",
                    dataSrc: "data"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'institute_name',
                        name: 'institute_name'
                    },
                    {
                        data: 'diploma_name',
                        name: 'diploma_name'
                    },
                    {
                        data: 'semester',
                        name: 'semester',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'session',
                        name: 'session',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
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
