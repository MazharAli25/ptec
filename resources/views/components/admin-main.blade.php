<!-- ✅ Load Alpine.js (only once, ideally in your layout or header) -->
<script src="https://unpkg.com/alpinejs" defer></script>

<div x-data="{ open: false }" class="flex min-h-screen  text-white">



    <!-- 🧭 Sidebar -->
    <aside
    id="mobile-menu"
        x-show="open || window.innerWidth >= 768"
        @resize.window="open = window.innerWidth >= 768"
        x-transition:enter="transition transform ease-out duration-300"
        x-transition:enter-start="-translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition transform ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
        id="sidebar"
        class="fixed top-0 left-0 h-screen w-64 bg-white text-black border-r-4 border-green-500 hidden md:flex flex-col shadow-md z-50">

        <div class="p-4 border-b border-green-800">
            <h1 class="text-xl font-bold tracking-tight">Dashboard</h1>
            <p class="text-xs text-black-400">Welcome, Super Admin</p>
        </div>

        <nav class="px-3 py-4 space-y-2 overflow-y-auto">
            <ul class="space-y-1">

                <!-- Dashboard -->
                <li>
                    <a href=""
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-green-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Institute Admin Dropdown -->
                <li x-data="{ openDropdown: false }" class="relative">
                    <button
                        @click="openDropdown = !openDropdown"
                        class="flex items-center justify-between w-full gap-3 px-3 py-2 rounded-lg hover:bg-green-800 focus:outline-none">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c1.104 0 2 .672 2 1.5S13.104 11 12 11s-2-.672-2-1.5S10.896 8 12 8zM4 20v-1a4 4 0 014-4h8a4 4 0 014 4v1" />
                            </svg>
                            <span>Institute Admin</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-300"
                            :class="{ 'rotate-180': openDropdown }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul
                        x-show="openDropdown"
                        x-transition
                        @click.outside="openDropdown = false"
                        class="ml-4 mt-2 bg-white-900 text-black rounded-lg  overflow-hidden">
                        <li><a href="" class="block px-4 py-2 text-sm text-black hover:bg-[#F5F5F0] text-black">Add New Admin</a></li>
                        <li><a href="" class="block px-4 py-2 text-sm text-black hover:bg-[#F5F5F0] text-black">Registered Admins</a></li>

                    </ul>
                </li>

                <!-- Certificate Dropdown -->
                <li x-data="{ openDropdown: false }" class="relative">
                    <button
                        @click="openDropdown = !openDropdown"
                        class="flex items-center justify-between w-full gap-3 px-3 py-2 rounded-lg hover:bg-green-800 text-black focus:outline-none">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c1.104 0 2 .672 2 1.5S13.104 11 12 11s-2-.672-2-1.5S10.896 8 12 8zM4 20v-1a4 4 0 014-4h8a4 4 0 014 4v1" />
                            </svg>
                            <span>Certificate</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-300"
                            :class="{ 'rotate-180': openDropdown }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul
                        x-show="openDropdown"
                        x-transition
                        @click.outside="openDropdown = false"
                        class="ml-4 mt-2 bg-white-900 rounded-lg  overflow-hidden">
                        <li><a href="#" class="block text-black px-4 py-2 text-sm hover:bg-[#F5F5F0] text-black">Add Cert Template</a></li>
                        <li><a href="#" class="block text-black px-4 py-2 text-sm hover:bg-[#F5F5F0] text-black">Add ID Card Template</a></li>
                        <li><a href="#" class="block text-black px-4 py-2 text-sm hover:bg-[#F5F5F0] text-black">ID Card</a></li>
                    </ul>
                </li>

                <!-- Tasks -->
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-green-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                        </svg>
                        <span>Tasks</span>
                    </a>
                </li>

                <!-- Settings -->
                <li>
                    <a href="" class="flex items-center gap-3 px-3 text-black py-2 rounded-lg hover:bg-green-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </li>

            </ul>
        </nav>
    </aside>