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
        $criterias = ExaminationCriteria::with(['diplomawiseCourse.course', 'session'])->get();
        return view('SuperAdmin.ExaminationCriteria.viewCriterias', compact('criterias'));
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
        $validated = $request->validate([
            'theoryMarks'   => 'required|numeric|min:0',
            'practicalMarks' => 'nullable|numeric|min:0',
            'sessionID'     => 'required|exists:mysessions,ID',
            'courseIDs'     => 'required|array|min:1',
            'courseIDs.*'   => 'exists:diplomawise_courses,ID',
        ]);

        $inserted = 0;
        $skippedCourses = [];

        foreach ($validated['courseIDs'] as $courseId) {
            // Check for existing record
            $exists = ExaminationCriteria::where('DiplomawiseCourseID', $courseId)
                ->where('sessionID', $validated['sessionID'])
                ->exists();

            if ($exists) {
                $course = \App\Models\DiplomawiseCourses::with('course')->find($courseId);
                $skippedCourses[] = $course?->course?->courseName ?? 'Unknown Course';
                continue;
            }

            $totalMarks = $validated['theoryMarks'] + ($validated['practicalMarks'] ?? $validated['theoryMarks'] || 0);

            ExaminationCriteria::create([
                'DiplomawiseCourseID' => $courseId,
                'sessionID'            => $validated['sessionID'],
                'TheoryMarks'          => $validated['theoryMarks'],
                'PracticalMarks'       => $validated['practicalMarks'] ?? 0,
                'TotalMarks'           => $totalMarks,
            ]);

            $inserted++;
        }

        // Build message
        $message = " $inserted criteria added successfully.";
        if (!empty($skippedCourses)) {
            $message .= "  Already existed for: " . implode(', ', $skippedCourses);
        }

        return redirect()->back()->with('success', $message);
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
