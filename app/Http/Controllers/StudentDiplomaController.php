<?php

namespace App\Http\Controllers;

use App\Models\StudentDiploma;
use App\Models\Diploma;
use App\Models\Semester;
use App\Models\DiplomawiseCourses;
use App\Models\StudentCourse;
use Illuminate\Http\Request;

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
        $diplomas = Diploma::all();
        $semesters = Semester::all();

        $query = \App\Models\Student::query();

        if ($request->filled('id')) {
            $query->where('id', 'like', "%{$request->id}%");
        }

        $student = $request->hasAny(['name', 'id'])
            ? $query->get()
            : collect();

        return view('Admin.studentDiploma', compact(['student', 'diplomas', 'semesters']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'diploma_id' => 'required|exists:diplomas,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        $existingEnrollment = StudentDiploma::where('student_id', $validated['student_id'])
            ->where('diploma_id', $validated['diploma_id'])
            ->exists();

        if ($existingEnrollment) {
            return redirect()->route('studentDiploma.create')->with('error', 'Student is already enrolled in this diploma.');
        }
        $studentDiploma = StudentDiploma::create([
            'student_id' => $validated['student_id'],
            'diploma_id' => $validated['diploma_id'],
            'semester_id' => $validated['semester_id'],
            'issue_diploma' => 0,
        ]);


        $diplomaCourses = DiplomaWiseCourses::where('diplomaID', $validated['diploma_id'])->pluck('id');
        foreach ($diplomaCourses as $courseId) {
            StudentCourse::create([
                'StudentDiplomaID' => $studentDiploma->id,
                'DiplomawiseCourseID' => $courseId,
            ]);

            dd([
                'StudentDiplomaID' => $studentDiploma->id,
                'DiplomawiseCourseID' => $courseId,
            ]);
        }


        return redirect()->route('studentDiploma.create')->with('success', 'Diploma assigned to student successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentDiploma $studentDiploma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentDiploma $studentDiploma)
    {
        //
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
        //
    }
}
