@extends('layouts.admin')

@section('page-title', 'View Quiz Details')

@section('main-content')
    <div class="container mx-auto flex justify-center pl-[18vw]">
        <div class="w-full max-w-5xl">

            <!-- Header -->
            <div class="mt-8 text-start">
                <h1 class="text-3xl font-bold text-gray-800">Quiz Details</h1>
                <p class="text-gray-600 mb-6">View quiz details and questions</p>
            </div>

            <!-- Card -->
            <div class="bg-white p-8 shadow rounded-lg">
                <form action="{{ route('question.store') }}" method="POST">
                    @csrf

                    <!-- Select Quiz -->
                    <div class="mb-8">
                        <label class="block text-gray-700 mb-2 font-medium">
                            Quiz Name
                        </label>
                        <input name="quiz_id" readonly value="{{ request()->route('quiz')->quizName }}"
                            class="w-full border rounded py-2 px-4 bg-gray-50 border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500">
                    </div>

                    <!-- Questions Section -->
                    <div class="p-2">
                        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">
                            Quiz Questions
                        </h2>

                        @if ($questions->count() > 0)
                            <div id="questions-container" class="space-y-6">
                                @foreach ($questions as $qIndex => $questionContent)
                                    <div class="question-card p-6 rounded-lg mb-6 shadow-sm border">

                                        <div class="mb-5">
                                            <label class="block mb-2">Question {{ $qIndex + 1 }}</label>
                                            <input type="text" name="questions[${questionCount}][question]"
                                                class="border rounded border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 bg-gray-50 focus:ring-blue-200 py-2 w-full px-4"
                                                placeholder="Enter question text here" readonly
                                                value="{{ $questionContent->question }}">
                                        </div>
                                        @php
                                            $options = $questionContent->options->filter(
                                                fn($opt) => !is_null($opt->options) && trim($opt->options) !== '',
                                            );
                                        @endphp
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                                            @foreach ($options as $oIndex => $option)
                                                <div>
                                                    <label class="block mb-2 text-[16px] text-gray-800">
                                                        Option {{ $oIndex + 1 }}
                                                    </label>

                                                    <input type="text" value="{{ $option->options }}"
                                                        class="border rounded border-gray-300 py-2 w-full px-4 bg-gray-50"
                                                        readonly>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="mb-5">
                                            <label class="block mb-2 font-medium">Correct Answer</label>

                                            @php
                                                $correctOption = $options->firstWhere('is_correct', 1);
                                            @endphp

                                            <input type="text"
                                                value="{{ $correctOption ? $correctOption->options : 'Not set' }}"
                                                class="border rounded py-2 px-4 w-full bg-gray-50" readonly>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white p-8 border rounded-lg">
                                <p class="text-gray-600 text-center">No questions available for this quiz.</p>
                            </div>
                        @endif

                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
