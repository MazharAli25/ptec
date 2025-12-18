<?php

namespace App\Http\Controllers;

use App\Models\Diploma;
use App\Models\DiplomawiseCourses;
use App\Models\mysession;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DiplomaController extends Controller
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
        $sessions = mysession::all();
        if ($request->ajax()) {
            $diplomas = Diploma::query();

            return DataTables::eloquent($diplomas)
                ->addColumn('session', function ($diploma) {
                    return $diploma->session->session;
                })
                ->addColumn('actions', function ($diploma) {
                    return '
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>

                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-base"></i>
                    </a>
                ';
                })
                ->rawColumns(['actions', 'session'])
                ->make(true);
        }

        return view('SuperAdmin.Diploma.addDiploma', compact(['sessions']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sessionID' => 'required|exists:mysessions,id',
            'diplomaName' => 'required|string|max:255',
        ]);
        $existingAssignment = Diploma::where('DiplomaName', $validated['diplomaName'])
            ->where('sessionID', $validated['sessionID'])
            ->exists();

        if ($existingAssignment) {
            return redirect()->back()->with('error', 'This diploma is already assigned to this diploma in the selected session.');
        }
        Diploma::create([
            'SessionID' => $validated['sessionID'],
            'DiplomaName' => $validated['diplomaName'],
        ]);

        return redirect()->route('diploma.create')->with('success', 'Diploma added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diploma $diploma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diploma $diploma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diploma $diploma)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diploma $diploma)
    {
        //
    }

    public function assignedCourses(Request $request)
    {
        if ($request->ajax()) {
            // 1. Base Query
            $diplomas = DiplomawiseCourses::with(['diploma.session', 'course', 'semester']);

            return DataTables::eloquent($diplomas)
                ->addIndexColumn()

                // --- COLUMNS & FILTERS ---

                // 1. Diploma Name
                ->addColumn('diplomaName', function ($row) {
                    return $row->diploma->DiplomaName ?? '-';
                })
                ->filterColumn('diplomaName', function ($query, $keyword) {
                    $query->whereHas('diploma', function ($q) use ($keyword) {
                        $q->where('DiplomaName', 'like', "%{$keyword}%");
                    });
                })

                // 2. Course Name
                ->addColumn('courseName', function ($row) {
                    return $row->course->courseName ?? '-';
                })
                ->filterColumn('courseName', function ($query, $keyword) {
                    $query->whereHas('course', function ($q) use ($keyword) {
                        $q->where('courseName', 'like', "%{$keyword}%");
                    });
                })

                // 3. Semester
                ->addColumn('semester', function ($row) {
                    return $row->semester->semesterName ?? '-';
                })
                ->filterColumn('semester', function ($query, $keyword) {
                    $query->whereHas('semester', function ($q) use ($keyword) {
                        $q->where('semesterName', 'like', "%{$keyword}%");
                    });
                })

                // 4. Session (Nested Relationship)
                ->addColumn('session', function ($row) {
                    return $row->diploma->session->session ?? '-';
                })
                ->filterColumn('session', function ($query, $keyword) {
                    $query->whereHas('diploma.session', function ($q) use ($keyword) {
                        $q->where('session', 'like', "%{$keyword}%");
                    });
                })

                // 5. Actions
                ->addColumn('actions', function ($row) {
                    return '
                <div class="flex justify-center gap-2">
                    <a href="#" class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>
                    <a href="#" class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-base"></i>
                    </a>
                </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.Diploma.assignedCourses');
    }
}
