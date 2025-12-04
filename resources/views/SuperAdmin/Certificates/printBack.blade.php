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

            .qrCodeContainer {
                display: flex !important;
                align-items: flex-end !important;
                margin-top: 2.5rem !important;
                margin-right: 2.5rem !important;
            }

            .qrCode {
                padding-right: 1.5rem !important;
                padding-bottom: 0.5rem !important;
            }

            .content {
                text-align: center;
            }
        }
    </style>
</head>

<body class="flex justify-center items-center bg-gray-100">

    <div class="relative w-[1100px] h-[750px] mx-auto mt-10 bg-white shadow-lg overflow-hidden">

        {{-- Overlay Text --}}
        <div class="content print:absolute font-serif text-[14px] leading-tight text-black z-10">
            <div class="qrCodeContainer flex flex-col items-end mt-10 me-10">
                <div class="qrCode pr-6 pb-2">
                    {{ $qrCode }}
                </div>
                <div class="content text-center">
                    Scan it QR Code to verify<br>
                    For Online Verification <br>
                    <b>www.ptec.edu.pk</b>

                </div>
            </div>
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
