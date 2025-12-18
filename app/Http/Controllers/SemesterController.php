<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SemesterController extends Controller
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
        if ($request->ajax()) {
            $semesters = Semester::query();

            return DataTables::eloquent($semesters)
                ->addColumn('actions', function ($row) {
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
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.Semester.addSemester');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'semesterName' => 'required|string|max:255',
            'semesterDuration' => 'required|string|max:255',
        ]);
        Semester::create([
            'SemesterName' => $validated['semesterName'],
            'Duration' => $validated['semesterDuration'],
        ]);

        return redirect()->route('semester.create')->with('success', 'Semester created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        //
    }
}
