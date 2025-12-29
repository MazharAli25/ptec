@extends('layouts.superAdmin')
@section('page-title', 'Add Questions')

@section('main-content')
    <div class="container mx-auto flex justify-center pl-[18vw]">
        <div class="w-full max-w-5xl">

            <!-- Header -->
            <div class="mt-8 text-start">
                <h1 class="text-3xl font-bold text-gray-800">Add Questions</h1>
                <p class="text-gray-600 mb-4">Add questions to quizzes</p>
            </div>

            <!-- Add Quiz Section -->
            <div class="card mb-8 bg-white py-8 px-6 shadow rounded-lg">
                <form action="{{ route('question.store') }}" method="POST" class="mx-auto">
                    @csrf

                    <!-- Select Quiz Dropdown -->
                    <div class="mb-8 text-start">
                        <label class="block text-gray-700 mb-2 font-medium">
                            Select Quiz
                        </label>
                        <select name="quiz_id"
                            class="block mx-auto w-full max-w-full border rounded py-2 px-4 border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                            <option value="">Select Quiz</option>
                            @foreach ($quizzes as $quiz)
                                <option value="{{ $quiz->id }}">{{ $quiz->quizName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Questions Section -->
                    <div class="card">
                        <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">
                            Quiz Questions
                        </h2>
                        
                        <div id="questions-container"></div>
                        
                        <div class="text-center mt-8">
                            <button type="button" id="add-question-btn"
                            class="px-6 py-3 mb-6 rounded text-white bg-gray-600 hover:bg-gray-700 font-medium shadow-md transition">
                            Add New Question
                        </button>
                        <div class="text-center flex justify-center">
                            <button type="submit"
                                class="px-6 py-3 mb-6 rounded text-white bg-blue-500 hover:bg-blue-600 font-medium shadow-md transition">
                                Submit
                            </button>
                        </div>
                    </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionsContainer = document.getElementById('questions-container');
            const addQuestionBtn = document.getElementById('add-question-btn');
            let questionCount = 0;

            function addQuestionForm() {
                questionCount++;
                const questionDiv = document.createElement('div');
                questionDiv.className = 'question-card p-6 rounded-lg mb-6 shadow-lg';

                questionDiv.innerHTML = `
                <div class="flex justify-end items-center mb-4">
                    <button type="button" class="text-red-500 remove-question">Remove</button>
                </div>

                <div class="mb-5">
                    <label class="block mb-2">Question ${questionCount}</label>
                    <input type="text"
                        name="questions[${questionCount}][question]" 
                        class="border rounded border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 py-2 w-full px-4" placeholder="Enter question text here">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    ${[1,2,3,4].map(i => `
                                <div>
                                    <label class="block mb-2 text-[16px] text-gray-800">Option ${i}</label>
                                    <input type="text" placeholder="Option ${i} Text"
                                        name="questions[${questionCount}][options][${i}]"
                                        class="border rounded border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 py-2 w-full px-4">
                                </div>
                            `).join('')}
                </div>

                <div class="mb-5">
                    <label class="block mb-2">Correct Answer</label>
                    <select name="questions[${questionCount}][correct_answer]" class="border rounded border-gray-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 py-2 px-4 w-full">
                        <option value="">Select</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                    </select>
                </div>
                `;


                questionsContainer.appendChild(questionDiv);

                questionDiv.querySelector('.remove-question').addEventListener('click', function() {
                    questionDiv.remove();
                    renumberQuestions();
                });
            }

            function renumberQuestions() {
                const questions = questionsContainer.querySelectorAll('.question-card');
                questionCount = questions.length;
                questions.forEach((q, i) => {
                    q.querySelector('h3').textContent = `Question ${i + 1}`;
                });
            }

            addQuestionForm();
            addQuestionBtn.addEventListener('click', addQuestionForm);
        });
    </script>
@endsection
