@extends('layouts.superAdmin')
@section('page-title', 'Add Course')

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
            <h1 class="text-3xl font-bold text-gray-800">Add Courses</h1>
            <p class="text-gray-600 mt-2">Fill in the details to add a new Course</p>
        </div>


        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8 flex justify-center">
            <form class="flex flex-col w-[70%]" method="POST" action="{{ route('course.store') }}">
                @csrf
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Course Information</h2>
                    <div class="flex justify-evenly">
                        <div>
                            <label for="courseName" class="block text-sm font-medium text-gray-700 mb-1">
                                Course Name
                            </label>
                            <input type="text" id="courseName" name="courseName"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter Course name">
                        </div>

                        {{-- <div>
                            <label for="courseDuration" class="block text-sm font-medium text-gray-700 mb-1">
                                Select Duration
                            </label>

                            <input list="coursedurations" name="courseDuration" id="courseDuration"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Type or select a duration">

                            <datalist id="coursedurations">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }} {{ $i == 1 ? 'month' : 'months' }}"></option>
                                @endfor
                            </datalist>

                        </div> --}}

                    </div>
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-2 flex justify-center mt-8">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
                        Save Course
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Courses List</h2>

            </div>


            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 courses-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider w-[10px]">
                                ID</th>
                            <th class="px-6 py-3 text-center text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Course Name</th>
                            <th class="px-6 py-3 text-center text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Empty state for now -->
                        @foreach ($courses as $course)
                            <tr>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $course['id'] }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $course['courseName'] }}</td>
                                <td
                                    class="px-6 py-3 w-[35%] text-center text-[14px] font-medium text-gray-600 tracking-wider">
                                  <a href="#"
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-edit text-base"></i>
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
    </div>
    <script>
        $(document).ready(function () {
        var table = $('.courses-table').DataTable({
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
