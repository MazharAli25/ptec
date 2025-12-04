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
                    @if ($requests)
                        @foreach ($requests as $certificate)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2.5 px-4">{{ $certificate->student->id }}</td>
                                <td class="py-2.5 px-4">{{ $certificate->student->name }}</td>
                                <td class="py-2.5 px-4">{{ $certificate->diploma->DiplomaName }}</td>
                                <td class="py-2.5 px-4">{{ $certificate->session->session }}</td>
                                <td class="py-2.5 px-4 text-green-600 font-semibold">
                                    <span
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors no-underline {{ $certificate->status === 'pending' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }}">
                                        {{ ucFirst($certificate->status) }}
                                    </span>
                                </td>

                                <td class="py-3 px-4 text-green-600 font-semibold">
                                    <button type="button" data-modal-target="deleteModal" data-id="{{ $certificate->id }}"
                                        class="inline-flex items-center px-2 no-underline py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        Cancel
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
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

    <!-- DELETE MODAL -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">

            <!-- dynamic form (no action yet) -->
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" id="deleteId">

                <div class="flex flex-col mb-4">
                    <h1 class="font-bold text-[20px] text-center">Delete Modal</h1>
                    <div class="border border-1 border-gray-500 mb-4"></div>
                    <span class="text-[18px] font-semibold">Are You Sure To Cancel This Request?</span>
                </div>

                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition mt-2">
                    Yes
                </button>

                <button type="button" data-close-modal="deleteModal"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition mt-2">
                    Close
                </button>
            </form>

        </div>
    </div>

    <script>
        // Open modal and set dynamic delete route
        document.querySelectorAll('[data-modal-target]').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');

                // set form action dynamically
                document.getElementById('deleteForm').action = "/certificate/" + id;

                // set hidden input value
                document.getElementById('deleteId').value = id;

                // open modal
                const modal = document.getElementById('deleteModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        // Close modal
        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = document.getElementById(btn.getAttribute('data-close-modal'));
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });

        // Close modal on outside click
        document.getElementById('deleteModal').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                e.currentTarget.classList.add('hidden');
                e.currentTarget.classList.remove('flex');
            }
        });
    </script>

    <!-- DATATABLE SCRIPT -->
    <script>
        $(document).ready(function() {
            var table = $('.requestedCertificate-table').DataTable({
                dom: '<"mid-toolbar flex gap-4 items-center mb-4 mr-3"lf>' +
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
            });
        });
    </script>

@endsection
