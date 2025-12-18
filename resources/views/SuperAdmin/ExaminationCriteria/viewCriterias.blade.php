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
            <h1 class="text-3xl font-bold text-gray-800">Examination Criterias </h1>
            <p class="text-gray-600 mt-2">View the details of assigned examination criterias</p>
        </div>

        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 criterias-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Subject Name</th>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Session</th>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Theory Marks</th>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Practical Marks</th>
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Total Marks</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('.criterias-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4">' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4 mb-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right mr-3 text-sm text-gray-500"i>>',
                pageLength: 100,
                stateSave: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('examination-criteria.index') }}"
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
                        data: 'ID',
                        name: 'ID'
                    },

                    {
                        data: 'course_name',
                        name: 'diplomawiseCourse.course.courseName'
                    },

                    {
                        data: 'session_name',
                        name: 'session.session'
                    },

                    {
                        data: 'TheoryMarks',
                        name: 'TheoryMarks',
                        className: 'dt-body-center'
                    },

                    {
                        data: 'PracticalMarks',
                        name: 'PracticalMarks',
                        className: 'dt-body-center'
                    },

                    {
                        data: 'TotalMarks',
                        name: 'TotalMarks',
                        className: 'dt-body-center'
                    },

                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]


            })
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
