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
        return view('SuperAdmin.institute.add_institute', compact('insts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'instituteName'=> 'required',
            'address'=> 'nullable',
            'status'=> 'nullable',
        ]);

        $institute=Institute::create([
            'institute_name'=> $validated['instituteName'],
            'address'=>$validated['address'],
        ]);

        return redirect()->route('institute.create')->with('success', 'Institute added successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(institute $institute)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(institute $institute)
    {
        $institute= $institute;
        return view('SuperAdmin.institute.editInstitute', compact('institute'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, institute $institute)
    {
        $validated = $request->validate([
            'name'=> ['required', 'string'],
            'address'=> ['nullable', 'string'],
        ]);

        $institute->update([
            'institute_name'=> $validated['name'],
            'address'=> $validated['address'],
        ]);
        
        return redirect()->route('institute.create')->with('success', 'Institute updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(institute $institute)
    {
        $institute->delete();
        return redirect()->route('institute.create')->with('success', 'Institute deleted successfully');
    }
}
