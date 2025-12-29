@extends('layouts.student')
@section('page-title', 'Student Dashboard')
@section('main-content')

        <x-student-head/>
        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="dashboard-card bg-white rounded-xl p-6 form-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Active Courses</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-2">6</h3>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                        <i class="fas fa-book text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="dashboard-card bg-white rounded-xl p-6 form-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Pending Quizzes</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-2">3</h3>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-amber-600 text-xl"></i>
                    </div>
                </div>
                {{-- <p class="text-red-600 text-sm mt-4">
                    <i class="fas fa-clock mr-1"></i> 1 due tomorrow
                </p> --}}
            </div>

            <div class="dashboard-card bg-white rounded-xl p-6 form-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Average Score</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-2">84%</h3>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                        {{-- <span>Progress</span>
                        <span>84%</span> --}}
                    </div>
                    {{-- <div class="progress-bar bg-gray-200">
                        <div class="bg-green-500 h-full" style="width: 84%"></div>
                    </div> --}}
                </div>
            </div>

            <div class="dashboard-card bg-white rounded-xl p-6 form-shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Attendance</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-2">92%</h3>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-purple-600 text-xl"></i>
                    </div>
                </div>
                {{-- <p class="text-gray-600 text-sm mt-4">
                    <i class="fas fa-check-circle mr-1 text-green-500"></i> Good standing
                </p> --}}
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Upcoming Quizzes & Results -->
            <div class="lg:col-span-2">
                <!-- Upcoming Quizzes Card -->
                {{-- <div class="bg-white rounded-xl form-shadow p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Upcoming Quizzes</h2>
                        <a href="#" class="text-green-600 hover:text-green-700 text-sm font-medium">View All</a>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Quiz Item 1 -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-clipboard-check text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Web Development Quiz</h4>
                                    <p class="text-sm text-gray-600">CIT-101 • Due: Tomorrow, 10:00 AM</p>
                                </div>
                            </div>
                            <div>
                                <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-semibold rounded-full">Pending</span>
                            </div>
                        </div>

                        <!-- Quiz Item 2 -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-database text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Database Management</h4>
                                    <p class="text-sm text-gray-600">CIT-102 • Due: Nov 25, 2:00 PM</p>
                                </div>
                            </div>
                            <div>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Available</span>
                            </div>
                        </div>

                        <!-- Quiz Item 3 -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-network-wired text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Networking Basics</h4>
                                    <p class="text-sm text-gray-600">CIT-103 • Due: Nov 28, 11:00 AM</p>
                                </div>
                            </div>
                            <div>
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">Upcoming</span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Recent Results Card -->
                {{-- <div class="bg-white rounded-xl form-shadow p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Recent Results</h2>
                        <a href="#" class="text-green-600 hover:text-green-700 text-sm font-medium">View All</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quiz Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Course</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Score</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">Programming Fundamentals</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">CIT-101</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">Nov 10, 2024</td>
                                    <td class="px-4 py-4 text-sm font-semibold text-green-600">92%</td>
                                    <td class="px-4 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Excellent</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">Web Design</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">CIT-102</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">Nov 5, 2024</td>
                                    <td class="px-4 py-4 text-sm font-semibold text-blue-600">85%</td>
                                    <td class="px-4 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Good</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">Database Quiz</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">CIT-103</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">Oct 28, 2024</td>
                                    <td class="px-4 py-4 text-sm font-semibold text-amber-600">78%</td>
                                    <td class="px-4 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Average</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            {{-- </div> --}}

            <!-- Right Column: Course Progress & Announcements -->
            {{-- <div> --}}
                <!-- Current Courses Card -->
                {{--<div class="bg-white rounded-xl form-shadow p-6 mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Current Courses</h2>
                    
                    <div class="space-y-6">
                        <!-- Course 1 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <h4 class="font-semibold text-gray-800">CIT-101: Web Development</h4>
                                <span class="text-sm font-semibold text-green-600">75%</span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="bg-green-500 h-full" style="width: 75%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Instructor: Dr. Smith • Next class: Tomorrow</p>
                        </div>

                        <!-- Course 2 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <h4 class="font-semibold text-gray-800">CIT-102: Database Management</h4>
                                <span class="text-sm font-semibold text-blue-600">60%</span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="bg-blue-500 h-full" style="width: 60%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Instructor: Prof. Johnson • Next class: Nov 25</p>
                        </div>

                        <!-- Course 3 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <h4 class="font-semibold text-gray-800">CIT-103: Networking</h4>
                                <span class="text-sm font-semibold text-purple-600">90%</span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="bg-purple-500 h-full" style="width: 90%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Instructor: Dr. Williams • Next class: Nov 26</p>
                        </div>
                    </div>
                    
                    <a href="#" class="block text-center mt-6 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-50 font-medium">
                        View All Courses
                    </a>
                </div>

                <!-- Announcements Card -->
                <div class="bg-white rounded-xl form-shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Announcements</h2>
                    
                    <div class="space-y-5">
                        <!-- Announcement 1 -->
                        <div class="pb-4 border-b border-gray-100">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-bullhorn text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Mid-Term Schedule</h4>
                                    <p class="text-xs text-gray-600 mt-1">Mid-term exams will begin from December 1st. Check your schedule.</p>
                                    <p class="text-xs text-gray-500 mt-2">2 hours ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Announcement 2 -->
                        <div class="pb-4 border-b border-gray-100">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Holiday Notice</h4>
                                    <p class="text-xs text-gray-600 mt-1">College will remain closed on November 28th for Thanksgiving.</p>
                                    <p class="text-xs text-gray-500 mt-2">1 day ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Announcement 3 -->
                        <div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-trophy text-amber-600 text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Quiz Competition</h4>
                                    <p class="text-xs text-gray-600 mt-1">Annual quiz competition registrations are open. Win exciting prizes!</p>
                                    <p class="text-xs text-gray-500 mt-2">3 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="block text-center mt-6 py-2 text-gray-600 hover:text-gray-800 font-medium text-sm">
                        Load More Announcements
                    </a>
                </div>

            </div>--}}
        {{-- </div> --}}

        <!-- Bottom Section: Quick Actions -->
        {{-- <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" class="dashboard-card bg-white rounded-lg p-4 form-shadow text-center hover:bg-green-50">
                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-play-circle text-green-600 text-xl"></i>
                    </div>
                    <p class="font-medium text-gray-800">Start Quiz</p>
                </a>
                
                <a href="#" class="dashboard-card bg-white rounded-lg p-4 form-shadow text-center hover:bg-blue-50">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-download text-blue-600 text-xl"></i>
                    </div>
                    <p class="font-medium text-gray-800">Resources</p>
                </a>
                
                <a href="#" class="dashboard-card bg-white rounded-lg p-4 form-shadow text-center hover:bg-purple-50">
                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                    </div>
                    <p class="font-medium text-gray-800">Progress Report</p>
                </a>
                
                <a href="#" class="dashboard-card bg-white rounded-lg p-4 form-shadow text-center hover:bg-amber-50">
                    <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-calendar text-amber-600 text-xl"></i>
                    </div>
                    <p class="font-medium text-gray-800">Schedule</p>
                </a>
            </div> --}}
        </div>
@endsection