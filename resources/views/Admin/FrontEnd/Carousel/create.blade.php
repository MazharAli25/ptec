@extends('layouts.superAdmin')
@section('page-title', 'Carousel Manager')

@section('main-content')

    <div class="w-[75vw] ml-[20vw] my-10 space-y-10">

        <!-- ================= Upload Section ================= -->
        <div>
            <h1 class="text-3xl font-semibold mb-6">Add Carousel Images</h1>

            <div class="bg-white shadow-lg rounded-xl p-6">

                <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @for ($i = 0; $i < 3; $i++)
                            <label class="cursor-pointer">
                                <input type="file" name="images[]" accept="image/*" class="hidden"
                                    onchange="previewImage(event, {{ $i }})">

                                <div
                                    class="w-full h-[220px] rounded-xl border-2 border-dashed border-gray-500
                                        flex items-center justify-center bg-gray-50 hover:bg-purple-50 transition
                                        relative overflow-hidden">

                                    <div id="icon-{{ $i }}" class="text-gray-500 text-6xl">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>

                                    <img id="preview-{{ $i }}"
                                        class="absolute inset-0 w-full h-full object-cover hidden rounded-xl">
                                </div>
                            </label>
                        @endfor
                    </div>
                    <div class="btn flex items-center justify-center">
                        <button type="submit" class="mt-4 w-30 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                            Upload
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- ================= Table Section ================= -->
    <div class="bg-white rounded-lg form-shadow p-6 ml-[20vw]">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Images List</h2>
        </div>

        <div class="p-4 border rounded">
            <table class="min-w-full divide-y divide-gray-200 images-table">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                            Images
                        </th>
                        <th class="px-6 py-3 text-left text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-center text-[14px] font-semibold text-gray-800 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                </tbody>
            </table>
        </div>

    </div>
    </div>

    <!-- ================= JS ================= -->
    <script>
        function previewImage(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = () => {
                document.getElementById(`preview-${index}`).src = reader.result;
                document.getElementById(`preview-${index}`).classList.remove('hidden');
                document.getElementById(`icon-${index}`).classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
        $(document).ready(function() {
            var table = $('.images-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4">' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right text-sm text-gray-500"i>>',

                pageLength: 10,
                stateSave: true,
                // For Yajra DT
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('carousel.index') }}"
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
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'dt-head-center dt-body-center w-[10%]'
                    },
                    {
                        data: 'images',
                        name: 'images'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'dt-head-center dt-body-center w-[15%]'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'w-[20%]'
                    },
                ]

            });

            $('.dataTables_filter input').removeClass('dt-input').addClass(
                'border border-gray-300 rounded-lg px-3 py-1.5 focus:border-2 focus:border-blue-500 focus:outline-none'
            );
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
            let imageId = button.data('id');
            $.ajax({
                url: "/super-admin/update-status/" + imageId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Use response.status, not undefined status
                        if (response.new_status === "active") {
                            button.text("Active")
                                .removeClass()
                                .addClass(
                                    "px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800"
                                );
                        } else {
                            button.text("Inactive")
                                .removeClass()
                                .addClass(
                                    "px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800"
                                );
                        }
                        button.data('id', response.encrypted_id);
                    }
                }
            })
        })
    </script>

@endsection
