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
                            <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Student Name</th>
                                <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Diploma Name</th>
                                <th class="px-6 py-3 text-left text-[14px] text-gray-800 uppercase tracking-wider">
                                Institute Name</th>
                            <th class="px-6 py-3 text-center text-[14px] text-gray-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Empty state for now -->
                        @foreach ($results as $result)
                            <tr>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $result['id'] }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $result->student->name }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $result->ExaminationCriteria->diplomawiseCourse->diploma->DiplomaName }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $result->student->institute->institute_name }}</td>
                                <td class="px-6 py-3 text-center text-[14px] font-medium text-gray-600 tracking-wider">
                                    <!-- Edit Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-edit text-base"></i>
                                    </a>
                                    <a href="{{ route('result.show', $result) }}"
                                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                                        <i class="fas fa-eye text-base"></i>
                                    </a>
                                    <!-- Delete Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        <i class="fas fa-trash text-base"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>    
                </table>
            </div>

        </div>
    </div>

<script>
        $(document).ready(function () {
        var table = $('.students-table').DataTable({
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

