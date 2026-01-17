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
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />a

        {{-- JQUERY CDN --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Add in your Blade layout or at the top of this file -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{-- DATA TABLES CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

    <!--  Buttons extension CSS -->

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script> --}}

    <!--  JSZip and pdfmake (for Excel + PDF export) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-wU5t94ZxYtAYYI/5J/7HSMX1Kxt0Zso5Wltx4pJKmCzB5s70ZMzjWlH2l7/5qEfWcIBsKK5Nf9OStj8UTvU7kw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById(`${id}-icon`);
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
            peshawer
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
    {{-- <div class="max-w-[20vw] min-w-[20vw] fixed"> --}}
    <!-- Sidebar -->
    {{-- <aside class="bg-[#1e1f1e] w-[18.3vw] h-[90vh] fixed top-0 left-0 flex flex-col shadow-sidebar overflow-y-auto"> --}}
    <aside id="sidebar"
        class="aside fixed top-0 left-0 h-screen w-64 bg-[#1e1f1e] text-white md:flex flex-col shadow-md z-50 pb-15 print:hidden overflow-y-scroll">
        <nav class="flex flex-col shadow-sidebar">


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

                    <li class="pl-2 pt-2 text-[16px] block w-full"><a href="{{ route('welcome') }}">Home</a></li>

                    <!-- Institute Dropdown -->
                    <li>
                        <button type="button" onclick="toggleDropdown('institute-dropdown')"
                            class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d]  focus:bg-[#2d2e2d] rounded">
                            Institutes
                            <i id="institute-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                        </button>
                        <ul id="institute-dropdown"
                            class="ml-4 mt-1 space-y-1 {{ request()->routeIs('institute.*') || request()->routeIs('admin.*') || request()->routeIs('viewAdmins') ? '' : 'hidden' }} ? '' : 'hidden'  }} ">

                            <li
                                class="p-2 hover:bg-[#2d2e2d] rounded text-sm active:bg-[#2d2e2d] focus:bg-[#2d2e2d]
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

                    {{-- MANGEMENT --}}
                    <li>
                        <button type="button" onclick="toggleDropdown('management-dropdown')"
                            class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded focus:bg-[#2d2e2d]">
                            Management
                            <i id="management-dropdown-icon"
                                class="fa-solid fa-angle-down transition-transform pb-0"></i>
                        </button>
                        <ul id="management-dropdown"
                            class="ml-4 mt-1 space-y-1 pt-0  {{ request()->routeIs('diploma.*') || request()->routeIs('courses.*') || request()->routeIs('semester.*') || request()->routeIs('session.*') || request()->routeIs('examination-criteria.*') || request()->routeIs('student.*') || request()->routeIs('course.*') || request()->routeIs('diplomawiseCourse.*') ? '' : 'hidden' }}">

                            {{-- SESSION --}}
                            <button type="button" onclick="toggleDropdown('session-dropdown')"
                                class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                                Session
                                <i id="session-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                            </button>
                            <ul id="session-dropdown"
                                class="ml-4 mt-1 space-y-1 {{ request()->routeIs('session.*') ? '' : 'hidden' }}">
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                        {{ request()->routeIs('session.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('session.create') }}" class="block focus:bg-[#2d2e2d]">Add
                                        Session</a>
                                </li>
                                {{-- <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('session.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('session.index') }}">View Sessions</a>
                        </li> --}}
                            </ul>

                            {{-- SEMESTER --}}
                            <button type="button" onclick="toggleDropdown('semester-dropdown')"
                                class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                                Semester
                                <i id="semester-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                            </button>
                            <ul id="semester-dropdown"
                                class="ml-4 mt-1 space-y-1 {{ request()->routeIs('semester.*') ? '' : 'hidden' }}">
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                        {{ request()->routeIs('semester.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('semester.create') }}" class="block focus:bg-[#2d2e2d]">Add
                                        Semester</a>
                                </li>
                            </ul>


                            {{-- COURSES --}}
                            <button type="button" onclick="toggleDropdown('courses-dropdown')"
                                class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                                Subjects
                                <i id="courses-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                            </button>
                            <ul id="courses-dropdown"
                                class="ml-4 mt-1 space-y-1 {{ request()->routeIs('course.*') ? '' : 'hidden' }}">
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                        {{ request()->routeIs('course.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('course.create') }}" class="block focus:bg-[#2d2e2d]">Add
                                        Subjects</a>
                                </li>
                                {{-- <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                        {{ request()->routeIs('course.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('course.index') }}">View Courses</a>
                        </li> --}}
                            </ul>

                            {{-- DIPLOMA --}}
                            <button type="button" onclick="toggleDropdown('subject-dropdown')"
                                class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                                Diploma
                                <i id="subject-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                            </button>
                            <ul id="subject-dropdown"
                                class="ml-4 mt-1 space-y-1 {{ request()->routeIs('diploma.*') || request()->routeIs('diplomawiseCourse.*') ? '' : 'hidden' }}">
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                        {{ request()->routeIs('diploma.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('diploma.create') }}" class="block focus:bg-[#2d2e2d]">Add
                                        Diploma</a>
                                </li>
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                        {{ request()->routeIs('diplomawiseCourse.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('diplomawiseCourse.create') }}"
                                        class="block focus:bg-[#2d2e2d]">Assign
                                        Subjects</a>
                                </li>
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                        {{ request()->routeIs('diploma.assignedCourses') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('diploma.assignedCourses') }}"
                                        class="block focus:bg-[#2d2e2d]">Assigned
                                        Subjects List</a>
                                </li>
                            </ul>


                            {{-- EXAMINATION CRITERIA --}}
                            <button type="button" onclick="toggleDropdown('examination-dropdown')"
                                class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded">
                                Marks
                                <i id="examination-dropdown-icon"
                                    class="fa-solid fa-angle-down transition-transform"></i>
                            </button>
                            <ul id="examination-dropdown"
                                class="ml-4 mt-1 space-y-1 {{ request()->routeIs('examination-criteria.*') ? '' : 'hidden' }}">
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                                {{ request()->routeIs('examination-criteria.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('examination-criteria.create') }}"
                                        class="block focus:bg-[#2d2e2d]">Examination
                                        Marks</a>
                                </li>
                                <li
                                    class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                                {{ request()->routeIs('examination-criteria.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                    <a href="{{ route('examination-criteria.index') }}"
                                        class="block focus:bg-[#2d2e2d]">Examination
                                        Criterias List</a>
                                </li>
                            </ul>
                        </ul>
                    </li>

                    {{-- Quiz --}}
                    <button type="button" onclick="toggleDropdown('quiz-dropdown')"
                        class="w-full flex items-center justify-between p-2  hover:bg-[#2d2e2d] rounded focus:bg-[#2d2e2d]">
                        Quiz
                        <i id="quiz-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                    </button>
                    <ul id="quiz-dropdown"
                        class="ml-4 space-y-1 {{ request()->routeIs('quiz.create') || request()->routeIs('question.create') || request()->routeIs('question.index') ? '' : 'hidden' }}">
                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('quiz.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('quiz.create') }}" class="block focus:bg-[#2d2e2d]">Add Quiz</a>
                        </li>
                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('question.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('question.create') }}" class="block focus:bg-[#2d2e2d]">Add Questions</a>
                        </li>
                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('question.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('question.index') }}" class="block focus:bg-[#2d2e2d]">Questions List</a>
                        </li>
                    </ul>
                    {{-- STUDENT --}}
                    <button type="button" onclick="toggleDropdown('student-dropdown')"
                        class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded focus:bg-[#2d2e2d]">
                        Student
                        <i id="student-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                    </button>
                    <ul id="student-dropdown"
                        class="ml-4 mt-1 space-y-1 {{ request()->routeIs('student.index') ? '' : 'hidden' }}">
                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('student.index') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('student.index') }}" class="block focus:bg-[#2d2e2d]">Registered
                                Students</a>
                        </li>
                    </ul>

                    <!-- Certificate Dropdown -->
                    <li>
                        <button type="button" onclick="toggleDropdown('certificate-dropdown')"
                            class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded focus:bg-[#2d2e2d]">
                            <span class="text-[16px]">Certificates</span>
                            <i id="certificate-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                        </button>
                        <ul id="certificate-dropdown"
                            class="ml-4 mt-1 space-y-1 {{ request()->routeIs('superAdmin.certificatesRequests') || request()->routeIs('superAdmin.printCertificates') || request()->routeIs('superCard.requests') || request()->routeIs('card.printCards') || request()->routeIs('superAdmin.studentsResults') ? '' : 'hidden' }}">
                            <li
                                class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('superAdmin.certificatesRequests') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                <a href="{{ route('superAdmin.certificatesRequests') }}"
                                    class="block focus:bg-[#2d2e2d]">Certificates
                                    for
                                    Approval</a>
                            </li>
                            <li
                                class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('superAdmin.printCertificates') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                <a href="{{ route('superAdmin.printCertificates') }}"
                                    class="block focus:bg-[#2d2e2d]">Print
                                    Certificates</a>
                            </li>
                            <li
                                class="p-2 hover:bg-[#2d2e2d] rounded text-sm 
                              {{ request()->routeIs('superCard.requests') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                <a href="{{ route('superCard.requests') }}" class="block focus:bg-[#2d2e2d]">Student
                                    Cards For Approval</a>
                            </li>
                            <li
                                class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('card.printCards') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                <a href="{{ route('card.printCards') }}" class="block focus:bg-[#2d2e2d]">Print
                                    Student Cards</a>
                            </li>
                            <li
                                class="p-2 hover:bg-[#2d2e2d] rounded text-sm
                              {{ request()->routeIs('superAdmin.studentsResults') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                                <a href="{{ route('superAdmin.studentsResults') }}" class="block focus:bg-[#2d2e2d]">
                                    Students Results</a>
                            </li>
                        </ul>
                    </li>


                    {{-- User Interface --}}
                    <button type="button" onclick="toggleDropdown('user-interface-dropdown')"
                        class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded focus:bg-[#2d2e2d]">
                        User Interface
                        <i id="user-interface-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                    </button>
                    <ul id="user-interface-dropdown"
                        class="ml-4 mt-1 space-y-1 {{ request()->routeIs('carousel.create') ? '' : 'hidden' }}">
                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm focus:bg-[#2d2e2d]
                              {{ request()->routeIs('carousel.create') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('carousel.create') }}"
                                class="block">
                                Carousel Images</a>
                        </li>

                    </ul>
                    {{-- PROFILE --}}
                    <button type="button" onclick="toggleDropdown('profile-dropdown')"
                        class="w-full flex items-center justify-between p-2 hover:bg-[#2d2e2d] rounded focus:bg-[#2d2e2d]">
                        Profile
                        <i id="profile-dropdown-icon" class="fa-solid fa-angle-down transition-transform"></i>
                    </button>
                    <ul id="profile-dropdown"
                        class="ml-4 mt-1 space-y-1 {{ request()->routeIs('superAdmin.edit') ? '' : 'hidden' }}">
                        <li
                            class="p-2 hover:bg-[#2d2e2d] rounded text-sm focus:bg-[#2d2e2d]
                              {{ request()->routeIs('superAdmin.edit') ? 'bg-[#2d2e2d]' : 'hover:bg-[#2d2e2d]' }}">
                            <a href="{{ route('superAdmin.edit', Auth::guard('super_admin')->user()) }}"
                                class="block">
                                Settings</a>
                        </li>
                        <li class="p-2 hover:bg-[#2d2e2d] rounded text-sm focus:bg-[#2d2e2d]">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="w-full text-left text-white">Logout</button>
                            </form>
                        </li>

                    </ul>
                    {{-- <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="w-full text-left text-white">Logout</button>
                        </form>
                    </li> --}}
                </ul>
            </div>
            <div class="p-4 border-t border-[#6e6d6d] mt-4 bottom-0 bg-[#1e1f1e] w-60 fixed">
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
        </nav>
    </aside>
    {{-- </div> --}}

    <x-success />
    <x-err />
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


    {{-- DATA TABLE JS --}}
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


    <script>
        @yield('script')
    </script>
</body>

</html>
