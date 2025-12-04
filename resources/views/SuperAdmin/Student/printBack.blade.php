<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>card Print</title>

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

        {{-- Background card --}}
        <img src="{{ asset('images/card-back.jpeg') }}" alt="card Template"
            class="image absolute inset-0 w-full h-full object-cover z-0">

        {{-- Overlay Text --}}
        <div class="content print:absolute font-serif text-[16px] leading-tight text-black z-10">

            {{-- Roll No --}}
            
            {{-- Phone --}}
            <p class="print:absolute print:top-[13.5vh] print:w-[200px] print:left-[24vw] print:text-[30px] print:font-semibold">
                {{ $card->student->phone }}
            </p>

            {{-- Address --}}
            <p class="print:absolute print:top-[20.8vh] print:w-[800px] print:left-[24vw] print:text-[30px] print:font-semibold">
                {{ $card->student->address }}
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