<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Certificate;
use App\Models\Diploma;
use App\Models\Institute;
use App\Models\Student;
use App\Models\StudentDiploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.dashboard');
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
            'institute_id' => 'required',
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'phone' => ['required', 'unique:students,phone'],
            'status' => 'required',
        ]);

        Admin::create([
            'institute_id' => $validated['institute_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.create')->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
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

    public function requestedCertificates(){
        $requests= Certificate::get();
        return view('Admin.Certificates.RequestedCertificates', compact('requests'));
    }
}
