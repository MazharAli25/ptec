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

    public function adminIndex(){
        $students= Student::get();
        return view('Admin.registeredStudents', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        session()->forget('student_id');
        $nextStudentId = Student::max('id') + 1;
        session(['student_id' => $nextStudentId]);

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
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'institute_id' => ['required'],
            'name' => ['required'],
            'fatherName' => ['required'],
            'dob'=>['nullable', 'date'],
            'email' => ['required', 'unique:students,email', function ($attribute, $value, $fail) {
                if (!preg_match('/@(gmail|yahoo|hotmail)\.com$/', $value)) {
                    $fail('The email must be a Gmail, Yahoo, or Hotmail address.');
                }
            }],
            'cnic' => ['required', 'regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', 'unique:students,cnic'],
            'phone' => ['required', 'unique:students,phone', 'max:11'],
            'gender' => ['required'],
            // 'course_id' => ['required'],
            // 'session_id'=>['required'],
            'joiningDate'=>['required', 'date'],
            'address' => ['nullable'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        Student::create([
            'image'=> $photoPath,
            'instituteId'=> $validated['institute_id'],
            'name'=> $validated['name'],
            'fatherName'=> $validated['fatherName'],
            'email'=> $validated['email'],
            'dob'=>$validated['dob'],
            'cnic'=> $validated['cnic'],
            'phone'=> $validated['phone'],
            'gender'=>$validated['gender'],
            // 'courseId'=> $validated['course_id'],
            // 'sessionId'=> $validated['session_id'],
            'joiningDate'=> $validated['joiningDate'],
            'address'=> $validated['address'],
        ]);

        return redirect()->route('student.create')->with('success', 'Student Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student= $student;
        return view('Admin.studentDetails', compact('student'));
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

    public function assignCourse()
    {
        
    }

}
