<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Institute;
use App\Models\mysession;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = Student::with('studentDiplomas')->whereDoesntHave('studentDiplomas');

            return DataTables::eloquent($students)
                ->addColumn('actions', function ($row) {
                    return '
                    <div class="flex items-center justify-center gap-1">
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>

                    <!-- View Link -->
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-eye text-base"></i>
                    </a>

                    <!-- Delete Link -->
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-base"></i>
                    </a>
                    </div>
                ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.registeredStudents');
    }

    public function adminIndex()
    {

        $students = Student::where('instituteId')->get();

        return view('Admin.registeredStudents', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();
        $insts = Institute::get();
        $courses = Course::get();
        $sessions = mysession::get();
        $lastStudentId = Student::max('id');
        $nextStudentId = $lastStudentId ? $lastStudentId + 1 : 1;

        return view('Admin.students', compact(['insts', 'courses', 'sessions', 'nextStudentId']));
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
            'dob' => ['nullable', 'date'],
            'email' => ['required', 'unique:students,email', function ($attribute, $value, $fail) {
                if (! preg_match('/@(gmail|yahoo|hotmail)\.com$/', $value)) {
                    $fail('The email must be a Gmail, Yahoo, or Hotmail address.');
                }
            }],
            'cnic' => ['required', 'regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', 'unique:students,cnic'],
            'phone' => ['required', 'unique:students,phone', 'max:11'],
            'gender' => ['required'],
            // 'course_id' => ['required'],
            // 'session_id'=>['required'],
            'joiningDate' => ['required', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
            'fromDate' => ['required'],
            'toDate' => ['required'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $instituteId = Auth::guard('admin')->user()->institute_id;

        Student::create([
            'image' => $photoPath,
            'instituteId' => $instituteId,
            'certificateInstituteId' => $validated['institute_id'],
            'name' => $validated['name'],
            'fatherName' => $validated['fatherName'],
            'email' => $validated['email'],
            'dob' => $validated['dob'],
            'cnic' => $validated['cnic'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            // 'courseId'=> $validated['course_id'],
            // 'sessionId'=> $validated['session_id'],
            'joiningDate' => $validated['joiningDate'],
            'from' => $validated['fromDate'],
            'to' => $validated['toDate'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('student.create')->with('success', 'Student Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student = $student;

        return view('Admin.studentDetails', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student = Student::findOrFail($student->id);
        $insts = Institute::get();

        // dd($student);
        return view('Admin.Student.editStudent', compact(['student', 'insts']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'institute_id' => ['required'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Changed from 'image' to 'photo'
            'name' => ['required'],
            'fatherName' => ['required'],
            'dob' => ['nullable', 'date'],

            // Corrected email unique validation (removed redundant 'email' key and fixed closure)
            'email' => [
                'required',
                'unique:students,email,'.$student->id,
                function ($attribute, $value, $fail) {
                    if (! preg_match('/@(gmail|yahoo|hotmail)\.com$/', $value)) {
                        $fail('The email must be a Gmail, Yahoo, or Hotmail address.');
                    }
                },
            ],

            'cnic' => ['required', 'regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', 'unique:students,cnic,'.$student->id],
            'phone' => ['required', 'unique:students,phone,'.$student->id, 'max:11'],
            'gender' => ['required'],
            'joiningDate' => ['required', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
        $photoPath = $student->image; // Start by keeping the existing image path

        if ($request->hasFile('photo')) {
            // A. Delete old photo if it exists
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }

            // B. Store the new photo (using the same storage path as 'store' method)
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        // 3. Update student data with the potentially new or existing photo path
        $student->update([
            'certificateInstituteId' => $validated['institute_id'],
            'image' => $photoPath,
            'name' => $validated['name'],
            'fatherName' => $validated['fatherName'],
            'email' => $validated['email'],
            'dob' => $validated['dob'],
            'cnic' => $validated['cnic'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'joiningDate' => $validated['joiningDate'],
        ]);

        return redirect()->route('student.edit', encrypt($student->id))->with('success', 'Student Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->back()
            ->with('err', 'Student Deleted Successfully');
    }

    public function toggleStatus($id)
    {
        $student = Student::findOrFail($id);
        // Toggle status
        $student->status = $student->status === 'Active' ? 'Inactive' : 'Active';
        $student->save();

        return response()->json([
            'success' => true,
            'status' => $student->status,
        ]);
    }

    public function adminStudentListStatus(Request $request)
    {   
        $id = $request->id;
        $student = Student::findOrFail($id);
        // Toggle status
        $student->status = $student->status === 'Active' ? 'Inactive' : 'Active';
        $student->save();

        return response()->json([
            'success' => true,
            'status' => $student->status,
        ]);
    }

    public function studentList(Request $request)
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        if ($request->ajax()) {
            $students = Student::where('instituteId', $adminId)->whereHas('studentDiplomas');

            return DataTables::eloquent($students)
                ->addColumn('status', function ($row) {
                    $status = $row->status;
                    $color = $status === 'Active' ? 'bg-green-100 text-green-800' : ($status === 'Inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');

                    return '<button class="status-btn" data-id="'.$row->id.'">
                            <span class="px-3 py-1 rounded-full text-sm font-medium '.$color.'">'.$status.'</span>
                        </button>';
                })
                ->addColumn('actions', function ($student) {
                    return '
                        <div class="flex justify-center gap-2">
                            <a href="'.route('student.edit', encrypt($student->id)).'"
                            class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white rounded">
                                <i class="fas fa-edit text-base"></i>
                            </a>
                            <a href="'.route('student.show', encrypt($student)).'"
                                 class="no-underline inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                                 <i class="fas fa-eye text-base"></i>
                             </a>
                             <!-- Delete Link -->
                             <form action="'.route('student.destroy', encrypt($student)).'" class="inline-block" method="POST">
                                 '.csrf_field().method_field('DELETE').'
                                 <button
                                     class="no-underline inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                     <i class="fas fa-trash text-base"></i>
                                 </button>
                             </form>
                        </div>
                    ';
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        // $students = Student::where('instituteId', Auth::guard('admin')->user()->institute_id)
        //     ->whereHas('studentDiplomas')
        //     ->get();

        // dd($students);

        return view('Admin.Student.studentList');
    }

    // ######## Students Accounts Management ########

    public function changeStudentPassword(Request $request)
    {
        $adminInstituteId = Auth::guard('admin')->user()->institute_id;
        $student = collect();

        if ($request->filled('id')) {
            $student = Student::where('id', $request->id)
                ->where('instituteId', $adminInstituteId)
                ->first();
            if ($student) {
                $student = collect([$student]);
            } else {
                return back()->with('error', 'No student with this ID exists in your institute.');
            }
        }

        return view('Admin.accounts.students.changePassword', compact('student'));
    }

    public function updateStudentPassword(Request $request, Student $student)
    {
        $validated = $request->validate([
            'password' => 'nullable|string|confirmed',
        ]);
        // Only update password if provided
        if (! empty($validated['password'])) {
            $student->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        return back()->with('success', 'Password updated successfully');
    }

    public function studentAccountsList(Request $request)
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        if ($request->ajax()) {
            $students = Student::with('studentDiplomas')->where('password', '!=', null)->where('instituteId', $adminId);

            return DataTables::eloquent($students)
                ->addColumn('actions', function ($row) {
                    return '
                    <div class="flex items-center justify-center gap-1">
                    <a href="'.route('student.editStudentAccount', encrypt($row->id)).'"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>

                    <!-- View Link -->
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-eye text-base"></i>
                    </a>

                    <!-- Delete Link -->
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-base"></i>
                    </a>
                    </div>
                ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.accounts.students.accountsList');
    }

    public function editStudentAccount(Student $student)
    {
        $student = $student;

        return view('admin.accounts.students.updateAccount', compact('student'));
    }

    public function updateStudentAccount(Request $request, Student $student)
    {

        $validated = $request->validate([
            'password' => 'nullable|string|confirmed',
        ]);
        // Only update password if provided
        if (! empty($validated['password'])) {
            $student->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        return back()->with('success', 'Password updated successfully');
    }

    public function studentDashboard()
    {
        return view('Student.home');
    }

    public function studentCourses(Request $request)
    {
        $studentId = Auth::guard('student')->user()->id;
        $courses = StudentCourse::with(['studentDiploma', 'diplomawiseCourse.course'])->get();

        return view('Student.myCourses', compact('courses'));
    }

    public function superStudentIndex(Request $request)
    {
        if ($request->ajax()) {
            $students = Student::query();

            return DataTables::eloquent($students)
                ->addColumn('institute', function ($row) {
                    return $row->institute->institute_name ? $row->institute->institute_name : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <div class="flex items-center justify-center gap-1">
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>

                    <!-- View Link -->
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-eye text-base"></i>
                    </a>

                    <!-- Delete Link -->
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-base"></i>
                    </a>
                    </div>
                ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.registeredStudents');
    }
}
