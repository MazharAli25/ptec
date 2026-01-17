@extends('layouts.superAdmin')
@section('page-title', 'Add Institute')

@section('main-content')


    <!-- Main Content -->
    <div class="flex-1 p-8 ml-[19vw]">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Add Institute</h1>
            <p class="text-gray-600 mt-2">Fill in the details to add a new institute</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8">
            <form method="POST" action="{{ route('institute.store') }}" class="space-y-6">
                @csrf

                <!-- Institute Information -->
                <div class="space-y-4 w-full">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Institute Information</h2>

                    <div class="flex flex-wrap justify-between gap-4">
                        <!-- Institute Name -->
                        <div class="flex-1 min-w-[250px]">
                            <label for="instituteName" class="block text-sm font-medium text-gray-700 mb-1">
                                Institute Name
                            </label>
                            <input type="text" id="instituteName" name="instituteName" value="{{ old('instituteName') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Enter institute name">
                        </div>

                        <!-- Address -->
                        <div class="flex-1 min-w-[250px]">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                Address
                            </label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter institute address">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Save
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg form-shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Institute List</h2>
            </div>

            <div class="p-4 border rounded">
                <table class="min-w-full divide-y divide-gray-200 institute-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                ID
                            </th>
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Institute Name
                            </th>
                            <th
                                class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Address
                            </th>
                            <th class="px-6 py-3 text-center text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- @foreach ($insts as $inst)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $inst['id'] }}
                                </td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $inst['institute_name'] }}
                                </td>
                                <td class="px-6 py-3 text-left text-[14px] font-medium text-gray-600 tracking-wider">
                                    {{ $inst['address'] ?: 'Nill' }}
                                </td>
                                <td class="px-6 py-3 w-[35%] text-center text-xs font-medium text-gray-600 tracking-wider">
                                    <a href="{{ route('institute.edit', $inst) }}"
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-edit text-base"></i>
                                    </a>

                                    <form action="{{ route('institute.destroy', $inst) }}" method="POST"
                                        class="inline-block ml-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="items-center px-2 py-1.5 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors inline-flex">
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
    </div>
    <script>
        $(document).ready(function () {
            var table = $('.institute-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4"B>' + 
                '<"mid-toolbar flex gap-4 items-center mb-4"lf>' + 
                't' + 
                '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right text-sm text-gray-500"i>>',
                
                buttons: [
                    { 
                        extend: 'copy', 
                        className: 'bg-green-600 hover:bg-green-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: { columns: [0, 1, 2] } // only ID, Name, Address
                    },
                    { 
                        extend: 'excel', 
                        className: 'bg-green-600 hover:bg-green-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: { columns: [0, 1, 2] }
                    },
                    { 
                        extend: 'csv', 
                        className: 'bg-blue-500 hover:bg-blue-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: { columns: [0, 1, 2] }
                    },
                    { 
                        extend: 'pdf', 
                        className: 'bg-red-600 hover:bg-red-700 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: { columns: [0, 1, 2] }
                    },
                    { 
                        extend: 'print', 
                        className: 'bg-yellow-500 hover:bg-yellow-600 text-white text-[14px] px-3 py-1.5 rounded mr-2',
                        exportOptions: { columns: [0, 1, 2] } //  exclude Actions column
                    }
                ],
                pageLength: 100,
                stateSave: true,
                // For Yajra DT
                processing:true,
                serverSide:true,
                ajax:{
                    url: "{{ route('institute.index') }}"
                },
                language: {
                    lengthMenu: "_MENU_",
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
                columns:[
                    {data:'id', name:'id', className: 'dt-head-center dt-body-center'},
                    {data:'institute_name', name:'institute_name'},
                    {data:'address', name:'address', orderable:false, searchable:false},
                    {data:'actions', name:'actions', orderable:false, searchable:false},
                ]
                
            });
    
            $('.dataTables_filter input').removeClass('dt-input').addClass('border border-gray-300 rounded-lg px-3 py-1.5 focus:border-2 focus:border-blue-500 focus:outline-none');
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

