<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, Product $product)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($favorite) {
            $favorite->delete();
            $isFavorited = false;
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
            $isFavorited = true;
        }

        return response()->json(['isFavorited' => $isFavorited]);
    }

    public function index()
    {
        $favorites = Auth::user()->favorites;
        return view('favorites', compact('favorites'));
    }

    public function destroy(Favorite $favorite)
    {
        $favorite->delete();
        return back()->with('success', 'Product unfavorited successfully.');
    }
}
