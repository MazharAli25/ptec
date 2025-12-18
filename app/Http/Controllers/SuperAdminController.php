<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Certificate;
use App\Models\Result;
use App\Models\StudentCard;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SuperAdmin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SuperAdmin $superAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuperAdmin $superAdmin)
    {
        return view('SuperAdmin.Settings.settings');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuperAdmin $superAdmin)
    {

        $validated = $request->validate([
            'changePassword' => ['required', 'string', 'confirmed'],
        ]);

        $superAdmin->update([
            'password' => Hash::make($validated['changePassword']),
        ]);

        return redirect()
            ->route('superAdmin.edit', $superAdmin)
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuperAdmin $superAdmin)
    {
        //
    }

    public function viewAdmins(Request $request)
    {
        if ($request->ajax()) {
            $admins = Admin::query();

            return DataTables::eloquent($admins)
                ->addColumn('institute_name', function ($row) {
                    return $row->institute->institute_name ?? 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <div class="flex items-center justify-center gap-1">
                    <a href="'.route('admin.edit', encrypt($row->id)).'"
                        class="inline-flex items-center px-1.5 py-1 bg-blue-500 text-white text-sm font-sm rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>
                    
                    <a href="'.route('admin.show', encrypt($row->id)).'"
                        class="inline-flex items-center px-1.5 py-1 bg-green-500 text-white text-sm font-sm rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-eye text-base"></i>
                    </a>

                    <!-- Delete Link -->
                    <form action="'.route('admin.destroy', encrypt($row->id)).'" method="POST">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit"
                            class="inline-flex items-center px-1.5 py-1 bg-red-500 text-white text-sm font-sm rounded hover:bg-red-600 transition-colors">
                            <i class="fas fa-trash text-base"></i>
                        </button>
                        </div>
                    </form>
                ';
                })
                ->addColumn('status', function ($row){
                    $status= strtolower($row->status);
                    $class = match ($status){
                        'active'=> 'bg-green-500 hover:bg-green-600',
                        'inactive'=> 'bg-red-500 hover:bg-red-600',
                    };
                    return '
                        <span
                            class="inline-flex items-center px-2 py-1.5 text-white text-sm font-medium rounded transition-colors '.$class.'">
                            '.ucfirst($status).'
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'institute_name', 'status'])
                ->make(true);
        }

        return view('SuperAdmin.viewAdmins', compact('admins'));
    }

    // public function printcer(){
    //     return view('SuperAdmin.printCertificate');
    // }

    // public function studentsResults(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $results = Result::with(['student.institute', 'ExaminationCriteria.diplomawiseCourse.diploma', 'semester', 'session'])
    //             ->get()
    //             ->groupBy(function ($item) {
    //                 return $item->StudentID.'-'.
    //                     $item->ExaminationCriteria->diplomawiseCourse->diploma->id.'-'.
    //                     $item->sessionID.'-'.
    //                     $item->semesterID;
    //             });

    //         $data = [];
    //         foreach ($results as $group) {
    //             $first = $group->first();
    //             $encryptedResultId = encrypt($first->id);
    //             $data[] = [
    //                 'id' => $first->student->id,
    //                 'name' => $first->student->name,
    //                 'institute_name' => $first->student->institute->institute_name ?? 'N/A',
    //                 'diploma_name' => $first->ExaminationCriteria->diplomawiseCourse->diploma->DiplomaName,
    //                 'semester' => $first->semester->semesterName,
    //                 'session' => $first->session->session,
    //                 'actions' => '<a href="'.route('result.show', $encryptedResultId).'" class="inline-flex items-center px-2 py-1.5 bg-green-500 text-white rounded hover:bg-green-600"><i class="fas fa-eye"></i></a>',
    //             ];
    //         }

    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->rawColumns(['actions'])
    //             ->addIndexColumn()
    //             ->make(true);
    //     }

    //     return view('SuperAdmin.Student.studentsResults');
    // }

    public function studentsResults(Request $request)
    {
        if ($request->ajax()) {

            $query = Result::with([
                'student.institute',
                'ExaminationCriteria.diplomawiseCourse.diploma',
                'semester',
                'session',
            ]);

            /* ===========================
               GLOBAL SEARCH FILTER
            ============================ */
            if ($search = $request->input('search.value')) {

                $query->where(function ($q) use ($search) {

                    // Student name
                    $q->whereHas('student', function ($s) use ($search) {
                        $s->where('name', 'like', "%{$search}%");
                    })

                    // Institute
                        ->orWhereHas('student', function ($i) use ($search) {
                            $i->where('id', 'like', "%{$search}%");
                        })
                    // Institute
                        ->orWhereHas('student.institute', function ($i) use ($search) {
                            $i->where('institute_name', 'like', "%{$search}%");
                        })

                    // Diploma
                        ->orWhereHas('ExaminationCriteria.diplomawiseCourse.diploma', function ($d) use ($search) {
                            $d->where('DiplomaName', 'like', "%{$search}%");
                        })

                    // Session
                        ->orWhereHas('session', function ($se) use ($search) {
                            $se->where('session', 'like', "%{$search}%");
                        })

                    // Semester
                        ->orWhereHas('semester', function ($sem) use ($search) {
                            $sem->where('semesterName', 'like', "%{$search}%");
                        });
                });
            }

            /* ===========================
               FETCH & GROUP
            ============================ */
            $results = $query->get()->groupBy(function ($item) {
                return $item->StudentID.'-'.
                       $item->ExaminationCriteria->diplomawiseCourse->diploma->id.'-'.
                       $item->sessionID.'-'.
                       $item->semesterID;
            });

            /* ===========================
               BUILD TABLE ROWS
            ============================ */
            $data = [];

            foreach ($results as $group) {
                $first = $group->first();

                $data[] = [
                    'id' => $first->student->id,
                    'name' => $first->student->name,
                    'institute_name' => $first->student->institute->institute_name ?? 'N/A',
                    'diploma_name' => $first->ExaminationCriteria->diplomawiseCourse->diploma->DiplomaName,
                    'semester' => $first->semester->semesterName,
                    'session' => $first->session->session,
                    'actions' => '<a href="'.route('result.show', encrypt($first->id)).'" class="bg-green-500 text-white px-2 py-1 rounded"><i class="fas fa-eye"></i></a>',
                ];
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.Student.studentsResults');
    }

    public function certificatesRequests(Request $request)
    {
        if ($request->ajax()) {
            $requests = Certificate::query();

            return DataTables::eloquent($requests)
                ->addColumn('id', function ($certificate) {
                    return $certificate->student->id;
                })
                ->filterColumn('id', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('id', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('name', function ($certificate) {
                    return $certificate->student->name;
                })
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('diploma_name', function ($certificate) {
                    return $certificate->diploma->DiplomaName;
                })
                ->filterColumn('diploma_name', function ($query, $keyword) {
                    $query->whereHas('diploma', function ($q) use ($keyword) {
                        $q->where('DiplomaName', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('session', function ($certificate) {
                    return $certificate->session->session;
                })
                ->addColumn('status', function ($certificate) {
                    $status = strtolower($certificate->status);

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
                ->addColumn('actions', function ($certificate) {

                    $approveDisabled = $certificate->status === 'approved';
                    $rejectDisabled = $certificate->status === 'rejected';

                    return '
                    <div class="flex gap-2">

                        <form method="POST" action="'.route('certificate.update', $certificate->id).'">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="status" value="approved">

                            <button type="submit"
                                class="px-3 py-1 text-sm font-medium rounded
                                '.($approveDisabled
                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                        : 'bg-green-500 text-white hover:bg-green-600').'"
                                '.($approveDisabled ? 'disabled' : '').'>
                                Approve
                            </button>
                        </form>

                        <form method="POST" action="'.route('certificate.update', $certificate->id).'">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="status" value="rejected">

                            <button type="submit"
                                class="px-3 py-1 text-sm font-medium rounded
                                '.($rejectDisabled
                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                        : 'bg-red-500 text-white hover:bg-red-600').'"
                                '.($rejectDisabled ? 'disabled' : '').'>
                                Reject
                            </button>
                        </form>

                    </div>';
                })

                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view('SuperAdmin.Certificates.certificatesRequests');
    }

    public function printCertificates(Request $request)
    {
        if ($request->ajax()) {
            $certificates = Certificate::where('status', 'approved');

            return DataTables::eloquent($certificates)
                ->addColumn('id', function ($certificate) {
                    return $certificate->student->id;
                })
                ->filterColumn('id', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('id', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('name', function ($certificate) {
                    return $certificate->student->name;
                })
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('diploma_name', function ($certificate) {
                    return $certificate->diploma->DiplomaName;
                })
                ->filterColumn('diploma_name', function ($query, $keyword) {
                    $query->whereHas('diploma', function ($q) use ($keyword) {
                        $q->where('DiplomaName', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('session', function ($certificate) {
                    return $certificate->session->session;
                })
                ->addColumn('actions', function ($certificate) {
                    return '
                        <form action="'.route('superAdmin.printFront', encrypt($certificate->id)).'" class="inline-block" method="Post">
                                '.csrf_field().method_field('POST').'
                                <input type="hidden" name="diplomaID" value="'.$certificate->diplomaID.'">
                                <input type="hidden" name="sessionID" value="'.$certificate->sessionID.'">
                                <button type="submit" class="text-[14px] bg-blue-500 text-white px-3 py-1 rounded">
                                    Print Front
                                </button>
                            </form>
                            
                            <form action="'.route('superAdmin.printBack', encrypt($certificate->id)).'" class="inline-block" method="POST">
                                '.csrf_field().method_field('POST').'
                                <input type="hidden" name="diplomaID" value="'.$certificate->diplomaID.'">
                                <input type="hidden" name="sessionID" value="'.$certificate->sessionID.'">
                                <button type="submit" class="text-[14px] bg-blue-500 text-white px-3 py-1 rounded">
                                    Print Back
                                </button>
                            </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);

        }

        return view('SuperAdmin.Certificates.printCertificates');
    }

    public function printFront(Request $request, $cerID)
    {
        $validated = $request->validate([
            'diplomaID' => 'required|exists:diplomas,id',
            'sessionID' => 'required|exists:mysessions,id',
        ]);

        $certificate = Certificate::with(['student', 'diploma', 'session'])
            ->where([
                'diplomaID' => $validated['diplomaID'],
                'sessionID' => $validated['sessionID'],
                'id' => $cerID,
            ])->with('student.studentDiplomas')
            ->firstOrFail();

        return view('SuperAdmin.Certificates.printFront', compact('certificate'));
    }

    public function printBack(Request $request, $id)
    {
        $validated = $request->validate([
            'diplomaID' => 'required|exists:diplomas,id',
            'sessionID' => 'required|exists:mysessions,id',
        ]);

        $certificate = Certificate::with(['student', 'diploma', 'session'])
            ->where([
                'diplomaID' => $validated['diplomaID'],
                'sessionID' => $validated['sessionID'],
                'id' => $id,
            ])->with('student.studentDiplomas')
            ->firstOrFail();

        $url = route('superAdmin.printBack', $certificate->id);
        $qrCode = QrCode::size(75)->generate($url);

        return view('SuperAdmin.Certificates.printBack', compact('qrCode'));
    }

    public function studentCardRequests(Request $request)
    {
        if ($request->ajax()) {
            $requests = StudentCard::with(['student', 'diploma', 'session']);

            return DataTables::eloquent($requests)
                ->addColumn('id', function ($card) {
                    return $card->student->id;
                })
                ->filterColumn('id', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('id', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('name', function ($card) {
                    return $card->student->name;
                })
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('diploma_name', function ($card) {
                    return $card->diploma->DiplomaName;
                })
                ->filterColumn('diploma_name', function ($query, $keyword) {
                    $query->whereHas('diploma', function ($q) use ($keyword) {
                        $q->where('DiplomaName', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('institute_name', function($card){
                    return $card->student->certificateInstitute->institute_name;
                })
                ->filterColumn('institute_name', function ($query, $keyword) {
                    $query->whereHas('student', function ($q) use ($keyword) {
                        $q->where('certificateInstitute', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('session', function ($card) {
                    return $card->session->session;
                })
                ->addColumn('status', function ($card) {
                    $status = strtolower($card->status);

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
                ->addColumn('actions', function ($card) {

                    $approveDisabled = $card->status === 'approved';
                    $rejectDisabled = $card->status === 'rejected';

                    return '
                        <div class="flex flex-row no-wrap gap-3 justify-center">

                            <form action="'.route('card.update', encrypt($card->id)).'" method="POST">
                                '.csrf_field().method_field('PUT').'
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                    class="px-3 py-1 text-sm font-medium rounded
                                    '.($approveDisabled
                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                        : 'bg-green-500 text-white hover:bg-green-600').'"
                                    '.($approveDisabled ? 'disabled' : '').'>
                                    Approve
                                </button>
                            </form>

                            <form action="'.route('card.update', encrypt($card->id)).'" method="POST">
                                '.csrf_field().method_field('PUT').'
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit"
                                    class="px-3 py-1 text-sm font-medium rounded
                                    '.($rejectDisabled
                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                        : 'bg-red-500 text-white hover:bg-red-600').'"
                                    '.($rejectDisabled ? 'disabled' : '').'>
                                    Reject
                                </button>
                            </form>

                        </div>
                    ';
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view('SuperAdmin.Student.cardsRequests');
    }
}
