@extends('layouts.superAdmin')
@section('page-title', 'Add Admin')

@section('main-content')

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
                        <select id="institute_id" name="institute_id"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Select an option</option>
                            @foreach ($insts as $inst)
                                <option value="{{ $inst->id }}"
                                    {{ old('institute_id') == $inst->id ? 'selected' : '' }}>
                                    {{ $inst->institute_name }}
                            @endforeach
                        </select>
                    </div>

                    <!-- Two-column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-6">
                        <!-- Admin Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                User Name
                            </label>
                            <input type="text" id="name" name="name" maxlength="30" value="{{ old('name') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Enter Admin name">
                        </div>

                        <!-- Admin Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                User Email
                            </label>
                            <input type="email" id="email" name="email" maxlength="50" value="{{ old('email') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Enter Admin email">
                        </div>
                    </div>

                    <!-- Two-column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <input type="tel" id="phone" name="phone" maxlength="11" id="phone"
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Enter phone number">
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                            </label>
                            <input type="password" id="password" name="password" maxlength="25"
                                value="{{ old('password') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Enter Password">
                        </div>

                    </div>
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
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
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider w-[40%]">
                                Institute Name</th>
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Admin</th>
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Contact</th>
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-center text-[14px] font-semibold text-gray-800 uppercase tracking-wider w-[10%]">
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
            var table = $('.admins-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4 mt-4 ml-4"B>' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
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

                pageLength: 10,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('viewAdmins') }}"
                },
                language: {
                    lengthMenu: "_MENU_",
                    search: "_INPUT_",
                    searchPlaceholder: "Search here..."
                },
                // initComplete: function() {
                //     $('.dt-input')
                //         .addClass(
                //             'border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm'
                //         )
                //         .css('width', '200px');
                //     $('.dt-length').addClass(
                //         'px-3 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm');
                // },
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
                        className: 'dt-head-center dt-body-center'
                    },
                    {
                        data: 'institute_name',
                        name: 'institute_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
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
        });

        $(document).on('change', '.status-dropdown', function() {
            const dropdown = $(this);
            const adminId = dropdown.data('id');
            const newStatus = dropdown.val();
            const currentStatus = dropdown.data('current');

            console.log('Updating status...', {
                adminId: adminId,
                newStatus: newStatus,
                currentStatus: currentStatus
            });

            // Visual feedback
            dropdown.prop('disabled', true).addClass('opacity-60 cursor-not-allowed');

            $.ajax({
                url: "{{ route('student.updateStatus') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    admin_id: adminId,
                    status: newStatus
                },
                success: function(response) {
                    console.log('Success response:', response);

                    if (response.success) {

                        // Update current status
                        dropdown.data('current', newStatus);

                        // Show success message
                        if (typeof toastr !== 'undefined') {
                            toastr.success(response.message);
                        } else {
                            alert(response.message);
                        }
                    } else {
                        dropdown.val(currentStatus);
                        if (typeof toastr !== 'undefined') {
                            toastr.error(response.message);
                        } else {
                            alert(response.message);
                        }
                    }
                },
                error: function(xhr) {
                    console.error('Error response:', xhr);
                    console.error('Response text:', xhr.responseText);

                    dropdown.val(currentStatus);

                    let errorMsg = 'An error occurred while updating status';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                        if (xhr.responseJSON.error) {
                            console.error('Detailed error:', xhr.responseJSON.error);
                        }
                    }

                    if (typeof toastr !== 'undefined') {
                        toastr.error(errorMsg);
                    } else {
                        alert(errorMsg);
                    }
                },
                complete: function() {
                    dropdown.prop('disabled', false).removeClass('opacity-60 cursor-not-allowed');
                }
            });
        });


        // PHONE NUMBER FORMAT
        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('input', (e) => {
            // Remove all non-digit characters
            let value = e.target.value.replace(/\D/g, '');

            // Limit to 11 digits
            value = value.slice(0, 11);

            e.target.value = value;
        });
    </script>

@endsection




{{-- <form class="space-y-6" action="{{ route('institute.store') }}" method="POST">
                        @csrf
                        <!-- Institute Name -->
                        --}}
