<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
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
        $results= Result::all();
        return view('SuperAdmin.addResult', compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'status'=> ['required', 'string', 'in:Pass,Fail,UFM', 'unique:results'],
        ]);

        Result::create([
            'status'=>$validated['status'],
        ]);

        return redirect()->route('result.create')->with('success', 'Result status added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
