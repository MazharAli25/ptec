<!-- Header -->
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Student Dashboard</h1>

            <p class="text-gray-600 mt-2">Welcome back, <span
                    class="font-semibold text-green-600">{{ Auth::guard('student')->user()->name }}</span>
            </p>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Notifications Dropdown -->
            <div class="relative">
                <button onclick="toggleDropdown('notifications-dropdown')"
                    class="relative p-2 text-gray-600 hover:text-green-600">
                    <i class="fas fa-bell text-xl"></i>
                    <span
                        class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                </button>
                <div id="notifications-dropdown"
                    class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="font-semibold text-gray-800">Notifications</h3>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <a href="#" class="flex items-start p-3 hover:bg-gray-50 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                <i class="fas fa-bullhorn text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">New Quiz Available</p>
                                <p class="text-xs text-gray-500 mt-1">Web Development quiz is now available</p>
                                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start p-3 hover:bg-gray-50 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Class Rescheduled</p>
                                <p class="text-xs text-gray-500 mt-1">CIT-101 class moved to 2 PM</p>
                                <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start p-3 hover:bg-gray-50">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center mr-3">
                                <i class="fas fa-trophy text-amber-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Achievement Unlocked</p>
                                <p class="text-xs text-gray-500 mt-1">You scored 95% in Database Quiz</p>
                                <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                            </div>
                        </a>
                    </div>
                    <div class="p-3 border-t border-gray-200">
                        <a href="#"
                            class="block text-center text-sm text-green-600 font-medium hover:text-green-700">View All
                            Notifications</a>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                @php
                    $name = Auth::guard('student')->user()->name;
                    $initials = collect(explode(' ', $name))
                        ->map(fn($word) => strtoupper(mb_substr($word, 0, 1)))
                        ->implode('');
                @endphp
                <button onclick="toggleDropdown('profile-dropdown')"
                    class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100">
                    <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center">
                        <span class="font-bold text-white">{{ $initials }}</span>
                    </div>
                    <i class="fas fa-chevron-down text-gray-500"></i>
                </button>
                <div id="profile-dropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <div class="p-4 border-b border-gray-200">
                        <p class="font-semibold text-gray-800"> {{ Auth::guard('student')->user()->name }}</p>
                        <p class="text-sm text-gray-500">Student</p>
                    </div>
                    <div class="py-2">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i
                                class="fas fa-user mr-2"></i>Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i
                                class="fas fa-cog mr-2"></i>Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i
                                class="fas fa-question-circle mr-2"></i>Help</a>
                        <div class="border-t border-gray-200 my-2"></div>
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"><i
                                class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
