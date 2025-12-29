<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CourseEdx</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="bg-slate-50 text-gray-800">
    <!-- ================= NAVBAR ================= -->
    <!-- ================= TOP ICON BAR ================= -->
    <div class="bg-teal-600 text-white">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-2 text-sm">
            <!-- Left Menu Icons -->
            <div class="flex items-center gap-6">
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-house text-lg"></i>
                    Home
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-blog text-lg"></i>
                    Blogs
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-building-columns text-lg"></i>
                    Institutions
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-file-lines text-lg"></i>
                    Past Papers
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-book-open text-lg"></i>
                    Courses
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-user-graduate text-lg"></i>
                    Admissions
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-video text-lg"></i>
                    Lectures
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-clipboard-list text-lg"></i>
                    Online Test
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-calendar-days text-lg"></i>
                    Date Sheets
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    Verification
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-briefcase text-lg"></i>
                    Jobs
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-chalkboard-user text-lg"></i>
                    Tutor
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-earth-asia text-lg"></i>
                    Study Abroad
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-book text-lg"></i>
                    Books
                </a>
                <a class="flex flex-col items-center text-md cursor-pointer">
                    <i class="fa-solid fa-download text-lg"></i>
                    Software
                </a>
            </div>
        </div>
    </div>

    <!-- ================= MAIN NAVBAR ================= -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto flex items-center gap-6 px-4 py-4">
            <!-- Logo -->
            <div class="flex items-center text-2xl font-bold">
                <span class="text-blue-900">Course</span>
                <span class="text-pink-600 text-sm ml-1">edx</span>
            </div>

            <!-- Search -->
            <div class="flex-1 relative">
                <input type="text" placeholder="Search Courses"
                    class="w-full border rounded-full px-5 py-2 pl-12 focus:outline-none" />
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <!-- Right Links -->
            <div class="flex items-center gap-6 text-sm font-medium">
                <div class="flex items-center gap-1 cursor-pointer">
                    Categories
                    <i class="fa-solid fa-caret-down text-xs"></i>
                </div>

                <span>CourseEdx Business</span>
                @if (auth('super_admin')->check())
                    <!-- Super Admin Navbar -->
                    <span class="font-semibold">Super Admin Panel</span>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <!-- Trigger -->
                        <button id="profileBtn" class="flex items-center gap-2 focus:outline-none">
                            <img src="{{ auth()->user()->photo ?? asset('images/logo.png') }}"
                                class="w-9 h-9 rounded-full object-cover" />
                            <i class="fa-solid fa-chevron-down text-xs text-gray-600"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg overflow-hidden z-50">
                            <a href="{{ route('superAdmin.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Dashboard</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-user mr-2"></i> Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-gear mr-2"></i> Settings
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-book mr-2"></i> My Courses
                            </a>
                            <hr />
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @elseif(auth('admin')->check())
                    <!-- Admin Navbar -->
                    <span class="font-semibold">Admin Panel</span>
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <!-- Trigger -->
                        <button id="profileBtn" class="flex items-center gap-2 focus:outline-none">
                            <img src="{{ auth()->user()->photo ?? asset('images/logo.png') }}"
                                class="w-9 h-9 rounded-full object-cover" />
                            <i class="fa-solid fa-chevron-down text-xs text-gray-600"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg overflow-hidden z-50">
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Dashboard</a>

                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-user mr-2"></i> Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-gear mr-2"></i> Settings
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-book mr-2"></i> My Courses
                            </a>
                            <hr />
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @elseif(auth('student')->check())
                    <!-- Student Navbar -->
                    <span>Teach on CourseEdx</span>

                    <div class="relative cursor-pointer">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="absolute -top-2 -right-2 bg-black text-white text-xs rounded-full px-1">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <!-- Trigger -->
                        <button id="profileBtn" class="flex items-center gap-2 focus:outline-none">
                            <img src="{{ auth()->user()->photo ?? asset('images/logo.png') }}"
                                class="w-9 h-9 rounded-full object-cover" />
                            <i class="fa-solid fa-chevron-down text-xs text-gray-600"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg overflow-hidden z-50">
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-user mr-2"></i> Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-gear mr-2"></i> Settings
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-book mr-2"></i> My Courses
                            </a>
                            <hr />
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest -->
                    <a href="{{ route('login') }}" class="hover:text-teal-600">Login</a>
                    <a href="{{ route('register') }}" class="bg-teal-600 text-white px-4 py-2 rounded-full">Sign
                        Up</a>
                @endif

            </div>
        </div>
    </div>

    <!-- ================= HERO CAROUSEL ================= -->
    <section>
        <div class="swiper heroSwiper h-[75vh]">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644"
                        class="absolute inset-0 w-full h-full object-cover" />

                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>

                    <div class="relative max-w-7xl mx-auto h-full flex items-center px-6">
                        <div class="text-white max-w-xl">
                            <h1 class="text-5xl font-extrabold leading-tight">
                                Better Learning<br />
                                <span class="text-teal-400">Future Starts</span> Here
                            </h1>
                            <p class="mt-4 text-gray-200">
                                Learn from top instructors with industry-ready courses.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3"
                        class="absolute inset-0 w-full h-full object-cover" />

                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>

                    <div class="relative max-w-7xl mx-auto h-full flex items-center px-6">
                        <div class="text-white max-w-xl">
                            <h1 class="text-5xl font-extrabold">
                                4500+ Online<br />
                                <span class="text-teal-400">Professional Courses</span>
                            </h1>
                            <p class="mt-4 text-gray-200">
                                Upskill yourself anytime, anywhere.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1507537297725-24a1c029d3ca"
                        class="absolute inset-0 w-full h-full object-cover" />

                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>

                    <div class="relative max-w-7xl mx-auto h-full flex items-center px-6">
                        <div class="text-white max-w-xl">
                            <h1 class="text-5xl font-extrabold">
                                Build Your<br />
                                <span class="text-teal-400">Dream Career</span>
                            </h1>
                            <p class="mt-4 text-gray-200">
                                Certification & job-ready skills.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
        </div>
    </section>

    <!-- ================= STATS ================= -->
    <section class="-mt-24 relative z-10">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-6 px-6">
            <div class="bg-white/70 backdrop-blur rounded-xl shadow-lg p-6 flex items-center gap-4">
                <i class="fa-solid fa-users text-3xl text-teal-600"></i>
                <div>
                    <h3 class="text-xl font-bold">35,000+</h3>
                    <p class="text-gray-500 text-sm">Active Students</p>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur rounded-xl shadow-lg p-6 flex items-center gap-4">
                <i class="fa-solid fa-laptop-code text-3xl text-teal-600"></i>
                <div>
                    <h3 class="text-xl font-bold">4,500+</h3>
                    <p class="text-gray-500 text-sm">Online Courses</p>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur rounded-xl shadow-lg p-6 flex items-center gap-4">
                <i class="fa-solid fa-award text-3xl text-teal-600"></i>
                <div>
                    <h3 class="text-xl font-bold">Certified</h3>
                    <p class="text-gray-500 text-sm">Trusted Platform</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= COURSES SECTION ================= -->
    <!-- ================= COURSES SECTION ================= -->
    <section class="mt-24 py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Heading -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Popular Courses</h2>
                <a class="text-teal-600 font-medium cursor-pointer"> View All → </a>
            </div>

            <!-- Cards -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c"
                        class="h-40 w-full object-cover" />
                    <div class="p-4 flex flex-col flex-grow">
                        <span class="text-xs bg-teal-100 text-teal-700 px-2 py-1 rounded inline-block">
                            Development
                        </span>
                        <h3 class="mt-3 font-semibold text-gray-800">
                            Web Development Bootcamp
                        </h3>
                        <p class="text-sm text-gray-500 mt-1 flex-grow">
                            Learn HTML, CSS, JS & React
                        </p>

                        <button
                            class="mt-4 w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-md font-semibold transition">
                            View Course
                        </button>

                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold text-teal-600">$49</span>
                            <span class="text-sm text-gray-400"> ⭐ 4.8 </span>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                    <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786"
                        class="h-40 w-full object-cover" />
                    <div class="p-4 flex flex-col flex-grow">
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded inline-block">
                            Business
                        </span>
                        <h3 class="mt-3 font-semibold text-gray-800">
                            Digital Marketing Mastery
                        </h3>
                        <p class="text-sm text-gray-500 mt-1 flex-grow">
                            SEO, Ads & Branding
                        </p>

                        <button
                            class="mt-4 w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-md font-semibold transition">
                            View Course
                        </button>

                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold text-teal-600">$39</span>
                            <span class="text-sm text-gray-400"> ⭐ 4.7 </span>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                        class="h-40 w-full object-cover" />
                    <div class="p-4 flex flex-col flex-grow">
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded inline-block">
                            Design
                        </span>
                        <h3 class="mt-3 font-semibold text-gray-800">UI / UX Design</h3>
                        <p class="text-sm text-gray-500 mt-1 flex-grow">
                            Figma & Prototyping
                        </p>

                        <button
                            class="mt-4 w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-md font-semibold transition">
                            View Course
                        </button>

                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold text-teal-600">$29</span>
                            <span class="text-sm text-gray-400"> ⭐ 4.9 </span>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d"
                        class="h-40 w-full object-cover" />
                    <div class="p-4 flex flex-col flex-grow">
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded inline-block">
                            Data
                        </span>
                        <h3 class="mt-3 font-semibold text-gray-800">
                            Data Science & Python
                        </h3>
                        <p class="text-sm text-gray-500 mt-1 flex-grow">ML & Analytics</p>

                        <button
                            class="mt-4 w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-md font-semibold transition">
                            View Course
                        </button>

                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold text-teal-600">$59</span>
                            <span class="text-sm text-gray-400"> ⭐ 4.8 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-slate-900 text-gray-300 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-4 gap-10">
            <!-- Brand -->
            <div>
                <h3 class="text-2xl font-bold text-white">
                    Course<span class="text-teal-400">Edx</span>
                </h3>
                <p class="text-sm mt-4 text-gray-400">
                    Your success story begins here. Learn, grow, and build your future
                    with industry-ready courses.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-semibold text-white mb-4">Explore</h4>
                <ul class="space-y-2 text-sm">
                    <li>Courses</li>
                    <li>Institutions</li>
                    <li>Admissions</li>
                    <li>Jobs</li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-white mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li>About Us</li>
                    <li>Contact</li>
                    <li>Privacy Policy</li>
                    <li>Terms</li>
                </ul>
            </div>

            <!-- Social -->
            <div>
                <h4 class="font-semibold text-white mb-4">Follow Us</h4>
                <div class="flex gap-4 text-lg">
                    <i class="fa-brands fa-facebook cursor-pointer"></i>
                    <i class="fa-brands fa-twitter cursor-pointer"></i>
                    <i class="fa-brands fa-linkedin cursor-pointer"></i>
                    <i class="fa-brands fa-instagram cursor-pointer"></i>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 text-center py-4 text-sm text-gray-400">
            © 2025 CourseEdx. All rights reserved.
        </div>
    </footer>

    <!-- ================= SWIPER JS ================= -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".heroSwiper", {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        const profileBtn = document.getElementById("profileBtn");
        const dropdown = document.getElementById("profileDropdown");

        profileBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdown.classList.toggle("hidden");
        });

        document.addEventListener("click", () => {
            dropdown.classList.add("hidden");
        });
    </script>
</body>

</html>
