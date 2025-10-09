<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Institute;
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
        $insts= Institute::get();
        $admins= Admin::get();
        return view('SuperAdmin.add_admin', compact(['insts', 'admins']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'institute_id'=> 'required',
            'name'=> 'required',
            'password'=> 'required',
            'email'=> 'required',
            'status'=> 'required',
        ]);

        Admin::create([
            'institute_id'=> $validated['institute_id'],
            'name'=> $validated['name'],
            'email'=> $validated['email'],
            'password'=> Hash::make($validated['password']),
            'status'=> $validated['status'],
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
}
