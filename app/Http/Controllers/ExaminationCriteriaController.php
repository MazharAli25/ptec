<?php

namespace App\Http\Controllers;

use App\Models\DiplomawiseCourses;
use App\Models\ExaminationCriteria;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExaminationCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $criterias = ExaminationCriteria::with([
                'diplomawiseCourse.course:ID,courseName',
                'session:ID,session',
            ]);

            return DataTables::eloquent($criterias)

                ->addColumn('course_name', function ($row) {
                    return $row->diplomawiseCourse->Course->courseName ?? '';
                })

                ->addColumn('session_name', function ($row) {
                    return $row->session->session ?? '';
                })

                ->addColumn('actions', function ($row) {
                    return '
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm rounded">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm rounded ml-1">
                        <i class="fas fa-trash"></i>
                    </a>
                ';
                })

                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.ExaminationCriteria.viewCriterias');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {

            $courses = DiplomawiseCourses::with([
                'course:id,courseName',
                'diploma.session:id,session',
            ]);

            return DataTables::eloquent($courses)

                ->addColumn('checkbox', function ($row) {
                    return '
                    <input type="checkbox"
                        name="courseIDs[]"
                        value="'.$row->ID.'"
                        class="course-checkbox cursor-pointer">
                ';
                })

                ->addColumn('course_name', function ($row) {
                    return $row->course->courseName ?? '';
                })

                ->addColumn('session', function ($row) {
                    return '
                    <input type="hidden" name="sessionID" value="'.$row->diploma->session->id.'">
                    '.($row->diploma->session->session ?? '').'
                ';
                })
                ->filterColumn('session', function ($query, $keyword) {
                    $query->whereHas('diploma.session', function ($q) use ($keyword) {
                        $q->where('session', 'like', "%{$keyword}%");
                    });
                })

                ->rawColumns(['checkbox', 'session']) // IMPORTANT
                ->make(true);
        }

        return view('SuperAdmin.ExaminationCriteria.ExaminationMarks');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'theoryMarks' => 'required|numeric|min:0',
            'practicalMarks' => 'nullable|numeric|min:0',
            'sessionID' => 'required|exists:mysessions,ID',
            'courseIDs' => 'required|array|min:1',
            'courseIDs.*' => 'exists:diplomawise_courses,ID',
        ]);

        $inserted = 0;
        $skippedCourses = [];

        foreach ($validated['courseIDs'] as $courseId) {
            // Check for existing record
            $exists = ExaminationCriteria::where('DiplomawiseCourseID', $courseId)
                ->where('sessionID', $validated['sessionID'])
                ->exists();

            if ($exists) {
                $course = DiplomawiseCourses::with('course')->find($courseId);
                $skippedCourses[] = $course?->course?->courseName ?? 'Unknown Course';

                continue;
            }

            $totalMarks = $validated['theoryMarks'] + ($validated['practicalMarks'] ?? $validated['theoryMarks'] || 0);

            ExaminationCriteria::create([
                'DiplomawiseCourseID' => $courseId,
                'sessionID' => $validated['sessionID'],
                'TheoryMarks' => $validated['theoryMarks'],
                'PracticalMarks' => $validated['practicalMarks'] ?? 0,
                'TotalMarks' => $totalMarks,
            ]);

            $inserted++;
        }

        // Build message
        $message = " $inserted criteria added successfully.";
        if (! empty($skippedCourses)) {
            $message .= '  Already existed for: '.implode(', ', $skippedCourses);
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
