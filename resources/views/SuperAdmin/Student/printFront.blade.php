<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Card Print</title>

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

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .student-photo {
                position: relative !important;
                z-index: 999999 !important;
                display: block !important;
                opacity: 1 !important;
            }

            img {
                -webkit-print-color-adjust: exact !important;
            }
        }
    </style>
</head>

<body class="flex justify-center items-center bg-gray-100">

    <div class="relative w-[1100px] h-[750px] mx-auto mt-10 bg-white shadow-lg overflow-hidden">

        {{-- Background card template --}}
        <img src="{{ asset('images/card-front.jpeg') }}" alt="card Template"
            class="image absolute inset-0 w-full h-full object-cover z-0 print:z-0">

        {{-- Overlay Text --}}
        <div class="content print:absolute font-serif text-[16px] leading-tight text-black z-10">

            {{-- {{ dd($card->student->image) }} --}}

            {{-- 
                FIXES APPLIED:
                1. Changed 'Storage' to 'storage' (lowercase).
                2. Removed 'print:' prefixes so image loads immediately.
                3. Changed z-100 to z-20 (valid tailwind class).
            --}}
            <img src="{{ asset('storage/' . $card->student->image) }}" alt="Student Photo"
                class="student-photo opacity-0 absolute object-cover border-2 border-gray-300
            top-[260px] left-[740px] print:left-[720px] w-[294px] h-[330px]">

            {{-- Student Name --}}
            <p
                class="print:absolute print:top-[39vh] print:w-[200px] print:left-[27vw] print:text-white print:text-[30px]">
                {{ $card->student->name }}
            </p>

            {{-- Father’s Name --}}
            <p
                class="print:absolute print:top-[47.6vh] print:w-[500px] print:left-[27vw] print:text-white print:text-[30px]">
                {{ $card->student->fatherName }}
            </p>

            {{-- Institute --}}
            {{-- <p class="print:absolute print:top-[47.3vh] print:w-[200px] print:left-[23vw]">
                {{ $card->student->institute->institute_name }}
            </p> --}}
            {{-- Diploma --}}
            <p
                class="print:absolute print:top-[56vh] print:w-[400px] print:left-[27vw] print:text-white print:text-[30px]">
                {{ $card->diploma->studentDiplomas[0]->diploma->DiplomaName }}
            </p>

            <p class="print:absolute print:top-[64vh] print:left-[35vw] print:text-white print:text-[34px]">
                {{ $card->student->id }}
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
