<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title> @yield('page-title') | Institute Portal Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById(`${id}-icon`);
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
</head>

<body class="bg-gray-50">
    <div class="w-65 h-[100vh] fixed top-0 left-0 flex flex-col shadow-sidebar overflow-y-auto text-white">
        <!-- Sidebar -->
        <aside class="bg-[#1e1f1e] w-65 h-[89.3vh] fixed top-0 left-0 flex flex-col shadow-sidebar overflow-y-auto">
            <!-- Logo Section -->
            <div class="px-3 mb-2 flex items-center space-x-3 border-b border-[#6e6d6d] pb-6 mx-4 my-6">
                <div class="p-2 rounded-lg">
                    <i class="fa-solid fa-a text-xl bg-[#2d2e2d] rounded"></i>
                </div>
                <h1 class="text-xl font-bold text-white">
                   Institute Portal
                </h1>
            </div>

            <div class="px-4 py-6">
                <ul class="space-y-2">

                    <!-- Management Dropdown -->
                    <li>
                        <button onclick="toggleDropdown('management-dropdown')"
                            class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                            <a href="{{ route('add_institute') }}">Institutes</a>
                            <i id="management-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                        </button>
                        <ul id="management-dropdown" class="ml-4 mt-1 space-y-1 hidden">
                            <li class="p-2 hover:bg-[#2d2e2d] rounded text-sm"><a href="">Add Institute</a></li>
                        </ul>
                    </li>


                    <!-- Visitors Dropdown -->
                    <li>
                        <button onclick="toggleDropdown('fee-dropdown')"
                            class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                            <span>Certificates</span>
                            <i id="fee-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                        </button>
                        <ul id="fee-dropdown" class="ml-4 mt-1 space-y-1 hidden">
                            <li class="p-2 hover:bg-[#2d2e2d] rounded text-sm"> <a href="">Certificate for
                                    Approval</a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="p-4 border-t border-[#6e6d6d] mt-4 bottom-0 bg-[#1e1f1e] w-[18.3vw] fixed">
            <div class="flex items-center space-x-3">
                <img class="h-9 w-9 rounded-full object-cover border-2 border-quiz-accent"
                    src="https://randomuser.me/api/portraits/men/1.jpg" alt="User" />
                <div>
                    <p class="text-sm font-medium text-white">{{ Auth()->user()->name }}</p>
                    <p class="text-xs text-quiz-accent">{{ Auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>


    </div>
    </div>

    <style>
        .transition-transform {
            transition: transform 0.2s ease-in-out;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
</body>

</html>
