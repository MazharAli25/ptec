@extends('layouts.user')
@section('page-title', 'Home')

@section('main-content')

    
    <!-- ================= HERO CAROUSEL ================= -->
    <section>

        <div class="swiper heroSwiper h-[75vh]">
            @if (empty($slider))
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
            @else
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide relative">
                        <img src="{{ asset('carousel_images/' . $slider->image1) }}"
                            class="absolute inset-0 w-full h-full object-cover" />

                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>

                        {{-- <div class="relative max-w-7xl mx-auto h-full flex items-center px-6">
                        <div class="text-white max-w-xl">
                            <h1 class="text-5xl font-extrabold leading-tight">
                                Better Learning<br />
                                <span class="text-teal-400">Future Starts</span> Here
                            </h1>
                            <p class="mt-4 text-gray-200">
                                Learn from top instructors with industry-ready courses.
                            </p>
                        </div>
                    </div> --}}
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide relative">
                        <img src="{{ asset('carousel_images/' . $slider->image2) }}"
                            class="absolute inset-0 w-full h-full object-cover" />

                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>

                        {{-- <div class="relative max-w-7xl mx-auto h-full flex items-center px-6">
                        <div class="text-white max-w-xl">
                            <h1 class="text-5xl font-extrabold">
                                4500+ Online<br />
                                <span class="text-teal-400">Professional Courses</span>
                            </h1>
                            <p class="mt-4 text-gray-200">
                                Upskill yourself anytime, anywhere.
                            </p>
                        </div>
                    </div> --}}
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide relative">
                        <img src="{{ asset('carousel_images/' . $slider->image3) }}"
                            class="absolute inset-0 w-full h-full object-cover" />

                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>

                        {{-- <div class="relative max-w-7xl mx-auto h-full flex items-center px-6">
                        <div class="text-white max-w-xl">
                            <h1 class="text-5xl font-extrabold">
                                Build Your<br />
                                <span class="text-teal-400">Dream Career</span>
                            </h1>
                            <p class="mt-4 text-gray-200">
                                Certification & job-ready skills.
                            </p>
                        </div>
                    </div> --}}
                    </div>
                </div>
            @endif
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
                @foreach ($courses as $course)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        <img src="{{ asset('storage/photos/' . $course->courseThumbnail) }}"
                            class="h-40 w-full object-cover" />
                        <div class="p-4 flex flex-col flex-grow">
                            <span
                                class="text-xs px-2 py-1 rounded inline-block
                                @if ($course->courseLevel === 'Beginner') bg-green-100 text-green-700
                                @elseif($course->courseLevel === 'Intermediate')
                                    bg-yellow-100 text-yellow-700
                                @elseif($course->courseLevel === 'Advanced')
                                    bg-red-100 text-red-700
                                @else
                                    bg-gray-100 text-gray-700 
                                @endif
                            ">
                                {{ $course->courseLevel }}
                            </span>
                            <h3 class="mt-3 font-semibold text-gray-800">
                                {{ $course->courseName }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 flex-grow">
                                {{ \Illuminate\Support\Str::limit($course->description ? $course->description : '-', 50) }}
                            </p>

                            <a href="{{ route('userViewCourse', encrypt($course->id)) }}"
                                class="mt-4 text-center w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-md font-semibold transition">
                                View Course
                            </a>

                            <div class="flex justify-between items-center mt-4">
                                <span class="font-bold text-teal-600">{{ $course->courseFees }}</span>
                                <span class="text-sm text-gray-400"> ⭐ 4.8 </span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Card -->
                {{-- <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
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
                </div> --}}

                <!-- Card -->
                {{-- <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
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
                </div> --}}

                <!-- Card -->
                {{-- <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
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
                    </div> --}}
            </div>
        </div>
        </div>
    </section>
@endsection
