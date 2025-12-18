@extends('layouts.superAdmin')
@section('page-title', 'Certificates Requests')

@section('main-content')
    <div class="heading flex flex-col justify-center items-center ml-[15vw] mt-6">
        <h1 class=" text-black font-bold text-[24px]">Print Certificates</h1>
        <small class=" text-gray-500">Approved Certificates</small>
    </div>
    <div class="flex-1 p-8 ml-[19vw]">
        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 certificates-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-center font-semibold">ID</th>
                            <th class="py-3 px-4 text-center font-semibold">Student Name</th>
                            <th class="py-3 px-4 text-center font-semibold">Diploma</th>
                            <th class="py-3 px-4 text-center font-semibold">Session</th>
                            <th class="py-3 px-4 text-center font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200 text-center">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('.certificates-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4">' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4 mb-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right mr-3 text-sm text-gray-500"i>>',

                pageLength: 10,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('superAdmin.printCertificates') }}"
                },
                language: {
                    lengthMenu: "_MENU_",
                    search: "_INPUT_",
                    searchPlaceholder: "Search here..."
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
                        data: 'id',
                        name: 'id',
                        className:'dt-head-center dt-body-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'diploma_name',
                        name: 'diploma_name'
                    },
                    {
                        data: 'session',
                        name: 'session',
                        orderable:false,
                        searchable:false

                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable:false,
                        searchable:false
                    },
                ]


            })
        });
    </script>
@endsection
