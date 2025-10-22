<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use App\Models\Subject;
use Illuminate\Http\Request;

class MarksController extends Controller
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
        $marks = Marks::all();
        $subjects= Subject::all();
        return view('SuperAdmin.Marks.addMarks', compact('marks', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'marks'=>'required|unique:marks,marks|max:5',
            'subject_id'=>'required|exists:subjects,id',
        ]);

        Marks::create([
            'marks'=>$validated['marks'],
            'subject_id'=>$validated['subject_id'],
        ]);

        return redirect()->route('marks.create')->with('success', 'Marks Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marks $marks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marks $marks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marks $marks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marks $marks)
    {
        //
    }
}
