<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Institute;
use App\Models\Course;
use App\Models\mysession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students= Student::get();
        return view('SuperAdmin.registeredStudents', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();
        $insts= Institute::where('id', $admin->institute_id)->get();
        $courses= Course::get();
        $sessions= mysession::get();
        return view('Admin.students', compact(['insts', 'courses', 'sessions']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo' => ['required'],
            'institute_id' => ['required'],
            'name' => ['required'],
            'fatherName' => ['required'],
            'email' => ['required', 'unique:students,email'],
            'cnic' => ['required', 'regex:/^[0-9]{5}-[0-9]{6}-[0-9]{1}$/', 'unique:students,cnic'],
            'phone' => ['required', 'unique:students,phone'],
            'gender' => ['required'],
            'course_id' => ['required'],
            'session_id'=>['required'],
            'address' => ['required'],
        ]);

        Student::create([
            'image'=> $validated['photo'],
            'instituteId'=> $validated['institute_id'],
            'name'=> $validated['name'],
            'fatherName'=> $validated['fatherName'],
            'email'=> $validated['email'],
            'cnic'=> $validated['cnic'],
            'phone'=> $validated['phone'],
            'gender'=>$validated['gender'],
            'courseId'=> $validated['course_id'],
            'sessionId'=> $validated['session_id'],
            'address'=> $validated['address'],
        ]);

        return redirect()->route('student.create')->with('success', 'Student Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
