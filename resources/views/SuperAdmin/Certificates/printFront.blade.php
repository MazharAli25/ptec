<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Certificate Print</title>

    <style>
        @page {
            size: landscape;
            margin: 0;
        }

        @media print {
            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .image {
                z-index: 1;
            }

            .content {
                z-index: 5;
            }
        }
    </style>
</head>

<body class="flex justify-center items-center bg-gray-100">

    <div class="relative w-[1100px] h-[750px] mx-auto mt-10 bg-white shadow-lg overflow-hidden">

        {{-- Background Certificate --}}
        <img src="{{ asset('images/certificate_front.jpeg') }}" alt="Certificate Template"
            class="image absolute inset-0 w-full h-full object-cover z-0">

        {{-- Overlay Text --}}
        <div class="content print:absolute font-serif text-[16px] leading-tight text-black z-10">

            {{-- Roll No --}}
            <p class="print:absolute print:top-[28.2vh]  print:text-[18px] print:left-[200px]">
                {{ $certificate->student->id }}
            </p>

            {{-- Student Name --}}
            <p class="print:absolute print:top-[39.5vh] print:text-[18px] print:w-[200px] print:left-[21vw]">
                {{ $certificate->student->name }}
            </p>

            {{-- Father’s Name --}}
            <p class="print:absolute print:top-[39.5vh] print:text-[18px] print:w-[200px] print:left-[59vw]">
                {{ $certificate->student->fatherName }}
            </p>

            {{-- Roll No --}}
            <p class="print:absolute print:text-[18px] print:top-[45vh] print:w-[200px] print:left-[24vw]">
                @php
                    // Get first letters of each word in institute name
                    $instituteInitials = collect(
                        explode(' ', $certificate->student->certificateInstitute->institute_name),
                    )
                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                        ->implode('');

                    // Get first letters of each word in diploma name
                    $diplomaInitials = collect(
                        explode(' ', $certificate->diploma->studentDiplomas[0]->diploma->DiplomaName),
                    )
                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                        ->implode('');
                @endphp

                EDX/{{ $instituteInitials }}/{{ $diplomaInitials }}-{{ $certificate->student->id }}
            </p>
            {{-- Diploma --}}
            <p class="print:absolute print:top-[50vh] print:text-[18px] print:w-[400px] print:left-[45vw]">
                {{ $certificate->diploma->studentDiplomas[0]->diploma->DiplomaName }}
            </p>
            {{--  From Date --}}
            <p class="print:absolute print:top-[54.5vh] print:text-[18px] print:w-[200px] print:left-[16vw] text-[16px]">
                {{ \Carbon\Carbon::parse($certificate->student->from)->format('d M Y') }}
            </p>
            {{-- To Date --}}
            <p class="print:absolute print:top-[54.5vh] print:text-[18px] print:w-[200px] print:left-[30vw] text-[16px]">
                {{ \Carbon\Carbon::parse($certificate->student->to)->format('d M Y') }}
            </p>

            {{-- Institute Name --}}
            <p class="print:absolute print:top-[59.8vh] print:text-[18px] print:w-[800px] print:left-[220px] text-[16px]">
                {{ $certificate->student->certificateInstitute->institute_name }}
            </p>

            @php
                function ordinal($number)
                {
                    if (!in_array($number % 100, [11, 12, 13])) {
                        switch ($number % 10) {
                            case 1:
                                return $number . 'st';
                            case 2:
                                return $number . 'nd';
                            case 3:
                                return $number . 'rd';
                        }
                    }
                    return $number . 'th';
                }
            @endphp

            {{-- Issued On --}}
            <p class="print:absolute print:top-[66.5vh] print:w-[200px] print:left-[53vw] text-[18px]">
                {{ ordinal((int) \Carbon\Carbon::parse($certificate->student->joiningDate)->format('d')) }}
            </p>


            {{-- Issued On --}}
            <p class="print:absolute print:top-[66.5vh] print:w-[200px] print:left-[68vw] text-[18px]">
                {{ \Carbon\Carbon::parse($certificate->student->joiningDate)->format('M Y') }}
            </p>

        </div>
    </div>

    {{-- Trigger print on load --}}
    <script>
        window.addEventListener('load', () => {
            window.print();
        });
    </script>

</body>

</html>
