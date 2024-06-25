<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselImage;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::all();
        return view('admin.carousel.index', compact('carouselImages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/carousel'), $imageName);

        CarouselImage::create(['image_path' => $imageName]);

        return back()->with('success', 'Image uploaded successfully.');
    }

    public function destroy($id)
    {
        $carouselImage = CarouselImage::findOrFail($id);
        unlink(public_path('images/carousel/' . $carouselImage->image_path));
        $carouselImage->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
