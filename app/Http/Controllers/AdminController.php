<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Certificate;
use App\Models\Diploma;
use App\Models\Institute;
use App\Models\Student;
use App\Models\StudentDiploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        $students = Student::where('instituteId', $adminId)->get();
        $pending = Certificate::whereHas('student', function ($query) use ($adminId) {
            $query->where('instituteId', $adminId);
        })->where('status', 'pending')->get();
        $approved = Certificate::whereHas('student', function ($query) use ($adminId) {
            $query->where('instituteId', $adminId);
        })->where('status', 'approved')->get();

        return view('Admin.dashboard', compact(['students', 'pending', 'approved']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $insts = Institute::get();
        $admins = Admin::get();

        return view('SuperAdmin.add_admin', compact(['insts', 'admins']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institute_id' => 'required|exists:institutes,id',
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|digits:11|unique:admins,phone',
            'password' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        Admin::create([
            'institute_id' => $validated['institute_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.create')
            ->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $admin = $admin;

        return view('SuperAdmin.showAdmin', compact(['admin']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $admin = $admin;
        $insts = institute::get();

        return view('SuperAdmin.editAdmin', compact(['admin', 'insts']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'institute_id' => 'required',
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'phone' => ['required', 'unique:students,phone'],
            'status' => 'required',
        ]);

        $admin->update([
            'institute_id' => $validated['institute_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.create')->with('success', 'Admin Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete($admin);

        return redirect()->back()->with('success', 'institute Deleted Successfully');
    }

    // public function requestCertificate(Request $request)
    // {
    //     $query = Student::with('studentDiplomas.diploma.session');

    //     if ($request->filled('id')) {
    //         $query->where('id', $request->id); // exact match is better here
    //     }

    //     $reqStudents = $request->filled('id')
    //         ? $query->get()
    //         : collect();

    //     return view('Admin.requestCertificate', compact('reqStudents'));
    // }

    // public function requestedCertificates()
    // {
    // return view('Admin.requestCertificate');
    // }

    public function requestedCertificates(Request $request)
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        if ($request->ajax()) {
            $requests = Certificate::with(['student'])
                ->whereHas('student', function ($query) use ($adminId) {
                    $query->where('InstituteId', $adminId);
                });

            return DataTables::eloquent($requests)
                ->addColumn('id', function ($row) {
                    return $row->student->id;
                })
                ->filterColumn('id', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('id', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('student_name', function ($row) {
                    return $row->student->name;
                })
                ->filterColumn('student_name', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('father_name', function ($row) {
                    return $row->student->fatherName;
                })
                ->filterColumn('father_name', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('fatherName', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('diploma_name', function ($row) {
                    return $row->diploma->DiplomaName;
                })
                ->filterColumn('diploma_name', function ($query, $keyword) {
                    $query->whereHas('diploma', function ($q) use ($keyword) {
                        $q->where('DiplomaName', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('session_name', function ($row) {
                    return $row->session->session;
                })
                ->addColumn('status', function ($row) {
                    $status = strtolower($row->status);

                    $class = match ($status) {
                        'pending' => 'bg-yellow-500 hover:bg-yellow-600',
                        'approved' => 'bg-green-500 hover:bg-green-600',
                        'rejected' => 'bg-red-500 hover:bg-red-600',
                        default => 'bg-gray-500'
                    };

                    return '
                        <span
                            class="inline-flex items-center px-2 py-1.5 text-white text-sm font-medium rounded transition-colors '.$class.'">
                            '.ucfirst($status).'
                        </span>
                    ';
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <button type="button" data-modal-target="deleteModal" data-id="'.$row->id.'"
                                        class="inline-flex items-center px-2 no-underline py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        Cancel
                                    </button>
                    ';
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view('Admin.Certificates.RequestedCertificates');
    }

    public function registeredStudentsList(Request $request)
    {
        $instituteID = Auth::guard('admin')->user()->institute_id;
        if ($request->ajax()) {
            $students = Student::where('instituteId', $instituteID)
                ->whereDoesntHave('studentDiplomas');

            return DataTables::eloquent($students)
                ->addColumn('actions', function ($student) {
                    return '
                 <!-- Edit Link -->
                 <div class= "flex items-center justify-center gap-2">
                    <a href="'.route('student.edit', encrypt($student)).'"
                        class="no-underline inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>
                    <!-- View Link -->
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
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('Admin.registeredStudents');
    }

    public function assignedDiplomas(Request $request)
    {
        $instituteID = Auth::guard('admin')->user()->institute_id;

        if ($request->ajax()) {
            $students = StudentDiploma::with(['student', 'diploma', 'session'])
                ->whereHas('student', function ($query) use ($instituteID) {
                    $query->where('instituteId', $instituteID);
                }); // or add filtering for institute if needed

            return DataTables::of($students)
                ->addColumn('id', function ($row) {
                    return $row->student->id;
                })
                ->filterColumn('id', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('id', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('student_name', function ($row) {
                    return $row->student->name;
                })
                ->filterColumn('student_name', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('diploma_name', function ($row) {
                    return $row->diploma->DiplomaName;
                })
                ->filterColumn('diploma_name', function ($query, $keyword) {
                    $query->whereHas('diploma', function ($q) use ($keyword) {
                        $q->where('DiplomaName', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('session_name', function ($row) {
                    return $row->session->session;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->student->status;
                    $color = $status === 'Active' ? 'bg-green-100 text-green-800' : ($status === 'Inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');

                    return '<button class="status-btn" data-id="'.encrypt($row->student->id).'">
                            <span class="px-3 py-1 rounded-full text-sm font-medium '.$color.'">'.$status.'</span>
                        </button>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <div class="flex justify-center gap-2">
                        <a href="'.route('studentDiploma.edit', encrypt($row->ID)).'" class="px-2 py-1.5 bg-blue-500 text-white rounded">
                            <i class="fa-solid fa-pen-to-square text-[16px]"></i>
                        <a>
                        <a href="'.route('studentDiploma.show', encrypt($row->ID)).'" class="px-2 py-1.5 bg-green-500 text-white rounded">
                            <i class="fas fa-eye text-base"></i>
                        </a>
                        <form action="'.route('studentDiploma.destroy', encrypt($row->ID)).'" method="POST" class="inline-block">
                            '.csrf_field().method_field('DELETE').'
                            <button class="px-2 py-1.5 bg-red-500 text-white rounded">
                                <i class="fas fa-trash text-base"></i>
                            </button>
                        </form>
                    </div>
                ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('Admin.Student.assignedDiplomas');
    }


}
