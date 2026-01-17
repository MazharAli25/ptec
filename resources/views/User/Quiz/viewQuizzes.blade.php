@extends('layouts.user')

@section('page-title', 'Quizzes')

@section('main-content')

    <!-- ================= QUIZZES HEADER ================= -->
    <section class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <h1 class="text-4xl font-bold text-gray-800">Quizzes</h1>
            <p class="text-gray-600 mt-2">
                Test your knowledge and track your progress
            </p>
        </div>
    </section>

    <!-- ================= QUIZZES LIST ================= -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Filters -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
                <div class="flex gap-3">
                    <button class="px-4 py-2 rounded-full bg-teal-600 text-white text-sm">
                        All
                    </button>
                    <button class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                        Beginner
                    </button>
                    <button class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                        Intermediate
                    </button>
                    <button class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                        Advanced
                    </button>
                </div>

                <input type="text" placeholder="Search quizzes..."
                    class="border rounded-full px-5 py-2 text-sm focus:outline-none" />
            </div>

            <!-- Quiz Cards -->
            <!-- Quiz Card -->
            @if ($quizzes->isEmpty())
                <div class="w-[100%] flex items-center justify-center">
                    <span class="text-[18px] text-gray-700 block text-center">No Quiz Found</span>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($quizzes as $quiz)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                            <div class="p-6">
                                <span class="inline-block text-xs px-3 py-1 rounded bg-green-100 text-green-700">
                                    Beginner
                                </span>

                                <h3 class="text-xl font-semibold mt-4">
                                    {{ $quiz->quizName }}
                                </h3>

                                <p class="text-sm text-gray-600 mt-2">
                                    {{ \Illuminate\Support\Str::limit($quiz->description ? $quiz->description : '-', 50) }}
                                </p>

                                <div class="flex justify-between items-center mt-6 text-sm text-gray-500">
                                    <span>15 Questions</span>
                                    <span><i class="fa-regular fa-clock"></i> 20 Minutes</span>
                                </div>

                                <a href="#"
                                    class="block text-center mt-6 bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-semibold transition">
                                    Start Quiz
                                </a>
                            </div>
                        </div>
                    @endforeach

                    <!-- Quiz Card -->
                    {{-- <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <div class="p-6">
                    <span class="inline-block text-xs px-3 py-1 rounded bg-yellow-100 text-yellow-700">
                        Intermediate
                    </span>

                    <h3 class="text-xl font-semibold mt-4">
                        Laravel Routing Quiz
                    </h3>
                    
                    <p class="text-sm text-gray-600 mt-2">
                        Challenge yourself with Laravel routing concepts.
                    </p>

                    <div class="flex justify-between items-center mt-6 text-sm text-gray-500">
                        <span>🕒 20 Questions</span>
                        <span>⏱ 30 Minutes</span>
                    </div>
                    
                    <a href="#"
                        class="block text-center mt-6 bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-semibold transition">
                        Start Quiz
                    </a>
                </div>
            </div> --}}

            @endif
        </div>
        </div>
    </section>

@endsection
