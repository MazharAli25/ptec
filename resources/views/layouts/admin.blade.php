<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('page-title') | PTEC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- JQUERY CDN --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- DATA TABLES CSS--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById(`${id}-icon`);
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {

            font-family: "Poppins", sans-serif;
        }
    </style>

</head>

<body>

    <body>
        <!-- SIDEBAR -->
        <x-admin-aside />

        {{-- ERR --}}
        <x-err></x-err>
        {{-- SUCCESS --}}
        <x-success></x-success>


        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 ml-[20vw]">
            <strong>Whoops! Something went wrong:</strong>
            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        @yield('main-content')
        <script>
            const toggleSidebar = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });
            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && !toggleSidebar.contains(e.target) && window.innerWidth < 768) {
                    sidebar.classList.add('hidden');
                }
            });
        </script>
        <style>
            .transition-transform {
                transition: transform 0.2s ease-in-out;
            }

            .rotate-180 {
                transform: rotate(180deg);
            }
        </style>
            {{-- DATA TABLE JS --}}
            <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>


    </body>

</html>
