@extends('layouts.superAdmin')
@section('page-title', 'View Student Result')

@section('main-content')
    <style>
        /* Print Settings */
        .certificate {
            width: 65vw;
            background: white;
            border: none;
            margin: 0 10vw 100px 25vw;
            padding: 40px 50px;
            box-sizing: border-box;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background: white;
            }

            .aside,
            .no-print {
                display: none !important;
            }

            .certificate {
                width: 100% !important;
                margin: 0 !important;
                padding: 40px 50px !important;
            }

            #studentName span {
                width: 170px !important;
            }

            #fatherName span {
                width: 170px !important;
            }
        }

        /* Button Styling */
        .action-bar {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1rem auto 2rem auto;
        }

        .btn-custom {
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-print {
            background-color: #166534;
        }

        .btn-print:hover {
            background-color: #0f4d28;
        }

        .btn-pdf {
            background-color: #2563eb;
        }

        .btn-pdf:hover {
            background-color: #1e40af;
        }
    </style>

    {{-- Import html2pdf --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-wU5t94ZxYtAYYI/5J/7HSMX1Kxt0Zso5Wltx4pJKmCzB5s70ZMzjWlH2l7/5qEfWcIBsKK5Nf9OStj8UTvU7kw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Action Buttons --}}
    <div class="no-print action-bar">
        <button id="printBtn" class="btn-custom btn-print">Print Certificate</button>
        <button id="pdfBtn" class="btn-custom btn-pdf">Download PDF</button>
    </div>

    <div id="certificateContent" class="certificate">
        <!-- Header -->
        <div class="text-center border-b-4 border-[#0a6452] pb-4">
            <img src="{{ asset('images/logo.png') }}" alt="PTEC Logo" class="mx-auto h-20 mb-3">
            <h1 class="text-2xl font-bold text-[#0a6452] uppercase tracking-wide">
                Pakistan Technical & Education Council Islamabad
            </h1>
            <h2 class="text-lg font-semibold text-gray-800 mt-1 uppercase">Detailed Marks Certificate</h2>
        </div>

        <!-- Program Title -->
        <div class="text-center mt-3 border-b border-[#0a6452] pb-1">
            <p class="text-lg font-semibold text-[#0a6452] uppercase">
                Health Safety and Environmental Engineering (HSE)
            </p>
        </div>

        <!-- Candidate Information -->
        <div class="mt-6 text-gray-800 text-sm leading-relaxed">
            <div class="flex justify-between">
                <p><strong>Reg No:</strong> <span class="border-b border-gray-500 inline-block w-60 ml-2">
                        @php
                            // Get first letters of each word in institute name
                            $instituteInitials = collect(
                                explode(' ', $result->student->certificateInstitute->institute_name),
                            )
                                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                ->implode('');

                            // Get first letters of each word in diploma name
                            $diplomaInitials = collect(
                                explode(' ', $result->student->studentDiplomas[0]->diploma->DiplomaName),
                            )
                                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                ->implode('');
                        @endphp

                        EDX/{{ $instituteInitials }}/{{ $diplomaInitials }}-{{ $result->student->id }}
                    </span></p>
                <p><strong>Session:</strong> <span
                        class="border-b border-gray-500 inline-block w-60 ml-2">{{ $courses[0]->ExaminationCriteria->diplomawiseCourse->diploma->session->session }}
                        (Annually)</span></p>
            </div>

            {{-- Student Information --}}
            <div class="flex justify-between mt-3" id="detailsContainer">

                <p class="flex flex-row w-[400px] gap-0" id="studentName"><strong>Name of Candidate:</strong> <span
                        class="border-b border-gray-500 inline-block w-60 ml-2">{{ $result->student->name }}</span></p>
                <p class="flex flex-row w-[330px] gap-0" id="fatherName"><strong>Father's Name:</strong> <span
                        class="border-b border-gray-500 inline-block w-50 ml-2">{{ $result->student->fatherName }}</span>
                </p>
            </div>

            <div class="mt-3">
                <p><strong>Institute College:</strong> <span
                        class="border-b border-gray-500 inline-block w-[35rem] ml-2">{{ $result->student->certificateInstitute->institute_name }}</span>
                </p>
            </div>
        </div>

        <!-- Year Info -->
        <div class="mt-6 text-sm text-gray-700 border-b border-gray-400 pb-2">
            <p><strong>2nd Year</strong> | <strong>Roll No:</strong>
                {{ $result->student->id }}|
                <strong>Session:</strong> {{ $result->ExaminationCriteria->diplomawiseCourse->diploma->session->session }}
            </p>
        </div>

        <!-- Marks Table -->
        <div class="mt-4">
            <table class="w-full table-fixed border border-gray-400 text-sm text-center">
                <thead>
                    <tr class="bg-[#0a6452] text-white">
                        <th rowspan="2" class="border px-2 py-1 w-[5%]">S#</th>
                        <th rowspan="2" class="border px-2 py-1 w-[35%]">Subjects</th>
                        <th rowspan="2" class="border px-2 py-1 w-[12%]">Total Marks</th>
                        <th colspan="3" class="border px-2 py-1 w-[35%]">Obtained Marks</th>
                        <th rowspan="2" class="border px-2 py-1 w-[13%]">Remarks</th>
                    </tr>
                    <tr class="bg-[#0a6452] text-white">
                        <th class="border px-2 py-1">TH</th>
                        <th class="border px-2 py-1">PR/Viva</th>
                        <th class="border px-2 py-1">Total</th>
                    </tr>
                </thead>
                @php $i = 1; @endphp
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="border">
                            <td class="py-2">{{ $i++ }}</td>
                            <td class="text-left px-2 py-2">
                                {{ $course->ExaminationCriteria->diplomawiseCourse->course->courseName }}
                            </td>
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
                    <tr>
                        <td colspan="6" class="text-right border px-2 py-1">Percentage:</td>
                        <td>{{ $percentage }} %</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-xs text-gray-700 border-t border-gray-400 pt-3 leading-relaxed">
            <p><strong>Errors and omissions excepted:</strong> Any mistake in above particulars must be intimated within
                30 days of issuance of this certificate.</p>
            <p>Theory Passing Marks: 40% | Practical Passing Marks: 50%</p>

            <div class="flex justify-between items-center mt-6">
                <p class="text-gray-500">© PTEC Islamabad</p>
                <div class="text-center">
                    <div class="border-t border-gray-500 w-40 mx-auto"></div>
                    <p class="font-semibold text-gray-700">Controller of Examination</p>
                </div>
            </div>
            <div class="qrCodeContainer flex flex-col justify-center items-center">
                <div class="qrCode">
                    {{ $qrCode }}
                </div>
                <small class="mt-2 text-[12px]">Scan to see this result online</small>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('pdfBtn').addEventListener('click', function() {
            const original = document.querySelector('.certificate');
            const clone = original.cloneNode(true);

            // FIX: Replace thead with proper structure
            const pdfTable = clone.querySelector("table thead");
            pdfTable.innerHTML = `
            <tr class="bg-[#0a6452] text-white">
                <th class="border px-2 py-1 w-[5%]">S#</th>
                <th class="border px-2 py-1 w-[35%]">Subjects</th>
                <th class="border px-2 py-1 w-[12%]">Total Marks</th>
                <th class="border px-2 py-1" colspan="3">Obtained Marks</th>
                <th class="border px-2 py-1 w-[13%]">Remarks</th>
            </tr>
            <tr class="bg-[#0a6452] text-white">
                <td class="border px-2 py-1"></td>
                <td class="border px-2 py-1"></td>
                <td class="border px-2 py-1"></td>
                <td class="border px-2 py-1">TH</td>
                <td class="border px-2 py-1">PR/Viva</td>
                <td class="border px-2 py-1">Total</td>
                <td class="border px-2 py-1"></td>
            </tr>
        `;

            // let dc = document.getElementById('detailsContainer');

            // dc.classList.remove(['justify-between']);
            // dc.classList.add(['justify-evenly']);

            // Clean layout for PDF
            clone.style.width = '100%';
            clone.style.margin = '0';
            clone.style.padding = '30px';

            const container = document.createElement('div');
            container.appendChild(clone);

            html2pdf().set({
                margin: 0,
                filename: 'Certificate.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            }).from(container).save();
        });
    </script>
@endsection
