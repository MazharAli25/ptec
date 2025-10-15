<?php

namespace App\Http\Controllers;

use App\Models\institute;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $insts= institute::get();
        // return view('SuperAdmin.viewInstitutes', compact('insts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $insts = Institute::get();
        return view('SuperAdmin.add_institute', compact('insts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'instituteName'=> 'required',
            'address'=> 'required',
            'directorName'=> 'required',
            'directorEmail'=> 'required',
            'phone'=> 'required',
            'password'=> 'required',
            'status'=> 'nullable',
        ]);

        $institute=Institute::create([
            'institute_name'=> $validated['instituteName'],
            'address'=>$validated['address'],
        ]);

        Admin::create([
            'institute_id'=> $institute->id,
            'name'=> $validated['directorName'],
            'email'=> $validated['directorEmail'],
            'phone'=> $validated['phone'],
            'password'=> Hash::make($validated['password']),
            'status'=> $validated['status'],
        ]);

        return redirect()->route('institute.index')->with('success', 'Institute added successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(institute $institute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(institute $institute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, institute $institute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(institute $institute)
    {
        //
    }
}
