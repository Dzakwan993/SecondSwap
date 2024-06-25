<?php

// ReviewController.php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function create($profileId)
    {
        $profile = User::findOrFail($profileId);
        return view('reviews.create', compact('profile'));
    }

    public function store(Request $request, $profileId)
    {
        $request->validate([
            'description' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $userId = auth()->id();
        $oneWeekAgo = Carbon::now()->subWeek();

        // Periksa apakah pengguna sudah memberikan ulasan kepada pengguna yang sama dalam satu minggu terakhir
        $existingReview = Review::where('user_id', $userId)
            ->where('profile_id', $profileId)
            ->where('created_at', '>=', $oneWeekAgo)
            ->first();

        if ($existingReview) {
            return redirect()->route('profile.show', $profileId)
                ->with('error', 'Anda hanya dapat memberikan satu ulasan dalam satu minggu kepada pengguna yang sama.');
        }

        Review::create([
            'user_id' => $userId,
            'profile_id' => $profileId,
            'description' => $request->description,
            'rating' => $request->rating,
        ]);

        return redirect()->route('profile.show', $profileId)->with('success', 'Ulasan berhasil ditambahkan.');
    }

    public function show($profileId)
    {
        $user = User::findOrFail($profileId);
        $averageRating = $user->averageRating();

        return view('profile.show', compact('user', 'averageRating'));
    }
}
