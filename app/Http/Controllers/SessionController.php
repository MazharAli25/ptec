<?php

namespace App\Http\Controllers;

use App\Models\mysession;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = mysession::get();

        return view('SuperAdmin.viewSessions', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $sessions = mysession::query();

            return DataTables::eloquent($sessions)
                ->addColumn('actions', function ($row) {
                    return '
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-edit text-base"></i>
                    </a>

                    <!-- Delete Link -->
                    <a href="#"
                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-base"></i>
                    </a>
                ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('SuperAdmin.session');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'session' => ['required'],
        ]);

        $existingAssignment = mysession::where('session', $validated['session'])
            ->exists();

        if ($existingAssignment) {
            return redirect()->back()->with('error', 'This session is already created.');
        }

        mysession::create([
            'session' => $validated['session'],
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
