@extends('layouts.admin');
@section('page-title', 'Requested Certificates')

@section('main-content')

    <div class="flex justify-center ml-[15vw] mt-10">
        <div class="overflow-x-auto w-[80%]">
            <table class="requestedCertificate-table min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-2.5 px-4 text-center font-semibold">ID</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Student Name</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Diploma</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Session</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Status</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Actions</th>

                    </tr>
                </thead>

                <tbody class="text-gray-700 divide-y divide-gray-200 text-center">
                    <!-- Example Row -->
                    @if ($students)
                        @foreach ($students as $student)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $student->student->id }}</td>
                                <td class="py-3 px-4">{{ $student->student->name }}</td>
                                <td class="py-3 px-4">{{ $student->diploma->DiplomaName }}</td>
                                <td class="py-3 px-4">{{ $student->session->session }}</td>
                                <td class="py-3 px-4">
                                    <button class="status-btn" data-id="{{ $student->student->id }}">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-medium {{ $student->student->status === 'inactive' ? 'bg-yellow-100 text-yellow-800' : ($student->student->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $student->student->status }}
                                        </span>
                                    </button>
                                </td>


                                <td class="py-3 px-4 text-green-600 font-semibold w-60">
                                    <!-- Edit Link -->
                                    <a href="{{ route('student.edit', $student->student->id) }}"
                                        class="no-underline inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-[16px]"></i>
                                    </a>
                                    <!-- View Link -->
                                    <a href="{{ route('student.show', $student->student->id) }}"
                                        class="no-underline inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                                        <i class="fas fa-eye text-base"></i>
                                    </a>
                                    <!-- Delete Link -->
                                    <form action="{{ route('student.destroy', $student->student->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="no-underline inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                            <i class="fas fa-trash text-base"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <!-- Empty State -->
                        <tr>
                            <td colspan="6" class="py-12 text-gray-400 font-medium text-center">
                                No Requests Found!
                            </td>
                        </tr>

                    @endif


                </tbody>
            </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var table = $('.requestedCertificate-table').DataTable({
                dom: '<"mid-toolbar flex gap-4 items-center mb-2 mr-3"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"><"flex-1 text-right text-sm text-gray-500">>',
                pageLength: 100,
                stateSave: true,
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
                        targets: [5, 4],
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: [1],
                        searchable: true,
                    }
                ],


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

        $(document).on('click', '.status-btn', function() {
            let button = $(this);
            let id = button.data('id');
            let badge = button.find("span");

            // Show temporary loading
            // badge.text("Updating...")
            //     .removeClass()
            //     .addClass("px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-800");

            $.ajax({
                url: "/student/toggle-status/" + id,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {

                        if (response.status === "active") {
                            badge.text("active")
                                .removeClass()
                                .addClass(
                                    "px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800"
                                    );
                        } else {
                            badge.text("inactive")
                                .removeClass()
                                .addClass(
                                    "px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800"
                                    );
                        }
                    }
                }
            });
        });
    </script>

@endsection
