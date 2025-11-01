@extends('layouts.superAdmin')
@section('page-title', 'View Student Result')

@section('main-content')
    <style>
        /* Print Settings for A4 Full Page */
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .aside{
                display: none !important;
            }

            .certificate {
                width: 210mm;
                height: 297mm;
                padding: 15mm 20mm;
                box-sizing: border-box;
                border: 3px solid #166534;
                page-break-inside: avoid;
            }
        }

        /* On Screen */
        body {
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .certificate {
            width: 210mm;
            height: 297mm;
            background: white;
            border: 3px solid #166534;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 2rem 20mm 20mm 20mm;
            box-sizing: border-box;
            font-family: "Times New Roman", serif;
        }
    </style>

    @php
        function numberToWords($num)
        {
            $ones = [
                0 => 'Zero',
                1 => 'One',
                2 => 'Two',
                3 => 'Three',
                4 => 'Four',
                5 => 'Five',
                6 => 'Six',
                7 => 'Seven',
                8 => 'Eight',
                9 => 'Nine',
                10 => 'Ten',
                11 => 'Eleven',
                12 => 'Twelve',
                13 => 'Thirteen',
                14 => 'Fourteen',
                15 => 'Fifteen',
                16 => 'Sixteen',
                17 => 'Seventeen',
                18 => 'Eighteen',
                19 => 'Nineteen',
            ];

            $tens = [
                2 => 'Twenty',
                3 => 'Thirty',
                4 => 'Forty',
                5 => 'Fifty',
                6 => 'Sixty',
                7 => 'Seventy',
                8 => 'Eighty',
                9 => 'Ninety',
            ];

            if ($num < 20) {
                return $ones[$num];
            } elseif ($num < 100) {
                $ten = floor($num / 10);
                $one = $num % 10;
                return $tens[$ten] . ($one ? '-' . strtolower($ones[$one]) : '');
            } elseif ($num < 1000) {
                $hundred = floor($num / 100);
                $remainder = $num % 100;
                return $ones[$hundred] .
                    ' hundred' .
                    ($remainder ? ' and ' . strtolower(numberToWords($remainder)) : '');
            } elseif ($num < 1000000) {
                $thousand = floor($num / 1000);
                $remainder = $num % 1000;
                return numberToWords($thousand) .
                    ' thousand' .
                    ($remainder ? ' ' . strtolower(numberToWords($remainder)) : '');
            } else {
                return (string) $num;
            }
        }
    @endphp



    {{-- <div class="border-4 border-red-800 p-8 mx-auto max-w-4xl ml-[25vw] mt-10">

        <!-- Header -->
        <div class="text-center border-b-2 border-red-800 pb-2 mb-3">
            <h1 class="text-2xl font-bold text-red-800 uppercase tracking-wide">
                Board of Intermediate & Secondary Education
            </h1>
            <h2 class="text-xl font-bold text-red-800 mt-1">Peshawar</h2>
        </div>

        <!-- Student Info -->
        <div class="text-sm leading-6 space-y-1 mb-6">
            <p><span class="font-bold">Roll No:</span> {{ $result->student->id }}</p>
            <p><span class="font-bold">Diploma:</span>
                {{ $result->ExaminationCriteria->diplomawiseCourse->diploma->DiplomaName }}</p>
            <p><span class="font-bold">Name:</span>{{ $result->student->name }}</p>
            <p><span class="font-bold">Father’s Name:</span>{{ $result->student->fatherName }}</p>
            <p><span class="font-bold">Institution:</span>{{ $result->student->institute->institute_name }}</p>
            <p><span class="font-bold">Exam Session:</span>Annual 2011</p>
        </div>

        <!-- Marks Table -->
        <table class="w-full border border-gray-400 text-center text-sm">
            <thead class="bg-gray-200">
                <tr class="text-gray-800">
                    <th class="border border-gray-400 py-2 px-2">Subjects</th>
                    <th class="border border-gray-400 py-2 px-2">Total Marks</th>
                    <th class="border border-gray-400 py-2 px-2">obtained_marks</th>
                    <th class="border border-gray-400 py-2 px-2">In Words</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td class="border border-gray-400 py-1 px-2 text-left">
                            {{ $course->ExaminationCriteria->diplomawiseCourse->course->courseName }}</td>
                        <td class="border border-gray-400 py-1 px-2">{{ $course->TotalMarks }}</td>
                        <td class="border border-gray-400 py-1 px-2 font-bold">{{ $course->ObtainedMarks }}</td>
                        <td class="border border-gray-400 py-1 px-2 italic">{{ numberToWords($course->ObtainedMarks) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <div class="mt-4 flex justify-between items-center">
            <p class="font-bold">Total: {{ $totalMarks }}</p>
            <p class="font-bold text-red-800">Marks Obtained: {{ $obtainedMarks }}</p>
        </div>

        <p class="mt-2 font-semibold italic text-gray-700">In Words: Zero Only</p>

        <!-- Footer -->
        <div class="mt-8 flex justify-between text-sm">
            <div>
                <p>Date of Birth: <span class="font-semibold">07th January 1993</span></p>
                <p>Issue Date: <span class="font-semibold">15-06-2011</span></p>
            </div>
            <div class="text-right">
                <p class="font-semibold">Controller of Examinations</p>
                <p class="italic text-gray-600">(Signature)</p>
            </div>
        </div>
    </div> --}}
    <div class="certificate ml-[20vw] mr-[5vw] mb-[5vh]">

        <!-- Header -->
        <div class="text-center border-b-4 border-[#0a6452] pb-4">
            <img src="{{ asset('images/logo.png') }}" alt="PTEC Logo" class="mx-auto h-20 mb-3">
            <h1 class="text-2xl font-bold text-[#0a6452] uppercase tracking-wide">Pakistan Technical & Education Council
                Islamabad</h1>
            <h2 class="text-lg font-semibold text-gray-800 mt-1 uppercase">Detailed Marks Certificate</h2>
        </div>

        <!-- Program Title -->
        <div class="text-center mt-3 border-b border-[#0a6452] pb-1">
            <p class="text-lg font-semibold text-[#0a6452] uppercase">Health Safety and Environmental Engineering (HSE)</p>
        </div>

        <!-- Candidate Information -->
        <div class="mt-6 text-gray-800 text-sm leading-relaxed">
            <!-- Line 1 -->

            <div class="flex justify-between">
                <p><strong>Reg No:</strong> <span
                        class="border-b border-gray-500 inline-block w-60 ml-2">PTEC/PITE/246-9894</span></p>
                <p><strong>Session:</strong> <span class="border-b border-gray-500 inline-block w-60 ml-2">{{ $courses[0]->ExaminationCriteria->diplomawiseCourse->diploma->session->session}}
                        (Annually)</span></p>
            </div>

            <!-- Line 2 -->
            <div class="flex justify-between mt-3">
                <p><strong>Name of Candidate:</strong> <span
                        class="border-b border-gray-500 inline-block w-60 ml-2">{{ $result->student->name }}</span></p>
                <p><strong>Father's Name:</strong> <span
                        class="border-b border-gray-500 inline-block w-60 ml-2">{{ $result->student->fatherName }}</span>
                </p>
            </div>

            <!-- Line 3 -->
            <div class="mt-3">
                <p><strong>Institute College:</strong> <span
                        class="border-b border-gray-500 inline-block w-[38rem] ml-2">{{ $result->student->institute->institute_name }}{{$result->ExaminationCriteria->diplomawiseCourse->diploma->DiplomaName }}</span>
                </p>
            </div>
        </div>

        <!-- Year Info -->
        <div class="mt-6 text-sm text-gray-700 border-b border-gray-400 pb-2">
            <p><strong>2nd Year</strong> | <strong>Roll No: </strong>{{ $result->student->id }} | <strong>Session:</strong>
                {{ $result->ExaminationCriteria->diplomawiseCourse->diploma->session->session }}</p>
        </div>

        <!-- Marks Table -->
        <div class="mt-4">
            <table class="w-full table-fixed border border-gray-400 text-sm text-center">
                <thead>
                    <!-- First Header Row -->
                    <tr class="bg-[#0a6452] text-white">
                        <th rowspan="2" class="border px-2 py-1 w-[5%]">S#</th>
                        <th rowspan="2" class="border px-2 py-1 w-[35%]">Subjects</th>
                        <th rowspan="2" class="border px-2 py-1 w-[12%]">Total Marks</th>
                        <th colspan="3" class="border px-2 py-1 w-[35%]">Obtained Marks</th>
                        <th rowspan="2" class="border px-2 py-1 w-[13%]">Remarks</th>
                    </tr>

                    <!-- Second Header Row -->
                    <tr class="bg-[#0a6452] text-white">
                        <th class="border px-2 py-1">TH</th>
                        <th class="border px-2 py-1">PR/Viva</th>
                        <th class="border px-2 py-1">Total</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp

                <tbody>
                    @foreach ($courses as $course)
                        <tr class="border">
                            <td class="py-2">{{$i}}</td>
                            <td class="text-left px-2 py-2">
                                {{ $course->ExaminationCriteria->diplomawiseCourse->course->courseName }}</td>
                            <td class="py-2">{{ $course->TheoryTotalMarks + $course->PracticalTotalMarks }}</td>
                            <td class="py-2">{{ $course->TheoryMarks }}</td>
                            <td>{{ $course->PracticalMarks }}</td>
                            <td class="py-2">{{ $course->TheoryMarks + $course->PracticalMarks }}</td>
                            <td class="py-2">{{ $course->status }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot class="bg-green-100 font-semibold">
                    <tr>
                        <td colspan="2" class="text-right border px-2 py-1">Total Marks:</td>
                        <td>{{ $totalMarks }}</td>
                        <td colspan="2" class="text-right border px-2 py-1">Obtained Marks:</td>
                        <td>{{ $obtainedMarks }}</td>
                        <td>Pass</td>
                    </tr>
                </tfoot>
            </table>

        </div>

        <!-- Footer -->
        <div class="mt-6 text-xs text-gray-700 border-t border-gray-400 pt-3 leading-relaxed">
            <p><strong>Errors and omissions excepted:</strong> Any mistake in above particulars must be intimated within 30
                days of issuance of this certificate.</p>
            <p>Theory Passing Marks: 40% | Practical Passing Marks: 50%</p>

            <div class="flex justify-between items-center mt-6">
                <div>
                    <p class="text-gray-500">© PTEC Islamabad</p>
                </div>
                <div class="text-center">
                    <div class="border-t border-gray-500 w-40 mx-auto"></div>
                    <p class="font-semibold text-gray-700">Controller of Examination</p>
                </div>
            </div>
        </div>

    </div>


@endsection
