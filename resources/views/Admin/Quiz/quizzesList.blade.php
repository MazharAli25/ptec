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
                        <th class="py-2.5 w-[5px] px-4 text-center font-semibold">ID</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Quiz Name</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Description</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200 text-center">

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal 1 -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <form action="" method="POST">
                <div class="flex flex-col">
                    <h1 class="font-bold text-[20px] text-center">Edit Student Details</h1>
                    <label for="studentName" class="mt-3">Student Name:</label>
                    <input type="text"
                        class="border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                        id="studentName" name="studentName">
                </div>
                <button data-close-modal="editModal"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition mt-2">Close</button>
            </form>
        </div>
    </div>
    <!-- Modal 2 -->
    <div id="modal2" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Modal 2</h2>
            <p class="text-gray-600 mb-6">This is another modal instance.</p>
            <div class="flex justify-end">
                <button data-close-modal="modal2"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Close</button>
            </div>
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
                // for yajra
                processing: true,
                serverSide:true,
                ajax: {
                    url : "{{ route('admin.quiz.list') }}"
                },
                lengthMenu: [
                    [5, 10, 25, 50, 100, 500, 1000, 5000],
                    [5 ,10, 25, 50, 100, 500, 1000, 5000]
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
                // Defining the columns
                columns: [
                    {data: 'id', name: 'id', className:'dt-head-center dt-body-center'},
                    {data: 'quizName', name: 'quizName', className:'dt-head-start dt-body-start w-70'},
                    {data: 'description', name: 'description'},
                    {data:'actions', name:'actions', className:'dt-head-center dt-body-center'},

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
