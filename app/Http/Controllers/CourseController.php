<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $courses= Course::query();
            return DataTables::eloquent($courses)
            ->addColumn('actions', function ($course){
                return'
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
        return view('SuperAdmin.viewCourses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses= Course::get();
        return view('SuperAdmin.addcourse', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'courseName'=> ['required', 'string', 'unique:courses,courseName'],
        ]);

        Course::create([
            'courseName'=> $validated['courseName'],
        ]);
        
        return redirect()->route('course.create')->with('success', 'subject added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $course= $course;
        return view('SuperAdmin.editCourses', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'edit_courseName'=> ['required', 'string'],
        ]);

        $course->update([
            'courseName'=> $validated['edit_courseName'],
        ]);
        
        return redirect()->route('course.index')->with('success', 'course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
