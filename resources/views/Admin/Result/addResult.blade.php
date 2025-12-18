@extends('layouts.admin')
@section('page-title', 'Add Result')
@section('main-content')
    <form action="{{ route('result.store') }}" method="POST"> @csrf <div class="flex justify-center ml-[18vw] mt-10">
            <div class="overflow-x-auto w-[90%]">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden result-table">
                    <thead class="bg-cyan-600 text-white">
                        <tr>
                            <th class="py-2.5 px-4 text-center">ID</th>
                            <th class="py-2.5 px-4 text-center">Student Name</th>
                            <th class="py-2.5 px-4 text-center">Course</th>
                            <th class="py-2.5 px-4 text-center">Diploma</th>
                            <th class="py-2.5 px-4 text-center">Theory Marks</th>
                            <th class="py-2.5 px-4 text-center">Practical Marks</th>
                            <th class="py-2.5 px-4 text-center">Obtained Theory Marks</th>
                            <th class="py-2.5 px-4 text-center">Obtained Practical Marks</th>
                            {{-- <th class="py-2.5 px-4 text-center font-semibold">Passing Marks</th> --}}
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200 text-center">
                        {{-- @foreach ($students as $index => $student)
                             {{ dd($student->studentCourse->student->id) }} --}}
                        {{-- <tr> {{-- {{ dd($students->diplomawiseCourse) }} --}} {{-- {{ dd() }} --}} <td class="py-2.5 w-[5px]">
                            {{-- {{ $student->studentDiploma->student->id }}
                                </td>
                                <td class="py-2.5 px-4">{{ $student->studentDiploma->student->name }}</td>
                                <td class="py-2.5 px-4">{{ $student->diplomawiseCourse->course->courseName }}</td>
                                <td class="py-2.5 px-4">{{ $student->diplomawiseCourse->diploma->DiplomaName }}
                                    ({{ $student->diplomawiseCourse->diploma->session->session }})
                                </td>
                                <td class="px-4"> <input type="hidden" name="examinationCriteriaID[]"
                                        value="{{ $student->diplomawiseCourse->examinationCriteria->ID ?? '' }}"> <input
                                        type="hidden" name="theoryTotalMarks[]"
                                        value=" {{ $student->diplomawiseCourse->examinationCriteria->TheoryMarks ?? 'Nill' }}">
                                    <input type="hidden" name="diplomaID[]"
                                        value=" {{ $student->diplomawiseCourse->diploma->id }}"> <input type="hidden"
                                        name="sessionID[]" value="{{ $student->diplomawiseCourse->diploma->session->id }}">
                                    <input type="hidden" name="semesterID[]"
                                        value="{{ $student->diplomawiseCourse->semester->id }}">
                                    {{ $student->diplomawiseCourse->examinationCriteria->TheoryMarks ?? 'Nill' }}
                                </td>
                                <td class="px-4"> <input type="hidden" name="studentID[]"
                                        value="{{ $student->studentDiploma->student->id }}"> <input type="hidden"
                                        name="practicalTotalMarks[]"
                                        value=" {{ $student->diplomawiseCourse->examinationCriteria->PracticalMarks ?? 'Nill' }}">
                                    {{ $student->diplomawiseCourse->examinationCriteria->PracticalMarks ?? 'Nill' }} 
                                </td>
                                <td class="px-4"> <input type="number" name="theoryMarks[]"
                                        class="border border-gray-300 rounded px-2 py-1 w-20 text-center"
                                        value="{{ old('theoryMarks.' . $index) }}"
                                        oninput="if(this.value.length>3) this.value=this.value.slice(0,3)"> 
                                </td>
                                <td class="px-4"> <input type="number" name="practicalMarks[]"
                                    class="border border-gray-300 rounded px-2 py-1 w-20 text-center"
                                    value="{{ old('practicalMarks.' . $index) }}"
                                    oninput="if(this.value.length>3) this.value=this.value.slice(0,3)">
                                </td> --}}
                            {{-- <td class="py-2.5 px-4"> <input type="number" name="passingMarks[]" class="border border-gray-300 rounded px-2 py-1 w-20 text-center" oninput="if(this.value.length>2) this.value=this.value.slice(0,2)" required> </td> --}}
                            {{-- </tr>  
                        @endforeach --}}
                    </tbody>
                </table>
                <div class="flex justify-center mb-[5vh]"> <button type="submit"
                        class="bg-cyan-600 text-white px-4 py-2 rounded hover:bg-cyan-700 transition-colors">Submit Results
                    </button> </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            var table = $('.result-table').DataTable({
                dom: '<"mid-toolbar flex gap-4 items-center mb-4 mr-3"lf>' + 't' +
                    '<"bottom-toolbar flex items-center justify-between mt-4"<"flex-1"></><"flex justify-center"><"flex-1 text-right text-sm text-gray-500">>',
                pageLength: 100,
                stateSave: true,
                // For Yajra
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('result.create') }}"
                },
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search here...",
                    lengthMenu: "_MENU_"
                },
                initComplete: function() {
                    $('.dt-input').addClass(
                        'border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm'
                    ).css({
                        'width': '200px',
                        'padding': '6px 10px',
                    });
                    $('.dt-length select').addClass(
                        'border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm'
                    ).css({
                        'width': '80px',
                        'padding': '6px 10px'
                    });
                    $('.dt-length').addClass(
                        'px-3 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm');
                },
                columns: [{
                        data: 'student_id',
                        name: 'studentDiploma.student.id'
                    },
                    {
                        data: 'student_name',
                        name: 'studentDiploma.student.name'
                    },
                    {
                        data: 'course',
                        name: 'diplomawiseCourse.course.courseName'
                    },
                    {
                        data: 'diploma',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'theory_total',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'practical_total',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'theory_marks',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'practical_marks',
                        orderable: false,
                        searchable: false
                    }
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
            // Clear sessionStorage when leaving/reloading the page 
            window.addEventListener('beforeunload', function() {
                sessionStorage.clear();
            });
        });
    </script>
@endsection
