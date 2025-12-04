<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Institute Management</title>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>



</head>

<body>
    <header class="flex justify-center py-6 bg-white shadow">
        <img src="https://ptec.com.pk/images/letter-head-h.png" alt="Logo" class="w-1/2 md:w-1/3 h-auto" />
    </header>
    <nav class="bg-[#0d6b61] text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap justify-center space-x-6 md:space-x-8 py-3 text-sm md:text-base font-medium">
                <a href="" class="hover:text-gray-300">Home</a>

                <!-- About Us dropdown -->
                <div class="relative group">
                    <button class="flex items-center hover:text-gray-300">


                    </button>
                    <div class="absolute  hidden group-hover:block bg-white z-1 text-black rounded shadow-md mt-2 w-40">

                    </div>
                </div>


                <div class="relative">
                    <!-- Button -->
                    <button id="dropdownAbout" class="flex items-center hover:text-gray-300">
                        About Us
                        <svg class="ml-1 w-3 h-3 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div id="dropdownAbout_US"
                        class="absolute hidden z-10 bg-white text-black rounded shadow-md mt-2 w-48">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Our Mission</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Team</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">History</a>
                    </div>
                </div>
                <!-- Trades dropdown -->
                <div class="relative group">
                    <a href="" class="flex items-center hover:text-gray-300">
                        Trades
                    </a>

                </div>

                <!-- E-Services dropdown -->
                <div class="relative">

                    <button id="dropdownButton" class="flex items-center hover:text-gray-300">
                        E-Services
                        <svg class="ml-1 w-3 h-3 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div id="dropdownMenu" class="absolute hidden z-10 bg-white text-black rounded shadow-md mt-2 w-48">
                        <a href="" class="block px-4 py-2 hover:bg-gray-100">Info-E-Services</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Online Verification</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Payment</a>
                    </div>
                </div>


                <a href="" class="hover:text-gray-300">Apply Online</a>
                <a href="" class="hover:text-gray-300">Verification</a>
                <a href="" class="hover:text-gray-300">Challan</a>
                <a href="" class="hover:text-gray-300">Downloads</a>
                <a href="" class="font-semibold hover:text-gray-300">Contact</a>
                <a href="" class="font-semibold hover:text-gray-300">Login</a>
            </div>
        </div>
    </nav>

    @yield('main-content')

    <script>
        const button = document.getElementById('dropdownButton');
        const menu = document.getElementById('dropdownMenu');

        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });


        window.addEventListener('click', (e) => {
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
        //  About Us Dropdown
        const button_About = document.getElementById('dropdownAbout');
        const menu_About = document.getElementById('dropdownAbout_US');

        // Toggle dropdown on click
        button_About.addEventListener('click', () => {
            menu_About.classList.toggle('hidden');
        });

        // Optional: Close dropdown if clicked outside
        window.addEventListener('click', (e) => {
            if (!button_About.contains(e.target) && !menu_About.contains(e.target)) {
                menu_About.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
