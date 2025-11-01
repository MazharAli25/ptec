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

            .image{
                z-index: 1;
            }
            .content{
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
            <p class="print:absolute print:top-[28vh] print:left-[210px]">
                {{ $certificate->student->id }}
            </p>

            {{-- Student Name --}}
            <p class="print:absolute print:top-[42vh] print:w-[200px] print:left-[22vw]">
                {{ $certificate->student->name }}
            </p>

            {{-- Father’s Name --}}
            <p class="print:absolute print:top-[42vh] print:w-[200px] print:left-[60vw]">
                {{ $certificate->student->fatherName }}
            </p>

            {{-- Institute --}}
            <p class="print:absolute print:top-[47.3vh] print:w-[200px] print:left-[23vw]">
                {{ $certificate->student->institute->institute_name }}
            </p>
            {{-- Diploma --}}
            <p class="print:absolute print:top-[52vh] print:w-[400px] print:left-[45vw]">
                {{ $certificate->diploma->studentDiplomas[0]->diploma->DiplomaName }}  ({{ $certificate->diploma->studentDiplomas[0]->diploma->session->session }})
            </p>

            {{-- Issued On --}}
            <p class="print:absolute print:top-[65.5vh] print:w-[200px] print:left-[52vw] text-[13px]">
                {{ \Carbon\Carbon::parse($issuedDate)->format('d F Y') }}
            </p>

            {{-- Day --}}
            <p class="print:absolute print:top-[65.5vh] w-[200px] print:left-[67vw] print:text-[13px]">
                {{ \Carbon\Carbon::parse($issuedDate)->format('l') }}
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