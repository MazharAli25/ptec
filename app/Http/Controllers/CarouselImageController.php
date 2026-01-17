<?php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarouselImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $carouselImages = CarouselImage::query();

            return datatables()->of($carouselImages)
                ->addIndexColumn()

                ->addColumn('images', function ($row) {
                    $html = '<div class="flex gap-2">';
                    $html .= '<img src="'.asset("carousel_images/{$row->image1}").'" class="w-24 h-16 object-cover rounded border">';
                    $html .= '<img src="'.asset("carousel_images/{$row->image2}").'" class="w-24 h-16 object-cover rounded border">';
                    $html .= '<img src="'.asset("carousel_images/{$row->image3}").'" class="w-24 h-16 object-cover rounded border">';
                    $html .= '</div>';

                    return $html;
                })
                ->addColumn('status', function ($row) {
                    $statusClass = $row->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';

                    return '<button class="px-3 py-1 status-btn rounded-full text-sm font-medium '.$statusClass.'" data-id="'.encrypt($row->id).'">'.ucfirst($row->status).'</button>';
                })

                // Actions column (edit/delete buttons)
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="'.route('carousel.edit', encrypt($row->id)).'" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700"><i class="fas fa-edit"></i></a>';
                    $delete = '<form action="'.route('carousel.destroy', encrypt($row->id)).'" method="POST" class="inline-block ml-2" onsubmit="return confirm(\'Delete this carousel set?\')">'
                            .csrf_field()
                            .method_field('DELETE')
                            .'<button type="submit" class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700"><i class="fas fa-trash"></i></button>'
                            .'</form>';

                    return $edit.$delete;
                })

                ->rawColumns(['images', 'actions', 'status']) // allow HTML in these columns
                ->make(true);
        }

        return view('Admin.FrontEnd.Carousel.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.FrontEnd.Carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|size:3',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp',
        ], [
            'images.required' => 'Please select all 3 images.',
            'images.size' => 'Exactly 3 images are required.',
            'images.*.required' => 'Each image field is required.',
            'images.*.image' => 'Only image files are allowed.',
        ]);

        $images = $request->images;
        $images = collect($images)->map(function ($image) {
            $filename = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('carousel_images'), $filename);

            return $filename;
        })->toArray();
        CarouselImage::create([
            'image1' => $images[0],
            'image2' => $images[1],
            'image3' => $images[2],
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Carousel images uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarouselImage $carouselImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarouselImage $carouselImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarouselImage $carouselImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarouselImage $carousel)
    {
        $carousel->delete();
        return redirect()->back()->with('success', 'Carousel images deleted successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $carouselImage = CarouselImage::findOrFail($id);

        // Toggle status
        $carouselImage->status = $carouselImage->status === 'active' ? 'inactive' : 'active';
        $carouselImage->save();

        return response()->json(['success' => true, 'new_status' => $carouselImage->status, 'encrypted_id' => encrypt($carouselImage->id)]);
    }
}
