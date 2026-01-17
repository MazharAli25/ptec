@extends('layouts.student')
@section('title', 'My Quizzes')
@section('main-content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($quizzes as $quiz)
            <div
                class="bg-white w-[20vw] rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">

                <!-- Content -->
                <div class="p-3 space-y-3">

                    <!-- Quiz Title -->
                    <h3 class="text-lg font-semibold text-gray-800 leading-tight">
                        {{ ucwords($quiz->quiz->quizName) }}
                    </h3>

                    <!-- Description -->
                    <p class="text-sm text-gray-500">
                        {!! \Illuminate\Support\Str::limit($quiz->quiz->description, 50, '...'.' <b>see more</b>') !!}
                    </p>

                    <!-- Status -->
                    <span class="inline-block text-xs font-medium px-3 py-1 rounded-full bg-green-100 text-green-700">
                        In Progress
                    </span>

                    <div class="flex items-center justify-center">
                        <a href="" class="bg-green-600 text-white text-[14px] px-4 py-1 rounded">
                            Attend quiz
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

@endsection