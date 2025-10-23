<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title> @yield('page-title') | Institute Portal Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800;900&display=swap" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>
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

<body class="bg-gray-50">
    {{-- <div class="w-65 h-[100vh] fixed top-0 left-0 flex flex-col shadow-sidebar overflow-y-auto text-white"> --}}
    <!-- Sidebar -->
    {{-- <aside class="bg-[#1e1f1e] w-[18.3vw] h-[90vh] fixed top-0 left-0 flex flex-col shadow-sidebar overflow-y-auto"> --}}
    <aside class="bg-[#1e1f1e] h-[90vh] fixed top-0 left-0 flex flex-col shadow-sidebar overflow-y-auto text-white w-[19.1vw] max-w-[19.1vw] min-w-[19.1vw]
">
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

                <!-- Institute Dropdown -->
                <li>
                    <button onclick="toggleDropdown('management-dropdown')"
                        class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                        <a href="" class="text-[18px]">Institutes</a>
                        <i id="management-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                    </button>
                    <ul id="management-dropdown"
                        class="ml-4 mt-1 space-y-1 {{ request()->routeIs('institute.*') || request()->routeIs('admin.*') || request()->routeIs('viewAdmins') ? '' : 'hidden' }} ? '' : 'hidden'  }} ">

                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm active:bg-[#2d2e2d] 
                                {{ request()->routeIs('institute.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('institute.create') }}" class="block">Add Institute</a>
                        </li>

                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm active:bg-[#2d2e2d] 
                                {{ request()->routeIs('admin.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('admin.create') }}" class="block">Add Admin</a>
                        </li>
                    </ul>
                </li>


                <!-- Visitors Dropdown -->
                <li>
                    <button onclick="toggleDropdown('fee-dropdown')"
                        class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                        <span class="text-[18px]">Certificates</span>
                        <i id="fee-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                    </button>
                    <ul id="fee-dropdown" class="ml-4 mt-1 space-y-1 hidden">
                        <li class="p-2 hover:bg-[#2d2e2d] rounded text-sm">
                            <a href="" class="block">Certificate for
                                Approval</a>
                        </li>
                    </ul>
                </li>

                
                <button onclick="toggleDropdown('subject-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Diploma</a>
                    <i id="subject-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="subject-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('diploma.*') || request()->routeIs('diplomawiseCourse.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('diploma.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('diploma.create') }}" class="block">Add Diploma</a>
                    </li>
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('diplomawiseCourse.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('diplomawiseCourse.create') }}" class="block">Assign Courses</a>
                    </li>
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('diploma.assignedCourses') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('diploma.assignedCourses') }}" class="block">Assigned Courses</a>
                    </li>
                </ul>

                <button onclick="toggleDropdown('courses-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Courses</a>
                    <i id="courses-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="courses-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('course.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('course.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('course.create') }}" class="block">Add Courses</a>
                    </li>
                    {{-- <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('course.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('course.index') }}">View Courses</a>
                        </li> --}}
                </ul>


                <button onclick="toggleDropdown('semester-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Semester</a>
                    <i id="semester-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="semester-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('semester.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('semester.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('semester.create') }}" class="block">Add Semester</a>
                    </li>
                </ul>

                {{-- SESSION --}}
                <button onclick="toggleDropdown('session-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Session</a>
                    <i id="session-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="session-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('session.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('session.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('session.create') }}" class="block">Add Session</a>
                    </li>
                    {{-- <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('session.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('session.index') }}">View Sessions</a>
                        </li> --}}
                </ul>

                {{-- EXAMINATION CRITERIA --}}
                <button onclick="toggleDropdown('examination-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Examintation</a>
                    <i id="examination-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="examination-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('examination-criteria.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('examination-criteria.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('examination-criteria.create') }}" class="block">Examination Marks</a>
                    </li>
                    {{-- <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('session.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('session.index') }}">View Sessions</a>
                        </li> --}}
                </ul>

                <button onclick="('student-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Student</a>
                    <i id="student-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="student-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('student.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('student.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('student.index') }}" class="block">Registered Students</a>
                    </li>
                </ul>

                <button onclick="toggleDropdown('result-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Result</a>
                    <i id="result-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="result-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('result.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('result.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('result.create') }}" class="block">Add result Status</a>
                    </li>
                </ul>

                {{-- <button onclick="toggleDropdown('grade-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Grade</a>
                    <i id="grade-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="grade-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('grade.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('grade.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('grade.create') }}" class="block">Add grade</a>
                    </li>
                </ul> --}}

                {{-- <button onclick="toggleDropdown('marks-dropdown')"
                    class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                    <a href="" class="text-[18px]">Marks</a>
                    <i id="marks-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                </button>
                <ul id="marks-dropdown"
                    class="ml-4 mt-1 space-y-1 {{ request()->routeIs('marks.*') ? '' : 'hidden' }}">
                    <li
                        class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('marks.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                        <a href="{{ route('marks.create') }}" class="block">Add Marks</a>
                    </li>
                </ul> --}}





                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-white" type="submit" class="text-[18px]">Logout</button>

                    </form>
                </li>
            </ul>
        </div>
        <div class="p-4 border-t border-[#6e6d6d] mt-4 bottom-0 bg-[#1e1f1e] w-[18.1vw] min-w-[18.1vw] fixed">
            <div class="flex items-center space-x-3">
                <img class="h-9 w-9 rounded-full object-cover border-2 border-quiz-accent"
                    src="https://randomuser.me/api/portraits/men/1.jpg" alt="User" />
                <div>
                    <p class="text-sm font-medium text-white">
                        {{ $user = Auth::guard('super_admin')->user()->name ?? Auth::guard('admin')->user()->name }}
                    </p>
                    <p class="text-xs text-quiz-accent">
                        {{ $user = Auth::guard('super_admin')->user()->email ?? Auth::guard('admin')->user()->email }}
                    </p>
                </div>
            </div>
        </div>
    </aside>
    </div>


    @yield('main-content')

    <style>
        .transition-transform {
            transition: transform 0.2s ease-in-out;
        }

        .rotate-180 {
            transform: rotate(360deg);
        }
    </style>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script> --}}
</body>

</html>
