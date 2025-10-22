<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Institute;
use App\Models\Student;
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
            'phone'=> $validated['phone'],
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


    public function requestCertificate(Request $request)
    {
        $query = \App\Models\Student::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('fatherName')) {
            $query->where('fatherName', 'like', "%{$request->fatherName}%");
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        
        $reqStudents = $request->hasAny(['name', 'fatherName', 'email'])
            ? $query->get()
            : collect();

        return view('Admin.requestCertificate', compact('reqStudents'));
    }
}
