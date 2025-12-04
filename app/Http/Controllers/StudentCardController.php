<?php

namespace App\Http\Controllers;

use App\Models\StudentCard;
use App\Models\Student;
use App\Models\StudentDiploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class StudentCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        $requests = StudentCard::with(['student'])
        ->whereHas('student', function ($query) use ($adminId){
            $query->where('instituteId', $adminId);
        })
        ->get();
        return view('Admin.Student.requestedCards', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adminId = Auth::guard('admin')->user()->institute_id;
        $studentDiplomas = StudentDiploma::with(['student', 'diploma', 'semester'])
        ->whereHas('student', function ($query) use ($adminId){
            $query->where('instituteId', $adminId);
        })
        ->get();
        return view('Admin.Student.requestCard', compact('studentDiplomas'));
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
                ->with('success', 'Certificate ' . ucfirst($validated['status']) . ' successfully.');
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

    public function printCards()
    {
        $cards = StudentCard::where('status', 'approved ')->get();
        return view('SuperAdmin.Student.printCards', compact('cards'));
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
