<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses= Course::get();
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
        
        return redirect()->route('course.create')->with('success', 'course created successfully');
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
