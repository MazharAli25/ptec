<?php

namespace App\Http\Controllers;

use App\Models\DiplomawiseCourses;
use App\Models\ExaminationCriteria;
use Illuminate\Http\Request;

class ExaminationCriteriaController extends Controller
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
    public function create()
    {
        $courses = DiplomawiseCourses::all();
        return view('SuperAdmin.ExaminationCriteria.ExaminationMarks', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'diplomaID' => 'required|exists:diplomas,id',
        //     'semesterID' => 'required|exists:semesters,id',
        //     'courseIDs' => 'required|array|min:1',
        //     'courseIDs.*' => 'exists:courses,id',
        // ]);

        // $diplomaID = $validated['diplomaID'];
        // $semesterID = $validated['semesterID'];
        // $courseIDs = $validated['courseIDs'];

        // $data = [];
        // $duplicates = [];

        // foreach ($courseIDs as $courseId) {
        //     $existingAssignment = DiplomawiseCourses::where('diplomaID', $diplomaID)
        //         ->where('courseID', $courseId)
        //         ->where('semesterID', $semesterID)
        //         ->exists();

        //     if ($existingAssignment) {
        //         $courseName = Course::where('id', $courseId)->value('courseName');
        //         $duplicates[] = $courseName;
        //         continue;
        //     }

        //     $data[] = [
        //         'diplomaID' => $diplomaID,
        //         'courseID' => $courseId,
        //         'semesterID' => $semesterID,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // if (!empty($data)) {
        //     DiplomawiseCourses::insert($data);
        // }

        // Build success message
        // $message = '<span class="font-semibold"> Selected courses assigned successfully.</span>';

        // if (!empty($duplicates)) {
        //     $message .= '<br><span class="text-yellow-600"> These courses were already assigned in the selected session and skipped:</span> <br> <strong class="text-yellow-600">'
        //         . implode(', ', $duplicates) . '</strong>';
        // }

        // return redirect()
            // ->route('diplomawiseCourse.create')
            // ->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExaminationCriteria $examinationCriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExaminationCriteria $examinationCriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExaminationCriteria $examinationCriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExaminationCriteria $examinationCriteria)
    {
        //
    }
}
