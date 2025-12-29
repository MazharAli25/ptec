<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Student;
use App\Models\StudentDiploma;
use App\Models\StudentQuiz;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $quizzes = Quiz::query();

            return DataTables::eloquent($quizzes)
                ->addColumn('description', function ($row) {
                    return Str::limit($row->description, 60) ?? '-';
                })
                ->addColumn('actions', function ($row) {
                    return '
                <a href="'.route('quiz.edit', encrypt($row->id)).'"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="'.route('quiz.destroy', $row->id).'"
                        method="POST"
                        class="inline-block ml-1"
                        onsubmit="return confirm(\'Are you sure?\')">
                        '.csrf_field().method_field('DELETE').'
                        <button
                            class="inline-flex items-center px-2 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SuperAdmin.Quiz.createQuiz');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quizName' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Quiz::create([
            'quizName' => $validated['quizName'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'quiz created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        //
    }

    // ############ ADMIN ##################

    public function adminQuizIndex(Request $request)
    {
        if ($request->ajax()) {
            $quizzes = Quiz::query();

            return DataTables::eloquent($quizzes)
                ->addColumn('description', function ($row) {
                    return Str::limit($row->description, 20) ?? '.';
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <a href="'.route('admin.quiz.view', encrypt($row->id)).'"
                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-eye text-base"></i>
                    </a>
                    </div>
                ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('Admin.Quiz.quizzesList');
    }

    public function viewQuizAdmin(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('Admin.Quiz.viewQuiz', compact('questions'));
    }


    // ########### Assign Quiz to Students ############
    public function assignQuizToStudents(Request $request)
    {
        $quizzes = Quiz::all();
        $adminId= auth()->guard('admin')->user()->institute_id;
        if($request->all()){
            $students= StudentDiploma::with('student')->whereHas('student', function($query) use ($adminId) {
                $query->where('instituteId', $adminId);
            });
            return DataTables::eloquent($students)
                ->addColumn('checkbox', function ($row) {
                    return '
                    <input type="checkbox"
                        name="studentIDs[]"
                        value="'.$row->student->id.'"
                        class="student-checkbox cursor-pointer">
                ';
                })
                ->addColumn('student_name', function ($row) {
                    return $row->student->name ?? '';
                })
                ->addColumn('diploma_name', function ($row) {
                    return $row->diploma->DiplomaName ?? '';
                })
                ->addColumn('session_name', function ($row) {
                    return $row->session->session ?? '';
                })
                ->rawColumns(['checkbox'])
                ->make(true);
        }

        return view('Admin.Quiz.assignQuiz', compact('quizzes'));
    }

    public function storeAssignedQuiz(Request $request)
    {
        $validated = $request->validate([
            'quizId' => 'required|exists:quizzes,id',
            'studentIDs' => 'required|array',
            'studentIDs.*' => 'exists:students,id',
            'fromDate' => 'required|date',
            'toDate' => 'required|date|after_or_equal:fromDate',
        ]);
        
        $inserted= 0;
        $skipped = [];

        foreach ($validated['studentIDs'] as $studentId) {
            $student = Student::find($studentId);
            $exists= StudentQuiz::where('studentId', $studentId)
                ->where('quizId', $validated['quizId'])
                ->exists();
            if($exists){
                $skipped[]= $student->name ?? 'Unknown Student';
                continue;
            }
            if ($student) {
                StudentQuiz::Create([
                    'studentId' => $student->id,
                    'quizId' => $validated['quizId'],
                    'from'=> $validated['fromDate'],
                    'To'=> $validated['toDate']
                ]);
            }
            $inserted++;
        }
        $message= "<b> $inserted </b> quizzes assigned successfully.";
        if(!empty($skipped)){
            $message .= ' Some Already assigned to:  <b>'.implode(', ', $skipped).'</b>.';
        }else{
            $message .= ' No quizzes were skipped.';
        }
        return redirect()->back()->with('success', $message);
    }

    public function assginedQuizzesList(Request $request)
    {
        if($request->ajax()){
            $assignedQuizzes = StudentQuiz::with(['student', 'quiz']);

            return DataTables::eloquent($assignedQuizzes)
                ->addColumn('studentName', function ($row) {
                    return $row->student->name ?? '-';
                })
                ->addColumn('quizName', function ($row) {
                    return $row->quiz->quizName ?? '-';
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <a href=""
                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-eye text-base"></i>
                    </a>
                    </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('Admin.Quiz.assignedQuizList');
    }

    public function myQuizzes(StudentQuiz $studentQuiz)
    {
        $studentId = auth()->guard('student')->user()->id;
        $quizzes = StudentQuiz::with(['quiz', 'student'])
            ->where('studentId', $studentId)
            ->get();
        return view('student.Quiz.myQuizzes', compact('quizzes'));
    }
}
