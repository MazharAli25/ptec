<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Student;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $data)
    {
       $student = Student::with(['institute', 'session', 'course'])->findOrFail($data);

        // Now you can safely access relationships
        $instituteName = $student->institute->institute_name;
        $sessionName = $student->session->sessionName;
        $courseTitle = $student->course->courseName;
        $name=$student->institute->institute_name;
        dd($name);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
    }
}
