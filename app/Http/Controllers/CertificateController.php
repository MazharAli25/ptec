<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Student;
use App\Models\StudentDiploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
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
    public function create()
    {
        $adminInstituteId = Auth::guard('admin')->user()->institute_id;

        // Only fetch StudentDiplomas where the student belongs to the same institute as the admin
        $studentDiplomas = StudentDiploma::with(['student', 'diploma', 'semester'])
            ->where(function ($query) use ($adminInstituteId) {
                $query->whereHas('student', function ($q) use ($adminInstituteId) {
                    $q->where('instituteId', $adminInstituteId);
                });
            })
            ->get();

        // Now, $studentDiplomas only includes records relevant to this admin
        return view('Admin.requestCertificate', compact('studentDiplomas'));
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
        $exists = Certificate::where('student_id', $validated['student_id'])
            ->where('diplomaID', $validated['diploma_id'])
            ->where('sessionID', $validated['session_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Certificate already requested for this student, diploma, and session.');
        }

        // Create new certificate record
        Certificate::create([
            'student_id' => $validated['student_id'],
            'diplomaID' => $validated['diploma_id'],
            'sessionID' => $validated['session_id'],
            'status' => 'Pending',
        ]);

        return redirect()->route('admin.viewCertificates')
            ->with('success', 'Certificate request created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $certificate->update(['status' => $validated['status']]);

        return redirect()->route('superAdmin.certificatesRequests')->with('success', 'Certificate ' . ucfirst($validated['status']) . ' successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()
            ->back()
            ->with('success', 'Certificate request cancelled successfully.');
    }
}
