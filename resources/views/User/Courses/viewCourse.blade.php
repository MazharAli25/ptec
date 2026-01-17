@extends('layouts.user') {{-- or your main layout --}}

@section('main-content')
    <!-- ================= COURSEL HERO ================= -->
    <section class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-6 py-10 grid lg:grid-cols-2 gap-10">
            <!-- Left -->
            <div>
                <span
                    class="inline-block text-xs px-3 py-1 rounded
                @if ($course->courseLevel === 'Beginner') bg-green-100 text-green-700
                @elseif($course->courseLevel === 'Intermediate') bg-yellow-100 text-yellow-700
                @elseif($course->courseLevel === 'Advanced') bg-red-100 text-red-700
                @else bg-gray-100 text-gray-700 @endif">
                    {{ $course->courseLevel }}
                </span>

                <h1 class="text-4xl font-bold text-gray-800 mt-4">
                    {{ $course->courseName }}
                </h1>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    {{ $course->description ?? 'No description available.' }}
                </p>

                <div class="flex items-center gap-6 mt-6">
                    <span class="text-3xl font-bold text-teal-600">
                        {{ $course->currency ?? 'PKR' }} {{ $course->courseFees }}
                    </span>

                    <span class="text-sm text-gray-500">
                        ⭐ 4.8 (1,245 reviews)
                    </span>
                </div>

                <div class="flex gap-4 mt-8">
                    <button class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        Enroll Now
                    </button>

                    <button
                        class="border border-teal-600 text-teal-600 hover:bg-teal-50 px-6 py-3 rounded-lg font-semibold transition">
                        Add to Wishlist
                    </button>
                </div>
            </div>

            <!-- Right -->
            <div class="relative">
                <img src="{{ asset('storage/photos/' . $course->courseThumbnail) }}"
                    class="rounded-xl shadow-lg w-full h-[360px] object-cover" />

                <div
                    class="absolute bottom-4 right-4 bg-white shadow px-4 py-2 rounded-lg text-sm font-semibold text-gray-700">
                    ⏱ Duration: {{ $course->duration ?? 'Self-paced' }}
                </div>
            </div>
        </div>
    </section>

    <!-- ================= COURSE CONTENT ================= -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-3 gap-8">

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- What You'll Learn -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-2xl font-bold mb-4">What you'll learn</h2>
                    <ul class="grid sm:grid-cols-2 gap-3 text-gray-600 text-sm">
                        <li><i class="fa-solid fa-arrow-right"></i> Core fundamentals</li>
                        <li><i class="fa-solid fa-arrow-right"></i> Real-world projects</li>
                        <li><i class="fa-solid fa-arrow-right"></i> Industry best practices</li>
                        <li><i class="fa-solid fa-arrow-right"></i> Hands-on exercises</li>
                    </ul>
                </div>

                <!-- Course Description -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-2xl font-bold mb-4">Course Description</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $course->description ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Instructor -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-2xl font-bold mb-4">Instructor</h2>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/logo.png') }}" class="w-14 h-14 rounded-full object-cover" />
                        <div>
                            <h4 class="font-semibold text-gray-800">John Doe</h4>
                            <p class="text-sm text-gray-500">
                                Senior Instructor • 10+ years experience
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Course Info -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-semibold text-lg mb-4">Course Details</h3>
                    <ul class="text-sm text-gray-600 space-y-2">
                        <li>Level: {{ $course->courseLevel }}</li>
                        <li>Students: 1,200+</li>
                        <li>Category: Programming</li>
                        <li>Access: Lifetime</li>
                    </ul>
                </div>

                <!-- Call To Action -->
                <div class="bg-teal-600 text-white rounded-xl p-6 text-center">
                    <h3 class="text-xl font-bold">Ready to start learning?</h3>
                    <p class="text-sm mt-2 text-teal-100">
                        Enroll today and boost your skills
                    </p>
                    <button
                        class="mt-4 bg-white text-teal-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Enroll Now
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
