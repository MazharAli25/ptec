<?php

namespace App\Http\Controllers;

use App\Models\institute;
use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\Certificate;
use App\Models\Result;
use App\Models\StudentDiploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function viewAdmins()
    {
        $admins = Admin::get();
        return view('SuperAdmin.viewAdmins', compact('admins'));
    }

    // public function printcer(){
    //     return view('SuperAdmin.printCertificate');
    // }

    public function studentsResults()
    {
        $results = Result::get();
        return view('SuperAdmin.Student.studentsResults', compact('results'));
    }

    public function certificatesRequests()
    {
        $requests = Certificate::get();
        return view('SuperAdmin.Certificates.certificatesRequests', compact('requests'));
    }

    public function printCertificates()
    {
        $certificates = Certificate::get();
        return view('SuperAdmin.Certificates.printCertificates', compact('certificates'));
    }

    // public function printFront(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'diplomaID' => 'required|exists:diplomas,id',
    //         'sessionID' => 'required|exists:mysessions,id',
    //     ]);
    //     $diplomaID = $validated['diplomaID'];
    //     $sessionID = $validated['sessionID'];
    //     $certificate = Certificate::with('student')->where('id', $id)->where('diplomaID', $diplomaID)->where('sessionID', $sessionID)->first();

    //     return view('SuperAdmin.Certificates.printFront', compact(['certificate']));
    // }

    public function printFront(Request $request, $id)
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

        $issuedDate = now()->format('d M Y'); // e.g. 31 Oct 2025

        return view('SuperAdmin.Certificates.printFront', compact('certificate', 'issuedDate'));
    }


    public function printBack()
    {
        return view('SuperAdmin.Certificates.printBack');
    }
}
