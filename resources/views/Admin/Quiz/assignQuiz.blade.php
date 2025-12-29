@extends('layouts.admin')
@section('page-title', 'Assign Quiz to Students')

@section('main-content')
    <!-- Main Content -->
    <div class="flex-1 p-8 ml-[19vw]">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Assign Quiz</h1>
            <p class="text-gray-600 mt-2">Fill in the details to assign quiz</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg form-shadow p-6 mb-8">
            <form method="POST" action="{{ route('admin.quiz.storeAssignedQuiz') }}" class="w-full">
                @csrf

                <!-- Title -->
                <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Assign Quiz</h2>

                <!-- Top Inputs -->
                <div class="flex flex-wrap justify-between items-center gap-6 w-full mb-6">
                    <!-- Quiz Name -->
                    <div class="flex-1 min-w-[250px]">
                        <label for="quizId" class="block text-sm font-medium text-gray-700 mb-1">Quiz Name</label>
                        <select type="text" name="quizId" id="quizId"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter Quiz Name" value="{{ old('quizId') }}">
                            <option value="">Select Quiz</option>
                            @foreach ($quizzes as $quiz)
                                <option value="{{ $quiz->id }}">{{ $quiz->quizName }}</option>
                            @endforeach
                        </select>
                        @error('quizId')
                            <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- From Date -->
                    <div class="flex-1 min-w-[250px]">
                        <label for="fromDate" class="block text-sm font-medium text-gray-700 mb-1">From</label>
                        <input type="datetime-local" min="1900-01-01T00:00" max="2099-12-31T23:59" name="fromDate"
                            id="fromDate"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            value="{{ old('fromDate') }}">
                        @error('fromDate')
                            <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- To Date -->
                    <div class="flex-1 min-w-[250px]">
                        <label for="toDate" class="block text-sm font-medium text-gray-700 mb-1">To</label>
                        <input type="datetime-local" min="1900-01-01T00:00" max="2099-12-31T23:59" name="toDate"
                            id="toDate"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            value="{{ old('toDate') }}">
                        @error('toDate')
                            <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Course Selection Table -->
                <div class="rounded-lg overflow-hidden mb-8">
                    <table class="min-w-full examination-marks-table">
                        <thead class="bg-cyan-600 text-white">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider w-12 rounded-tl-lg">
                                    <input type="checkbox" id="selectAll" class="cursor-pointer">
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Student Name
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Diploma
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider rounded-tr-lg">
                                    Session
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Data inserting dynamically with yajra datatables --}}
                        </tbody>
                    </table>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('.examination-marks-table').DataTable({
                dom: '<"top-toolbar flex justify-start items-center mb-4">' +
                    '<"mid-toolbar flex gap-4 items-center mb-4"lf>' +
                    't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4 mb-4"<"flex-1"></><"flex justify-center"p><"flex-1 text-right mr-3 text-sm text-gray-500"i>>',
                pageLength: 100,
                stateSave: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('admin.quiz.assign') }}",
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
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'student_name',
                        name: 'student_name'
                    },
                    {
                        data: 'diploma_name',
                        name: 'diploma_name'
                    },
                    {
                        data: 'session_name',
                        name: 'session_name'
                    }
                ],
            });

            $(document).on('change', '#selectAll', function() {
                $('.student-checkbox').prop('checked', this.checked);
            });

            $(document).on('change', '.student-checkbox', function() {
                let total = $('.student-checkbox').length;
                let checked = $('.student-checkbox:checked').length;

                $('#selectAll').prop('checked', total === checked);
            });

            $('.dt-input').on('keyup change', function() {
                sessionStorage.setItem('datatableSearch', $(this).val());
            });

            var oldSearch = sessionStorage.getItem('datatableSearch');
            if (oldSearch) {
                table.search(oldSearch).draw();
                $('.dt-input').val(oldSearch);
            }

            window.addEventListener('beforeunload', function() {
                sessionStorage.clear();
            });
        });
    </script>
@endsection
