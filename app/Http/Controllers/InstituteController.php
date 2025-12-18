<?php

namespace App\Http\Controllers;

use App\Models\institute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $institutes = Institute::query();

            return DataTables::eloquent($institutes)
                ->addColumn('actions', function ($inst) {
                    return '
                    <a href="'.route('institute.edit', encrypt($inst->id)).'"
                        class="inline-flex items-center px-2 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="'.route('institute.destroy', $inst->id).'"
                        method="POST"
                        class="inline-block ml-1"
                        onsubmit="return confirm(\'Are you sure?\')">
                        '.csrf_field().method_field('DELETE').'
                        <button
                            class="inline-flex items-center px-2 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                ';
                })
                ->editColumn('address', function ($inst) {
                    return $inst->address ?? 'Nill';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        // Normal page load
        return view('SuperAdmin.institute.add_institute');
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
            'instituteName' => 'required',
            'address' => 'nullable',
            'status' => 'nullable',
        ]);

        $institute = Institute::create([
            'institute_name' => $validated['instituteName'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('institute.create')->with('success', 'Institute added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(institute $institute) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(institute $institute)
    {
        $institute = $institute;

        return view('SuperAdmin.institute.editInstitute', compact('institute'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, institute $institute)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'address' => ['nullable', 'string'],
        ]);

        $institute->update([
            'institute_name' => $validated['name'],
            'address' => $validated['address'],
        ]);

        return redirect()->back()->with('success', 'Institute updated successfully');
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
