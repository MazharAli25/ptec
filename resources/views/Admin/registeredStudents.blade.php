@extends('layouts.admin')
@section('page-title', 'Assigned Diplomas List')
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
    <div class="flex justify-center ml-[15vw] mt-10">
        <div class="overflow-x-auto w-[80%]">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden students-table">
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-2.5 px-4 text-center font-semibold">ID</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Student Name</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Father Name</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Phone</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Email</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200 text-center">
                    {{-- @foreach ($students as $student)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $student['id'] }}</td>
                            <td class="py-3 px-4">{{ $student['name'] }}</td>
                            <td class="py-3 px-4">{{ $student['fatherName'] }}</td>
                            <td class="py-3 px-4">{{ $student['phone'] }}</td>
                            <td class="py-3 px-4">{{ $student['email'] }}</td>
                            <td class="py-3 px-4 text-green-600 font-semibold w-60">
                                <!-- Edit Link -->
                                <a href="{{ route('student.edit', encrypt($student)) }}"
                                    class="no-underline inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-edit text-base"></i>
                                </a>
                                <!-- View Link -->
                                <a href="{{ route('student.show', encrypt($student)) }}"
                                    class="no-underline inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                                    <i class="fas fa-eye text-base"></i>
                                </a>
                                <!-- Delete Link -->
                                <form action="{{ route('student.destroy', encrypt($student)) }}" method="post" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="no-underline inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        <i class="fas fa-trash text-base"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('.students-table').DataTable({
                dom: '<"mid-toolbar flex gap-4 items-center mb-2 mr-3"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"><"flex-1 text-right text-sm text-gray-500">>',
                pageLength: 100,
                stateSave: true,
                // for yajra DT
                prosessing : true,
                serverSide: true,

                lengthMenu: [
                    [10, 25, 50, 100, 500, 1000, 5000],
                    [10, 25, 50, 100, 500, 1000, 5000]
                ],
                ajax: {
                    url: "{{ route('admin.registeredStudentList') }}"
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
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'fatherName', name: 'fatherName'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'actions', name: 'actions', orderable:false, searachable:false}
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
