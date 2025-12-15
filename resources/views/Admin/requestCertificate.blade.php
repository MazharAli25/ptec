@extends('layouts.admin')
@section('page-title', 'Request For Certificate')

@section('main-content')

    <div class="flex justify-center ml-[12vw] mt-10">
        <div class="overflow-x-auto w-[80%]">
            <h2 class="text-2xl font-semibold text-center mb-5">Students Assigned to Diplomas</h2>

            <table class="requestCertificate-table min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center font-semibold">ID</th>
                        <th class="py-3 px-4 text-center font-semibold">Student Name</th>
                        <th class="py-3 px-4 text-center font-semibold">Father Name</th>
                        <th class="py-3 px-4 text-center font-semibold">Diploma</th>
                        <th class="py-3 px-4 text-center font-semibold">Session</th>
                        <th class="py-3 px-4 text-center font-semibold">Action</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 divide-y divide-gray-200 text-center">
                    {{-- @forelse ($studentDiplomas as $sd)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $sd->student->id }}</td>
                            <td class="py-3 px-4">{{ $sd->student->name }}</td>
                            <td class="py-3 px-4">{{ $sd->student->fatherName }}</td>
                            <td class="py-3 px-4 font-semibold">{{ $sd->diploma->DiplomaName ?? 'N/A' }}</td>
                            <td class="py-3 px-4 font-semibold">{{ $sd->diploma->session->session ?? 'N/A' }}</td>
                            <td class="py-3 px-4">
                                <form action="{{ route('certificate.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $sd->student->id }}">
                                    <input type="hidden" name="diploma_id" value="{{ $sd->diploma->id }}">
                                    <input type="hidden" name="session_id" value="{{ $sd->diploma->session->id }}">

                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        Request Certificate
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-gray-400 font-medium text-center">
                                No students with assigned diplomas found.
                            </td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('.requestCertificate-table').DataTable({
                dom: '<"mid-toolbar flex gap-4 items-center mb-4 mr-3"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"><"flex-1 text-right text-sm text-gray-500">>',
                pageLength: 100,
                stateSave: true,
                // for yajra
                serverSide:true,
                processing: true,
                ajax: {
                    url: "{{ route('certificate.create') }}"
                },
                lengthMenu: [
                    [10, 25, 50, 100, 500, 1000, 5000],
                    [10, 25, 50, 100, 500, 1000, 5000]
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
                },
                columnDefs: [{
                        targets: [5],
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: [1],
                        searchable: true,
                    }
                ],
                columns:[
                    {data: 'id', name: 'id'},
                    {data: 'student_name', name: 'student_name'},
                    {data: 'father_name', name: 'father_name'},
                    {data: 'diploma', name: 'diploma'},
                    {data: 'session', name: 'session', orderable:false, searchable:false},
                    {data: 'actions', name: 'actions', orderable:false, searchable:false}
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
