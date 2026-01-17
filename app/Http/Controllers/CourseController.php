<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $courses = Course::query();

            return DataTables::eloquent($courses)
                ->addColumn('level', function ($course) {
                    return $course->courseLevel ?? '-';
                })
                ->addColumn('fees', function ($course) {
                    return $course->courseFees ?? '-';
                })
                ->addColumn('thumbnail', function ($course) {
                    if ($course->courseThumbnail) {
                        return '<img src="'.asset('storage/photos/'.$course->courseThumbnail).'" alt="Thumbnail" class="w-16 h-16 object-cover rounded">';
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('actions', function ($course) {
                    $edit = '<a href="'.route('course.update', encrypt($course->id)).'" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700"><i class="fas fa-edit"></i></a>';
                    $delete = '<form action="'.route('course.destroy', encrypt($course->id)).'" method="POST" class="inline-block ml-2" onsubmit="return confirm(\'Delete this course?\')">'
                            .csrf_field()
                            .method_field('DELETE')
                            .'<button type="submit" class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700"><i class="fas fa-trash"></i></button>'
                            .'</form>';

                    return $edit.$delete;

                })
                ->rawColumns(['actions', 'thumbnail'])
                ->make(true);
        }

        return view('SuperAdmin.viewCourses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::get();

        return view('SuperAdmin.addcourse', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'courseName' => ['required', 'string', 'unique:courses,courseName'],
            'description' => ['nullable', 'string'],
            'courseLevel' => ['nullable', 'string'],
            'courseFees' => ['nullable', 'numeric'],
            'courseThumbnail' => ['nullable', 'image', 'max:2048'],
            'currency' => ['nullable'],
        ]);

        if ($request->hasFile('courseThumbnail')) {
            $file = $request->file('courseThumbnail');
            $filename = time().'.'.$file->getClientOriginalName();
            $file->move(public_path('storage/photos'), $filename);
            $validated['courseThumbnail'] = $filename;
        }

        if (! empty($validated['courseFees'])) {
            $price = $validated['courseFees'].' '.$validated['currency'];
        } else {
            $price = null;
        }

        Course::create([
            'courseName' => $validated['courseName'],
            'description' => $validated['description'],
            'courseLevel' => $validated['courseLevel'],
            'courseFees' => $price,
            'courseThumbnail' => $filename ?? null,
        ]);

        return redirect()->route('course.create')->with('success', 'subject added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $course = $course;

        return view('SuperAdmin.editCourses', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'edit_courseName' => ['required', 'string'],
        ]);

        $course->update([
            'courseName' => $validated['edit_courseName'],
        ]);

        return redirect()->route('course.index')->with('success', 'course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Course Deleted Successfully');
    }

    public function userViewCourse(Course $course){
        $course= $course;
        return view('User.Courses.viewCourse', compact(['course']));
    }
}
