<!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-white border-r border-gray-200 z-50 overflow-y-auto">
        <div class="p-6">
            <!-- Logo -->
            <div class="flex items-center space-x-3 mb-8">
                <div class="w-10 h-10 rounded-lg bg-green-600 flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-gray-800 text-lg">Student Portal</h2>
                    <p class="text-sm text-gray-500">Dashboard</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('student.dashboard') }}" class="flex items-center justify-between p-3 rounded-lg {{ request()->routeIs('student.dashboard') ? 'bg-green-50 text-green-700' : 'hover:bg-gray-50 text-gray-700' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="font-medium">Dashboard</span>
                    </div>
                </a>
                
                <!-- Dropdown 1: My Courses -->
                <div>
                    <button onclick="toggleDropdown('courses-dropdown')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-book"></i>
                            <span class="font-medium">My Courses</span>
                        </div>
                        <i id="courses-dropdown-icon" class="fas fa-chevron-down text-sm transition-transform"></i>
                    </button>
                    <div id="courses-dropdown" class="{{ request()->routeIs('student.courses') ? '' : 'hidden' }} pl-10 mt-1 space-y-1">
                        <a href="{{ route('student.courses') }}" class="block py-2 px-2 text-sm text-gray-600 hover:text-green-600 {{ request()->routeIs('student.courses') ? 'text-green-600 bg-green-100 font-semibold' : '' }}">Courses List</a>
                    </div>
                </div>

                <!-- Dropdown 2: Quizzes -->
                <div>
                    <button onclick="toggleDropdown('quizzes-dropdown')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-clipboard-list"></i>
                            <span class="font-medium">Quizzes</span>
                        </div>
                        <i id="quizzes-dropdown-icon" class="fas fa-chevron-down text-sm transition-transform"></i>
                    </button>
                    <div id="quizzes-dropdown" class="hidden pl-10 mt-1 space-y-1">
                        <a href="{{ route('student.myQuizzes') }}" class="block py-2 text-sm text-gray-600 hover:text-green-600">My Quizzes</a>
                    </div>
                </div>

                <!-- Dropdown 3: Results -->
                <div>
                    <button onclick="toggleDropdown('results-dropdown')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-chart-bar"></i>
                            <span class="font-medium">Results</span>
                        </div>
                        <i id="results-dropdown-icon" class="fas fa-chevron-down text-sm transition-transform"></i>
                    </button>
                    <div id="results-dropdown" class="hidden pl-10 mt-1 space-y-1">
                        <a href="#" class="block py-2 text-sm text-gray-600 hover:text-green-600">Quiz Results</a>
                        <a href="#" class="block py-2 text-sm text-gray-600 hover:text-green-600">Mid Terms</a>
                        <a href="#" class="block py-2 text-sm text-gray-600 hover:text-green-600">Final Grades</a>
                    </div>
                </div>

                <!-- Other Menu Items -->
                <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="font-medium">Schedule</span>
                </a>
                
                <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                    <i class="fas fa-file-alt"></i>
                    <span class="font-medium">Assignments</span>
                </a>
                
                <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 text-gray-700">
                    <i class="fas fa-cog"></i>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>
        </div>
    </aside>
