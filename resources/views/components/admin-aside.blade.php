<!-- Super Admin Sidebar -->
<aside id="sidebar"
    class="aside fixed top-0 left-0 h-screen w-64 bg-white text-black border-r-4 border-green-500 hidden md:flex flex-col shadow-md z-50">

    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-200 flex justify-center">
        <img src="https://atp.ptec.edu.pk/assets/img/ptec-atp-portal-logo.png" alt="Logo"
            class="w-32 h-32 object-contain" />
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('admin.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-green-100 transition text-black no-underline">
            <i class="fa-solid fa-home text-[#666a85] text-[18px]"></i>
            <span class="font-medium text-[#666a85]">Dashboard</span>
        </a>

        <!-- Student -->
        <div x-data="{ open: {{ request()->routeIs('student.create') || request()->routeIs('admin.studentList') || request()->routeIs('admin.registeredStudentList')  ? 'true' : 'false' }} }" class="relative">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-green-100 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#666a85]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.944a12.083 12.083 0 01-6.16-10.366L12 14z" />
                    </svg>
                    <span class="font-medium text-[#666a85]">Student</span>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 text-gray-600 transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

            </button>

            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('student.create') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('student.create') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Add Student
                </a>
            </div>
            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('admin.registeredStudentList') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('admin.registeredStudentList') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Registered Students List
                </a>
            </div>
            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('admin.studentList') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('admin.studentList') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Students List
                </a>
            </div>
            
        </div>


        <!-- Diploma -->
        <div x-data="{ open: {{ request()->routeIs('studentDiploma.create') || route('admin.assignedDiplomas') ? 'true' : 'false' }} }" class="relative">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-green-100 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#666a85]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.944a12.083 12.083 0 01-6.16-10.366L12 14z" />
                    </svg>
                    <span class="font-medium text-[#666a85]">Diploma</span>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 text-gray-600 transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

            </button>
            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('studentDiploma.create') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                {{ request()->routeIs('studentDiploma.create') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Assign Diploma
                </a>
                <a href="{{ route('admin.assignedDiplomas') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                {{ request()->routeIs('admin.assignedDiplomas') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Assigned Diplomas List
                </a>
            </div>
            
        </div>
        <div x-data="{ open: {{ request()->routeIs('card.*') ? 'true' : 'false' }} }" class="relative">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-green-100 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#666a85]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.944a12.083 12.083 0 01-6.16-10.366L12 14z" />
                    </svg>
                    <span class="font-medium text-[#666a85]">Student Cards</span>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 text-gray-600 transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

            </button>

            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('card.create') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('card.create') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Request Student Card
                </a>
                <a href="{{ route('card.index') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('card.index') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Requested Student Cards
                </a>
            </div>
            
        </div>
        <div x-data="{ open: {{ request()->routeIs('result.*') ? 'true' : 'false' }} }" class="relative">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-green-100 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#666a85]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.944a12.083 12.083 0 01-6.16-10.366L12 14z" />
                    </svg>
                    <span class="font-medium text-[#666a85]">Result</span>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 text-gray-600 transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

            </button>

            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('result.create') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('result.create') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Add Result
                </a>
            </div>
        </div>
        {{-- CERTIFICATES  --}}
        <div x-data="{ open: {{ request()->routeIs('certificate.create') || request()->routeIs('admin.viewCertificates') ? 'true' : 'false' }} }" class="relative">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-green-100 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#666a85]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.944a12.083 12.083 0 01-6.16-10.366L12 14z" />
                    </svg>
                    <span class="font-medium text-[#666a85]">Certificates</span>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 text-gray-600 transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

            </button>

            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('certificate.create') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('certificate.create') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Request Certificates
                </a>
            </div>
            <div x-show="open" x-transition class="mt-1 space-y-1overflow-hidden">
                <a href="{{ route('admin.viewCertificates') }}"
                    class="flex items-center w-full gap-3 text-[15px] px-4 py-2 rounded-none text-[#666a85] font-medium hover:bg-green-100 hover:text-green-700 transition no-underline
                    {{ request()->routeIs('admin.viewCertificates') ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
                    Requested Certificates
                </a>
            </div>
        </div>

        {{-- <form href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-green-100 transition text-black no-underline" method="POST">
            @csrf
            <button class="font-medium text-[#666a85]" type="submit">Logout</button>
        </a> --}}
        <div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-black" type="submit">Logout</button>

            </form>

        </div>

    </nav>
</aside>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
