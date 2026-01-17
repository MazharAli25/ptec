@extends('layouts.superAdmin')
@section('page-title', 'Student Cards Requests')

@section('main-content')
    <div class="flex-1 p-8 ml-[19vw]">
        <!-- Table Section (Placeholder for future data) -->
        <div class="bg-white rounded-lg form-shadow p-6">

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 cards-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-center font-semibold">ID</th>
                            <th class="py-3 px-4 text-center font-semibold">Name</th>
                            <th class="py-3 px-4 text-center font-semibold">Diploma</th>
                            <th class="py-3 px-4 text-center font-semibold">Institute</th>
                            <th class="py-3 px-4 text-center font-semibold">Session</th>
                            <th class="py-3 px-4 text-center font-semibold">Status</th>
                            <th class="py-3 px-4 text-center font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200 text-center">
                        {{-- @if ($requests && $requests->count())
                        @foreach ($requests as $card)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $card->student->id }}</td>
                                <td class="py-3 px-4">{{ $card->student->name }}</td>
                                <td class="py-3 px-4">{{ $card->diploma->DiplomaName }}</td>
                                <td class="py-3 px-4">{{ $card->session->session }}</td>
                                <td class="py-3 px-4 font-semibold">

                                    <div class="flex flex-row items-center justify-center gap-3 whitespace-nowrap">
                                        {{-- STATUS BADGE --}}
                        {{-- @if ($card->status === 'approved')
                                            <span class="px-3 py-1 rounded bg-green-500 text-white text-sm">Approved</span>
                                        @elseif ($card->status === 'rejected')
                                            <span class="px-3 py-1 rounded bg-red-500 text-white text-sm">Rejected</span>
                                        @else
                                            <span class="px-3 py-1 rounded bg-yellow-500 text-white text-sm">Pending</span>
                                        @endif

                                    </div>
                                <td class="py-3 px-4">
                                    <div class="flex flex-row no-wrap gap-3"> --}}
                        {{-- APPROVE BUTTON --}}
                        {{-- <form action="{{ route('card.update', $card->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit"
                                                class="px-3 py-1 text-sm font-medium rounded
                                                    {{ $card->status === 'approved'
                                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                                        : 'bg-green-500 text-white hover:bg-green-600' }}"
                                                {{ $card->status === 'approved' ? 'disabled' : '' }}>
                                                Approve
                                            </button>
                                        </form> --}}

                        {{-- REJECT BUTTON --}}
                        {{-- <form action="{{ route('card.update', $card->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit"
                                                class="px-3 py-1 text-sm font-medium rounded
                                                    {{ $card->status === 'rejected'
                                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                                        : 'bg-red-500 text-white hover:bg-red-600' }}"
                                                {{ $card->status === 'rejected' ? 'disabled' : '' }}>
                                                Reject
                                            </button>
                                        </form> --}}

                        {{-- </div>
                                </td>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="py-12 text-gray-400 font-medium text-center">
                                No Requests Found!
                            </td>
                        </tr>
                    @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('.cards-table').DataTable({
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
                    url: "{{ route('superCard.requests') }}"
                },
                language: {
                    lengthMenu: "_MENU_",
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
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'diploma_name',
                        name: 'diploma_name',
                        className: 'dt-head-center'
                    },
                    {
                        data: 'institute_name',
                        name: 'institute_name',
                        className: 'dt-head-center'
                    },
                    {
                        data: 'session',
                        name: 'session',
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
                        className: 'dt-head-center',
                        searchable: false,
                        orderable: false
                    },
                ]


            })
        });
    </script>

@endsection
