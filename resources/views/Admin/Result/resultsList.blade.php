@extends('layouts.admin')
@section('page-title', 'Add Result')
@section('main-content')
    <form action="{{ route('result.store') }}" method="POST"> @csrf <div class="flex justify-center ml-[18vw] mt-10">
            <div class="overflow-x-auto w-[90%]">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden result-table">
                    <thead class="bg-cyan-600 text-white">
                        <tr>
                            <th class="py-2.5 px-4 text-center">ID</th>
                            <th class="py-2.5 px-4 text-center">Name</th>
                            <th class="py-2.5 px-4 text-center">Course</th>
                            <th class="py-2.5 px-4 text-center">Diploma</th>
                            <th class="py-2.5 px-4 text-center">Theory Marks</th>
                            <th class="py-2.5 px-4 text-center">Practical Marks</th>
                            <th class="py-2.5 px-4 text-center">Obt Th Marks</th>
                            <th class="py-2.5 px-4 text-center">Obt Prac Marks</th>
                            {{-- <th class="py-2.5 px-4 text-center font-semibold">Passing Marks</th> --}}
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200 text-center">

                    </tbody>
                </table>

            </div>
    </form>
    <script>
        $(document).ready(function() {
            var table = $('.result-table').DataTable({
                dom: '<"mid-toolbar flex gap-4 items-center mb-4 mr-3"lf>' + 't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"><"flex-1 text-right text-sm text-gray-500">>',
                pageLength: 100,
                stateSave: true,
                // For Yajra
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('result.index') }}"
                },
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search here...",
                    lengthMenu: "_MENU_"
                },
                initComplete: function() {
                    $('.dt-input').addClass(
                        'border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm'
                    ).css({
                        'width': '200px',
                        'padding': '6px 10px',
                    });
                    $('.dt-length select').addClass(
                        'border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm'
                    ).css({
                        'width': '80px',
                        'padding': '6px 10px'
                    });
                    $('.dt-length').addClass(
                        'px-3 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm');
                },
                columns: [
                    {
                        data: 'std_id',
                        name: 'std_id',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'course',
                        name: 'course',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'diploma',
                        name: 'diploma',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'TheoryTotalMarks',
                        name: 'TheoryTotalMarks',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'PracticalTotalMarks',
                        name: 'PracticalTotalMarks',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'TheoryMarks',
                        name: 'TheoryMarks',
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'PracticalMarks',
                        name: 'PracticalMarks',
                        className: 'dt-head-center dt-body-center'
                    },

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
