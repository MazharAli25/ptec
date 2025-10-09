<?php

namespace App\Http\Controllers;

use App\Models\institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insts = Institute::get();
        return view('SuperAdmin.add_institute', compact('insts'));
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
        $validated = $request->validate([
            'instituteName'=> 'required',
            'address'=> 'required',
            'directorName'=> 'required',
            'directorEmail'=> 'required',
            'phone'=> 'required',
            'status'=> 'nullable',
        ]);

        Institute::create([
            'institute_name'=> $validated['instituteName'],
            'address'=>$validated['address'],
            'director_name'=>$validated['directorName'],
            'director_email'=>$validated['directorEmail'],
            'director_phone'=>$validated['phone'],
            'status'=>$validated['status']
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
