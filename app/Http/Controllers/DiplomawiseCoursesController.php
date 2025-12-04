<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diploma;
use App\Models\StudentCourse;
use App\Models\DiplomawiseCourses;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiplomawiseCoursesController extends Controller
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
        $courses = Course::all();
        $diplomas = Diploma::select(DB::raw('MIN(id) as id'), 'DiplomaName')
            ->groupBy('DiplomaName')
            ->orderBy('DiplomaName', 'asc')
            ->get();
        $semesters = Semester::all();
        $assignedCourses = DiplomawiseCourses::with(['diploma', 'course', 'semester'])->get();
        return view('SuperAdmin.diplomawiseCourse.assignCourse', compact(['assignedCourses', 'courses', 'diplomas', 'semesters']));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated=$request->validate([
    //         'diplomaID' => 'required|exists:diplomas,id',
    //         'courseID'=> 'required|exists:courses,id',
    //         'semesterID'=> 'required|exists:semesters,id',
    //     ]);

    //     $existingAssignment = DiplomawiseCourses::where('diplomaID', $validated['diplomaID'])
    //         ->where('sessionID', $validated['sessionID'])
    //         ->exists();

    //     if ($existingAssignment) {
    //         return redirect()->back()->with('error', 'This course is already assigned to this diploma in the selected semester.');
    //     }

    //     $studentDiploma=DiplomawiseCourses::create([
    //         'diplomaID' => $validated['diplomaID'],
    //         'courseID' => $validated['courseID'],
    //         'semesterID' => $validated['semesterID'],
    //     ]);


    //     return redirect()->route('diplomawiseCourse.create')->with('success', 'Course assigned to diploma successfully.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'diplomaID' => 'required|exists:diplomas,id',
            'session_id'=> 'required',
            'semesterID' => 'required|exists:semesters,id',
            'courseIDs' => 'required|array|min:1',
            'courseIDs.*' => 'exists:courses,id',
        ]);

        $diplomaID = $validated['diplomaID'];
        $sessionID = $validated['session_id'];
        $semesterID = $validated['semesterID'];
        $courseIDs = $validated['courseIDs'];

        $data = [];
        $duplicates = [];

        foreach ($courseIDs as $courseId) {
            $existingAssignment = DiplomawiseCourses::where('diplomaID', $diplomaID)
                ->where('courseID', $courseId)
                ->where('semesterID', $semesterID)
                ->where('sessionID', $sessionID)
                ->exists();

            if ($existingAssignment) {
                // Store the course name instead of just the ID
                $courseName = Course::where('id', $courseId)->value('courseName');
                $duplicates[] = $courseName;
                continue;
            }

            $data[] = [
                'diplomaID' => $diplomaID,
                'courseID' => $courseId,
                'semesterID' => $semesterID,
                'sessionID'=> $sessionID,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            DiplomawiseCourses::insert($data);
        }

        // Build success message
      $message = '<span class="font-semibold"> Selected courses assigned successfully.</span>';

        if (!empty($duplicates)) {
            $message .= '<br><span class="text-yellow-600"> These courses were already assigned in the selected session and skipped:</span> <br> <strong class="text-yellow-600">'
                . implode(', ', $duplicates) . '</strong>';
        }

        return redirect()
            ->route('diplomawiseCourse.create')
            ->with('success', $message);
    }


    /**
     * Display the specified resource.
     */
    public function show(DiplomawiseCourses $diplomawiseCourses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiplomawiseCourses $diplomawiseCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiplomawiseCourses $diplomawiseCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiplomawiseCourses $diplomawiseCourses)
    {
        //
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
                'id'   => $diploma->session->id,
                'name' => $diploma->DiplomaName . ' - ' . $diploma->session->session,
            ];
        });

        return response()->json($formatted);
    }
}
