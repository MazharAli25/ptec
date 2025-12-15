<?php

namespace App\Http\Controllers;

use App\Models\Diploma;
use App\Models\DiplomawiseCourses;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\StudentDiploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentDiplomaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $diplomas = Diploma::select(DB::raw('MIN(id) as id'), 'DiplomaName')
            ->groupBy('DiplomaName')
            ->orderBy('DiplomaName', 'asc')
            ->get();

        $semesters = Semester::all();
        $adminInstituteId = Auth::guard('admin')->user()->institute_id;
        $student = collect();

        if ($request->filled('id')) {
            $student = Student::where('id', $request->id)
                ->where('instituteId', $adminInstituteId)
                ->first();
            if ($student) {
                $student = collect([$student]);
            } else {
                return back()->with('error', 'No student with this ID exists in your institute.');
            }
        }

        return view('Admin.studentDiploma', compact('student', 'diplomas', 'semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'student_id' => 'required|exists:students,id',
    //         'diploma_id' => 'required|exists:diplomas,id',
    //         'semester_id' => 'required|exists:semesters,id',
    //     ]);

    //     $existingEnrollment = StudentDiploma::where('student_id', $validated['student_id'])
    //         ->where('diploma_id', $validated['diploma_id'])
    //         ->exists();

    //     if ($existingEnrollment) {
    //         return redirect()->route('studentDiploma.create')->with('error', 'Student is already enrolled in this diploma.');
    //     }
    //     $studentDiploma = StudentDiploma::create([
    //         'student_id' => $validated['student_id'],
    //         'diploma_id' => $validated['diploma_id'],
    //         'semester_id' => $validated['semester_id'],
    //         'issue_diploma' => 0,
    //     ]);

    //     $diplomaCourses = DiplomaWiseCourses::where('diplomaID', $validated['diploma_id'])->pluck('id');
    //     foreach ($diplomaCourses as $courseId) {
    //         StudentCourse::create([
    //             'StudentDiplomaID' => $studentDiploma->id,
    //             'DiplomawiseCourseID' => $courseId,
    //         ]);

    //         dd([
    //             'StudentDiplomaID' => $studentDiploma->id,
    //             'DiplomawiseCourseID' => $courseId,
    //         ]);
    //     }

    //     return redirect()->route('studentDiploma.create')->with('success', 'Diploma assigned to student successfully.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'diploma_id' => 'required|exists:diplomas,id',
            'semester_id' => 'required|exists:semesters,id',
            'session_id' => 'required',
        ]);
        // Find or create StudentDiploma record
        $studentDiploma = StudentDiploma::firstOrCreate(
            [
                'student_id' => $validated['student_id'],
                'diploma_id' => $validated['diploma_id'],
                'session_id' => $validated['session_id'],
            ],
            [
                'semester_id' => $validated['semester_id'],
                'issue_diploma' => 0,
            ]
        );

        $sessionID = $validated['session_id'];

        //  Get all required course IDs for this diploma
        $requiredCourses = DiplomaWiseCourses::with('diploma.session')
            ->where('diplomaID', $validated['diploma_id'])
            ->where('sessionID', $validated['session_id'])
            ->where('semesterID', $validated['semester_id'])
            ->pluck('id')
            ->toArray();

        // Get existing courses already assigned to this student for this diploma
        $existingCourses = StudentCourse::where(['semesterID' => $validated['semester_id'], 'StudentDiplomaID' => $studentDiploma->ID])
            ->pluck('DiplomawiseCourseID')
            ->toArray();

        // Find missing courses
        $missingCourses = array_diff($requiredCourses, $existingCourses);

        if (empty($requiredCourses)) {
            // Student already has all courses for this diploma
            return redirect()
                ->back()
                ->with('error', 'No further courses are assigned to the selected semester.');
        }
        if (empty($missingCourses)) {
            // Student already has all courses for this diploma
            return redirect()
                ->back()
                ->with('error', 'Student is already enrolled in all courses of this diploma.');
        }
        $diplomaID = $validated['diploma_id'];
        $session_id = $validated['session_id'];

        $diplomaID = $validated['diploma_id'];
        $sessionID = $validated['session_id'];

        $semesterID = DiplomawiseCourses::where('diplomaID', $diplomaID)
            ->value('semesterID'); // get one semester ID

        DB::transaction(function () use ($missingCourses, $studentDiploma, $semesterID, $sessionID) {
            foreach ($missingCourses as $courseId) {
                StudentCourse::create([
                    'StudentDiplomaID' => $studentDiploma->ID,
                    'semesterID' => $semesterID,
                    'sessionID' => $sessionID,
                    'DiplomawiseCourseID' => $courseId,
                ]);
            }
        });

        return redirect()
            ->back()
            ->with('success', count($missingCourses).' new courses assigned to the student for this diploma.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentDiploma $studentDiploma)
    {
        $studentDiplomaID = $studentDiploma->ID;
        $student = $studentDiploma->student;
        $studentCourses = StudentCourse::with('diplomawiseCourse.course', 'diplomawiseCourse.diploma', 'diplomawiseCourse.session')
            ->where('StudentDiplomaID', $studentDiplomaID)
            ->get();

        return view('Admin.Student.showStudentDiplomas', compact('studentDiploma', 'studentCourses', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentDiploma $studentDiploma)
    {
        $studentDiplomaID = $studentDiploma->ID;
        $student = $studentDiploma->student;
        $studentCourses = StudentCourse::with('diplomawiseCourse.course', 'diplomawiseCourse.diploma', 'diplomawiseCourse.session')
            ->where('StudentDiplomaID', $studentDiplomaID)
            ->get();
        return view('Admin.Student.editStudentDiplomas', compact('studentDiploma', 'studentCourses', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentDiploma $studentDiploma)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentDiploma $studentDiploma)
    {
        DB::transaction(function () use ($studentDiploma) {
            // Delete all courses associated with this diploma
            StudentCourse::where('StudentDiplomaID', $studentDiploma->ID)->delete();

            // Delete the diploma itself
            $studentDiploma->delete();
        });

        return redirect()->back()
            ->with('success', 'Student diploma and its courses deleted successfully.');
    }

    public function getSessions($diplomaName)
    {
        // find all diplomas that share the same name
        $diplomas = Diploma::where('DiplomaName', $diplomaName)
            ->with('session')
            ->get();

        // dd($diplomas);

        if ($diplomas->isEmpty()) {
            return response()->json([]);
        }

        $formatted = $diplomas->map(function ($diploma) {
            return [
                'id' => $diploma->session->id,
                'name' => $diploma->DiplomaName.' - '.$diploma->session->session,
            ];
        });

        return response()->json($formatted);
    }
}
