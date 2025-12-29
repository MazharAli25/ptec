@extends('layouts.superAdmin')
@section('page-title', 'Edit Question')

@section('main-content')
<div class="container mx-auto flex justify-center pl-[18vw]">
    <div class="w-full max-w-5xl">

        <!-- Header -->
        <div class="mt-8 text-start">
            <h1 class="text-3xl font-bold text-gray-800">Edit Question</h1>
            <p class="text-gray-600 mb-4">Edit question in your quiz</p>
        </div>

        <!-- Edit Question Form -->
        <div class="card mb-8 bg-white py-8 px-6 shadow rounded-lg">
            <form action="{{ route('question.update', encrypt($question->id)) }}" method="POST" class="mx-auto">
                @csrf
                @method('PUT')

                <!-- Select Quiz -->
                <div class="mb-8 text-start">
                    <label class="block text-gray-700 mb-2 font-medium">Select Quiz</label>
                    <select name="quiz_id"
                        class="block mx-auto w-full max-w-full border rounded py-2 px-4 border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Select Quiz</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" {{ $quiz->id == $question->quiz_id ? 'selected' : '' }}>
                                {{ $quiz->quizName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Question Text -->
                <div class="mb-5">
                    <label class="block mb-2">Question Text</label>
                    <input type="text" name="questions[0][question]"
                        class="border rounded border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 py-2 w-full px-4"
                        value="{{ $question->question }}" placeholder="Enter question text here">
                </div>

                <!-- Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    @php
                        // Ensure there are always 4 options
                        $options = $question->options->toArray();
                        $totalOptions = 4;
                    @endphp
                    @for ($i = 0; $i < $totalOptions; $i++)
                        <div>
                            <label class="block mb-2 text-[16px] text-gray-800">Option {{ $i + 1 }}</label>
                            <input type="text" name="questions[0][options][{{ $i }}]"
                                value="{{ $options[$i]['options'] ?? '' }}"
                                class="border rounded border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 py-2 w-full px-4"
                                placeholder="Enter option text">
                        </div>
                    @endfor
                </div>

                <!-- Correct Answer -->
                <div class="mb-5">
                    <label class="block mb-2">Correct Answer</label>
                    <select name="questions[0][correct_answer]"
                        class="border rounded border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 py-2 px-4 w-full">
                        <option value="">Select</option>
                        @for ($i = 0; $i < $totalOptions; $i++)
                            @php
                                $isCorrect = isset($options[$i]) && $options[$i]['is_correct'];
                            @endphp
                            <option value="{{ $i }}" {{ $isCorrect ? 'selected' : '' }}>Option {{ $i + 1 }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-8">
                    <button type="submit"
                        class="px-6 py-3 mb-6 rounded text-white bg-blue-500 hover:bg-blue-600 font-medium shadow-md transition">
                        Update Question
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
