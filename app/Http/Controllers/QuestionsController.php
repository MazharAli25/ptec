<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\questions;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $questions = questions::with('quiz', 'options')->select('questions.*');

            return DataTables::of($questions)
                ->addColumn('id', function ($q) {
                    return $q->id;
                })
                ->addColumn('quiz_name', function ($q) {
                    return $q->quiz->quizName;
                })
                ->addColumn('question_text', function ($q) {
                    return Str::limit($q->question, 20);
                })
                ->addColumn('actions', function ($q) {
                    return '
                    <div class="flex gap-1">
                    <a href="'.route('question.edit', encrypt($q->id)).'"
                        class="inline-flex items-center px-2 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="'.route('question.show', encrypt($q->id)).'"
                        class="inline-flex items-center px-2 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                        <i class="fas fa-eye"></i>
                    </a>

                    <form action="'.route('question.destroy', $q->id).'"
                        method="POST"
                        class="inline-block ml-1"
                        onsubmit="return confirm(\'Are you sure?\')">
                        '.csrf_field().method_field('DELETE').'
                        <button
                            class="inline-flex items-center px-2 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);

        }

        return view('SuperAdmin.Quiz.Question.questionsList');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $quizzes = Quiz::get();

        return view('SuperAdmin.Quiz.Question.createQuestion', compact('quizzes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|size:4',
            'questions.*.correct_answer' => 'required|in:1,2,3,4',
        ]);

        DB::transaction(function () use ($request) {

            foreach ($request->questions as $qIndex => $questionData) {

                $correctIndex = $questionData['correct_answer'];

                if (
                    ! isset($questionData['options'][$correctIndex]) ||
                    trim($questionData['options'][$correctIndex]) === ''
                ) {
                    throw ValidationException::withMessages([
                        "questions.$qIndex.correct_answer" => 'Correct answer must be a filled option for question '.$qIndex.'.',
                    ]);
                }

                $question = questions::create([
                    'quiz_id' => $request->quiz_id,
                    'question' => $questionData['question'],
                ]);

                foreach ($questionData['options'] as $optionIndex => $optionText) {

                    if (trim($optionText) === '') {
                        continue;
                    }

                    Option::create([
                        'question_id' => $question->id,
                        'options' => $optionText,
                        'is_correct' => ($optionIndex == $correctIndex) ? 1 : 0,
                    ]);
                }
            }
        });

        return redirect()
            ->back()
            ->with('success', 'Questions added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(questions $question)
    {
        $quizzes = Quiz::get();
        $question = $question;

        return view('SuperAdmin.Quiz.Question.editQuestion', compact(['question', 'quizzes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, questions $question)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'questions' => 'required|array|min:1',
            'questions.0.question' => 'required|string',
            'questions.0.options' => 'required|array|size:4',   
            'questions.0.correct_answer' => 'required|in:0,1,2,3', // 0-based index
        ]);

        DB::transaction(function () use ($request, $question) {
            $qData = $request->questions[0];
            $correctIndex = (int) $qData['correct_answer'];

            // Check if correct answer is non-empty
            if (! isset($qData['options'][$correctIndex]) || trim($qData['options'][$correctIndex]) === '') {
                throw ValidationException::withMessages([
                    'questions.0.correct_answer' => 'Correct answer must be a filled option.',
                ]);
            }

            // Update question text and quiz
            $question->update([
                'quiz_id' => $request->quiz_id,
                'question' => $qData['question'],
            ]);

            // Update options
            foreach ($qData['options'] as $index => $optionText) {
                $option = $question->options()->where('id', $question->options[$index]->id ?? null)->first();

                if ($option) {
                    $option->update([
                        'options' => $optionText,
                        'is_correct' => ($index == $correctIndex) ? 1 : 0,
                    ]);
                } else {
                    $question->options()->create([
                        'options' => $optionText,
                        'is_correct' => ($index == $correctIndex) ? 1 : 0,
                    ]);
                }
            }
        });

        return redirect()->route('question.index')->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(questions $questions)
    {
        //
    }
}
