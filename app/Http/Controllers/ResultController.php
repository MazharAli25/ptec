<?php

namespace App\Http\Controllers;

use App\Models\ExaminationCriteria;
use App\Models\Result;
use App\Models\StudentCourse;
use App\Models\Student;
use Illuminate\Http\Request;

class ResultController extends Controller
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
        $students = StudentCourse::all();
        return view('Admin.Result.addResult', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'examinationCriteriaID' => 'required|array',
            'studentID'            => 'required|array',
            'diplomaID'            => 'required|array',
            'sessionID'            => 'required|array',
            'theoryTotalMarks'    => 'required|array',
            'practicalTotalMarks' => 'required|array',
            'theoryMarks'         => 'array',
            'practicalMarks'      => 'array',
            // 'passingMarks'        => 'required|array',
            // 'status'              => 'required',
        ]);
        // dd($validated['sessionID'], $validated['diplomaID']);
        foreach ($validated['theoryMarks'] as $index => $theoryMark) {
            $theoryObtained = trim($theoryMark);
            $practicalObtained = trim($validated['practicalMarks'][$index]);

            // Skip if both marks are empty
            if ($theoryObtained === '' && $practicalObtained === '') {
                continue;
            }

            // Now proceed with logic...
            $examinationCriteriaID = (int) $validated['examinationCriteriaID'][$index];
            $studentID             = (int) $validated['studentID'][$index];
            $theoryTotal           = (int) $validated['theoryTotalMarks'][$index];
            $practicalTotal        = (int) $validated['practicalTotalMarks'][$index];
            $sessionID            = (int) $validated['sessionID'][$index];
            $diplomaID            = (int) $validated['diplomaID'][$index];

            $totalObtained = (int)$theoryObtained + (int)$practicalObtained;
            $totalMarks    = $theoryTotal + $practicalTotal;
            $passingMarks  = floor($totalMarks / 2);
            $percentage    = $totalMarks > 0 ? ($totalObtained / $totalMarks) * 100 : 0;

            // Grading
            if ($percentage >= 90) $grade = 'A+';
            elseif ($percentage >= 80) $grade = 'A';
            elseif ($percentage >= 70) $grade = 'B';
            elseif ($percentage >= 60) $grade = 'C';
            elseif ($percentage >= 50) $grade = 'D';
            else $grade = 'F';

            // Determine pass/fail
            $status = ($totalObtained >= $passingMarks) ? 'Pass' : 'Fail';

            // Check for duplicates
            $existingResult = Result::where('ExaminationCriteriaID', $examinationCriteriaID)
                ->where('StudentID', $studentID)
                ->exists();

            if ($existingResult) {
                $duplicates[] = "Result for Student ID $studentID already exists.";
                continue;
            }

            // Check practical marks only if required
            $criteria = ExaminationCriteria::with('diplomawiseCourse.course')->find($examinationCriteriaID);
            if ($criteria->PracticalMarks > 0 && $practicalObtained === '') {
                $requiredPracticalMarks[] = "Practical marks required for {$criteria->diplomawiseCourse->course->courseName}.";
                continue;
            }

            $results[] = [
                'ExaminationCriteriaID' => $examinationCriteriaID,
                'StudentID'             => $studentID,
                'diplomaID'             => $diplomaID,
                'sessionID'             =>$sessionID,
                'TheoryTotalMarks'      => $theoryTotal,
                'TheoryMarks'           => (int)$theoryObtained,
                'PracticalTotalMarks'   => $practicalTotal,
                'PracticalMarks'        => (int)$practicalObtained,
                'PassingMarks'          => $passingMarks,
                'TotalMarks'            => $totalMarks,
                'ObtainedMarks'         => $totalObtained,
                'Grade'                 => $grade,
                'status'                => $status,
            ];
        }
        if (!empty($requiredPracticalMarks)) {
            return redirect()
                ->route('result.create')
                ->with('error', 'Results not added because practical marks are required:<br>' . implode('<br>', $requiredPracticalMarks));
        }

        if (!empty($duplicates)) {
            return redirect()
                ->route('result.create')
                ->with('error', 'Results not added due to duplicates:<br>' . implode('<br>', $duplicates));
        }

        if (!empty($results)) {
            Result::insert($results);
            return redirect()
                ->route('result.create')
                ->with('success', 'Results added successfully!');
        }

        return redirect()
            ->route('result.create')
            ->with('error', 'No valid results were added.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        $result = $result;
        $sessionID=$result->ExaminationCriteria->diplomawiseCourse->diploma->session->id;
        $diplomaID=$result->ExaminationCriteria->diplomawiseCourse->diploma->id;
        $courses = Result::where('StudentID', $result->StudentID)->where(['sessionID'=> $sessionID, 'diplomaID'=>$diplomaID])
            ->with('ExaminationCriteria.diplomawiseCourse.diploma')
            ->get();

        $totalMarks = $courses->sum('TotalMarks');
        $obtainedMarks = $courses->sum('ObtainedMarks');

        return view('SuperAdmin.Student.viewStudentResult', compact(
            'result',
            'courses',
            'totalMarks',
            'obtainedMarks',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
