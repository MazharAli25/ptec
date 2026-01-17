@extends('layouts.superAdmin')
@section('page-title', 'Add Subjects')

@section('main-content')

    <div class="flex-1 p-8 ml-[19vw]">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Add Subjects</h1>
            <p class="text-gray-600 mt-2">Fill in the details to add a new Subject</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8 flex justify-center">
            <form class="flex flex-col w-full" method="POST" action="{{ route('course.store') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <h2 font-semibold text-gray-700 border-b pb-2">
                        Subject Information
                    </h2>

                    <div class="flex justify-evenly gap-6">

                        <!-- Subject Name -->
                        <div class="w-[30%]">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Subject Name
                            </label>
                            <input type="text" name="courseName"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                   focus:ring-1 focus:ring-blue-500 outline-none focus:border-blue-500"
                                placeholder="Enter Subject name">
                        </div>

                        <!-- Level -->
                        <div class="w-[30%]">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Level
                            </label>
                            <select type="text" name="courseLevel"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                   focus:ring-1 focus:ring-blue-500 outline-none focus:border-blue-500"
                                placeholder="Beginner / Intermediate">
                                <option value="">Select Level</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>

                        <!-- Fees -->
                        <div class="w-[30%]">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fees
                            </label>
                            <input type="number" name="courseFees"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                   focus:ring-1 focus:ring-blue-500 outline-none focus:border-blue-500"
                                placeholder="Enter Fees">
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <!-- description -->
                        <div class="w-[97%]">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Description
                            </label>
                            <input type="Text" name="description"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg
                                   focus:ring-1 focus:ring-blue-500 outline-none focus:border-blue-500"
                                placeholder="Enter description">
                        </div>
                    </div>
                    <!-- Thumbnail + Currency -->
                    <div class="flex items-start justify-center">
                        <div class="w-[50%]">
                            <!-- Currency Radios -->
                            <div class="flex flex-col ml-4 mt-4">
                                <span class="text-sm font-medium text-gray-700 mb-1">Currency</span>
                                <div class="flex space-x-4">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="currency" value="pkr" checked
                                            class="w-5 h-5 accent-blue-600">
                                        <span class="text-[16px]">PKR</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="currency" value="$"
                                            class="w-5 h-5 accent-blue-600">
                                        <span class="text-[16px]">$</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="currency" value="€"
                                            class="w-5 h-5 accent-blue-600">
                                        <span class="text-[16px]">€</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="currency" value="₹"
                                            class="w-5 h-5 accent-blue-600">
                                        <span class="text-[16px]">₹</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="w-[50%] mx-auto mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject Thumbnail</label>

                            <div class="flex items-start space-x-4">

                                <!-- File Input -->
                                <label
                                    class="cursor-pointer bg-gray-100 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-200 flex items-center justify-center"
                                    for="thumbnail">
                                    <i class="fas fa-upload mr-2 text-gray-600"></i>
                                    Choose Image
                                </label>
                                <input type="file" name="courseThumbnail" id="thumbnail" accept="image/*" class="hidden"
                                    onchange="previewThumbnail(event)">

                                <!-- Preview Box -->
                                <div class="w-20 h-20 border border-gray-300 rounded-lg overflow-hidden relative">
                                    <img id="thumbnail-preview" src="#" alt="Preview"
                                        class="w-full h-full object-cover hidden">
                                </div>



                            </div>
                            <p class="text-xs text-gray-500 mt-1">Accepted: jpg, png, jpeg. Max size: 2MB</p>
                        </div>

                    </div>
                </div>
                <!-- Submit -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg
                           hover:bg-blue-700 focus:ring-1 focus:ring-blue-500 transition-colors">
                        Save Subject
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg form-shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Subjects List</h2>

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 courses-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Subject</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Level</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Fees</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Thumbnail</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.courses-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4 mt-4 ml-4"B>' +
                    '<"mid-toolbar flex gap-4 items-center mb-4 ml-4"lf>' +
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
                language: {
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('course.index') }}",
                pageLength: 100,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'courseName',
                        name: 'courseName',
                        className: 'text-center'
                    },
                    {
                        data: 'level',
                        name: 'level',
                        className: 'text-center'
                    },
                    {
                        data: 'fees',
                        name: 'fees',
                        className: 'text-center'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        className: 'text-center',
                        orderable: false
                    }
                ]
            });
        });

        // Thumbnail preview

        function previewThumbnail(event) {
            const input = event.target;
            const preview = document.getElementById('thumbnail-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
            }
        }
    </script>

@endsection
