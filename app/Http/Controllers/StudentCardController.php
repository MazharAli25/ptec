<?php

namespace App\Http\Controllers;

use App\Models\StudentCard;
use App\Models\StudentDiploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StudentCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        if ($request->ajax()) {
            $requests = StudentCard::with(['student'])
                ->whereHas('student', function ($query) use ($adminId) {
                    $query->where('instituteId', $adminId);
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
                $query->whereHas('student', function ($q) use ($keyword) {
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
                        <button type="button" data-modal-target="deleteModal" data-id="'.encrypt($row->id).'"
                                        class="inline-flex items-center px-2 no-underline py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        Cancel
                                    </button>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
        // $requests = StudentCard::with(['student'])
        //     ->whereHas('student', function ($query) use ($adminId) {
        //         $query->where('instituteId', $adminId);
        //     })
        //     ->get();

        return view('Admin.Student.requestedCards');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        if ($request->ajax()) {
            $studentDiplomas = StudentDiploma::with(['student', 'diploma', 'semester'])
                ->whereHas('student', function ($query) use ($adminId) {
                    $query->where('instituteId', $adminId);
                });

            return DataTables::eloquent($studentDiplomas)
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
                ->addColumn('actions', function ($row) {
                    return '
                         <form action="'.route('card.store').'" method="POST">
                                    '.csrf_field().'
                                    <input type="hidden" name="student_id" value="'.$row->student->id.'">
                                    <input type="hidden" name="diploma_id" value="'.$row->diploma->id.'">
                                    <input type="hidden" name="session_id" value="'.$row->diploma->session->id.'">

                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        Request ID Card
                                    </button>
                                </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);

        }

        // ->get();
        return view('Admin.Student.requestCard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'diploma_id' => 'required|exists:diplomas,id',
            'session_id' => 'required|exists:mysessions,id',
        ]);

        // Check for duplicates
        $exists = StudentCard::where('studentID', $validated['student_id'])
            ->where('diplomaID', $validated['diploma_id'])
            ->where('sessionID', $validated['session_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'ID card already requested for this student, diploma, and session.');
        }

        // Create new certificate record
        StudentCard::create([
            'studentID' => $validated['student_id'],
            'diplomaID' => $validated['diploma_id'],
            'sessionID' => $validated['session_id'],
            'status' => 'Pending',
        ]);

        return redirect()->route('card.index')
            ->with('success', 'Card request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentCard $studentCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentCard $studentCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentCard $studentCard)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $studentCard->update(['status' => $validated['status']]);

        if ($studentCard->update()) {
            return redirect()->route('superCard.requests')
                ->with('success', 'Certificate '.ucfirst($validated['status']).' successfully.');
        } else {
            dd('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentCard $studentCard)
    {
        $studentCard->delete();

        return redirect()
            ->back()
            ->with('success', 'Student Card request cancelled successfully.');
    }

    public function printCards(Request $request)
    {
        if ($request->ajax()) {
            $cards = StudentCard::where('status', 'approved ');

            return DataTables::eloquent($cards)
                ->addColumn('id', function ($card) {
                    return $card->student->id;
                })
                ->addColumn('name', function ($card) {
                    return $card->student->name;
                })
                ->addColumn('diploma_name', function ($card) {
                    return $card->diploma->DiplomaName;
                })
                ->addColumn('session', function ($card) {
                    return $card->session->session;
                })
                ->addColumn('actions', function ($card) {
                    return '
                        <form action="'.route('card.printFront', encrypt($card->id)).'" class="inline-block" method="Post">
                                '.csrf_field().method_field('POST').'
                                <input type="hidden" name="diplomaID" value="'.$card->diplomaID.'">
                                <input type="hidden" name="sessionID" value="'.$card->sessionID.'">
                                <button type="submit" class="text-[14px] bg-blue-500 text-white px-3 py-1 rounded">
                                    Print Front
                                </button>
                            </form>
                            
                            <form action="'.route('card.printBack', encrypt($card->id)).'" class="inline-block" method="POST">
                                '.csrf_field().method_field('POST').'
                                <input type="hidden" name="diplomaID" value="'.$card->diplomaID.'">
                                <input type="hidden" name="sessionID" value="'.$card->sessionID.'">
                                <button type="submit" class="text-[14px] bg-blue-500 text-white px-3 py-1 rounded">
                                    Print Back
                                </button>
                            </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.Student.printCards');
    }

    public function printFront(Request $request, $id)
    {
        $validated = $request->validate([
            'diplomaID' => 'required|exists:diplomas,id',
            'sessionID' => 'required|exists:mysessions,id',
        ]);

        $card = StudentCard::with(['student', 'diploma', 'session'])
            ->where([
                'diplomaID' => $validated['diplomaID'],
                'sessionID' => $validated['sessionID'],
                'id' => $id,
            ])->with('student.studentDiplomas')
            ->firstOrFail();

        return view('SuperAdmin.Student.printFront', compact(['card']));
    }

    public function printBack(Request $request, $id)
    {
        $validated = $request->validate([
            'diplomaID' => 'required|exists:diplomas,id',
            'sessionID' => 'required|exists:mysessions,id',
        ]);

        $card = StudentCard::with(['student', 'diploma', 'session'])
            ->where([
                'diplomaID' => $validated['diplomaID'],
                'sessionID' => $validated['sessionID'],
                'id' => $id,
            ])->with('student.studentDiplomas')
            ->firstOrFail();

        $issuedDate = now()->format('d M Y');

        return view('SuperAdmin.Student.printBack', compact(['card', 'issuedDate']));
    }
}
