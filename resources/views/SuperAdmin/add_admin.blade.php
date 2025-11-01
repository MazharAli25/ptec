@extends('layouts.superAdmin')
@section('page-title', 'Add Admin')

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
            <h1 class="text-3xl font-bold text-gray-800">Add Admin</h1>
            <p class="text-gray-600 mt-2">Fill in the details to add a new admin</p>
        </div>

       <!-- Form Section -->
<div class="bg-white rounded-lg form-shadow p-6 mb-8 flex justify-center">
    <form method="POST" action="{{ route('admin.store') }}" class="w-[70%] space-y-2">
        @csrf

        <!-- Director Information -->
        <div class="space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">
                Director Information
            </h2>

            <!-- Institute Selection -->
            <div>
                <label for="institute_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Select Institute
                    {{-- <span class="text-red-500">(Choose an institute before filling credentials)</span> --}}
                </label>
                <select
                    id="institute_id"
                    name="institute_id"
                    class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="">Select an option</option>
                    @foreach ($insts as $inst)
                        <option value="{{ $inst->id }}">{{ $inst->institute_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Two-column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-6">
                <!-- Admin Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Admin Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter Admin name"
                    >
                </div>

                <!-- Admin Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Admin Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter Admin email"
                    >
                </div>
            </div>

            <!-- Two-column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter Password"
                    >
                </div>

                <!-- Admin Email -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                        Phone Number
                    </label>
                    <input type="tel" id="phone" name="phone"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter phone number">
                </div>

            </div>
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select
                    id="status"
                    name="status"
                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-4">
            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center"
            >
                Save Admin
            </button>
        </div>
    </form>
</div>


        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Admins List</h2>
            </div>


            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 admins-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider w-[40%]">
                                Institute Name</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Admin</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Contact</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-center text-[14px] font-semibold text-gray-800 uppercase tracking-wider w-[10%]">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Empty state for now -->
                        @foreach ($admins as $admin)
                            <tr>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $admin->id ?? 'N/A' }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $admin->institute->institute_name ?? 'N/A' }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $admin['name'] }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $admin['email'] }}</td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $admin['status'] }}</td>
                                <td
                                    class="px-6 py-3 w-[35%] text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
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

    <script>
        $(document).ready(function () {
        var table = $('.admins-table').DataTable({
            dom:  
            '<"mid-toolbar flex justify-between items-center mb-4 mr-3"lf>' + 
            't' + 
            '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"><"flex-1 text-right text-sm text-gray-500">>',

            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here..."
            },
            initComplete: function () {
                $('.dt-input')
                    .addClass('border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm')
                    .css('width', '200px'); 
                $('.dt-length').addClass('px-3 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm');
            },
            // columnDefs: [
            //     { targets: [3, 4, 5, 6], searchable: false } 
            //     // 3 = Theory Marks, 4 = Practical Marks, 5 = Obtained Theory, 6 = Obtained Practical
            // ],
            

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
    });
    </script>

@endsection




{{-- <form class="space-y-6" action="{{ route('institute.store') }}" method="POST">
                        @csrf
                        <!-- Institute Name -->
                        --}}
