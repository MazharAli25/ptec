<?php

namespace App\Http\Controllers;

use App\Models\mysession;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions= mysession::get();
        return view('SuperAdmin.viewSessions', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessions= mysession::get();
        return view('SuperAdmin.session', compact('sessions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sessionStart'=> ['required', 'date'],
            'sessionEnd'=> ['required', 'date'],
        ]);

        mysession::create([
            'sessionStart'=> $validated['sessionStart'],
            'sessionEnd'=> $validated['sessionEnd'],
        ]);
        
        return redirect()->route('session.create')->with('success', 'session created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(mysession $mysession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mysession $mysession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mysession $mysession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mysession $mysession)
    {
        //
    }
}
