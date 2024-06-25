<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Province;
use App\Models\CarouselImage;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve all products where the user is not blocked
        $products = Product::whereHas('user', function($query) {
            $query->where('is_blocked', false);
        })->get();

        // Get all categories and provinces for the filters
        $categories = Category::all();
        $provinces = Province::all();
        $carouselImages = CarouselImage::all(); 

        return view('home', compact('products', 'categories', 'provinces', 'carouselImages'));
    }
}
