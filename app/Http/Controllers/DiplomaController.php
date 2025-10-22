<?php

namespace App\Http\Controllers;

use App\Models\Diploma;
use App\Models\DiplomawiseCourses;
use App\Models\mysession;
use Illuminate\Http\Request;

class DiplomaController extends Controller
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
        $diplomas = Diploma::all();
        $sessions = mysession::all();
        return view('SuperAdmin.Diploma.addDiploma', compact(['diplomas', 'sessions']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'sessionID' => 'required|exists:mysessions,id',
            'diplomaName' => 'required|string|max:255',
        ]);
        $existingAssignment = Diploma::where('DiplomaName', $validated['diplomaName'])
            ->where('sessionID', $validated['sessionID'])
            ->exists();

        if ($existingAssignment) {
            return redirect()->back()->with('error', 'This diploma is already assigned to this diploma in the selected session.');
        }
        Diploma::create([
            'SessionID' => $validated['sessionID'],
            'DiplomaName' => $validated['diplomaName'],
        ]);
        return redirect()->route('diploma.create')->with('success', 'Diploma added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diploma $diploma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diploma $diploma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diploma $diploma)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diploma $diploma)
    {
        //
    }

    public function assignedCourses(){
        $diplomas = DiplomawiseCourses::with('diploma')->get();
        return view('SuperAdmin.Diploma.assignedCourses', compact('diplomas'));
    }
}
