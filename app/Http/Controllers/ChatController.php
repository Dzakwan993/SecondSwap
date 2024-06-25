<?php

namespace App\Http\Controllers;

use App\Events\NewPrivateMessage;
use App\Models\Message;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index($id)
{
    $user = Auth::user();
    
    // Ambil semua teman (misalnya semua pengguna kecuali pengguna yang sedang login)
    $friends = User::where('id', '!=', $user->id)->get();

    // Ambil pesan antara pengguna yang sedang login dan pengguna dengan ID tertentu
    $messages = Message::with('user')
        ->where(function($query) use ($id) {
            $query->where('user_id', Auth::id())
                  ->where('receiver_id', $id);
        })
        ->orWhere(function($query) use ($id) {
            $query->where('user_id', $id)
                  ->where('receiver_id', Auth::id());
        })
        ->get();

    // Kembalikan view dengan data teman dan pesan
    return view('user.chat', compact('friends', 'messages'));
}

public function getFriends($id)
{
    // Ambil semua teman (misalnya semua pengguna kecuali pengguna yang sedang login)
    return User::where('id', '!=', $id)->get();
}
  // app/Http/Controllers/ChatController.php
public function getPrivateMessages($user_id, $receiver_id)
{
    $messages = Message::with('user')
        ->where(function($query) use ($user_id, $receiver_id) {
            $query->where('user_id', $user_id)
                  ->where('receiver_id', $receiver_id);
        })
        ->orWhere(function($query) use ($user_id, $receiver_id) {
            $query->where('user_id', $receiver_id)
                  ->where('receiver_id', $user_id);
        })
        ->get();

    // Mark messages as read
    Message::where('receiver_id', auth()->user()->id)
           ->where('user_id', $receiver_id)
           ->update(['status' => 1]);

    return $messages;
}


    public function startChat($receiver_id)
{
    
    $receiver = User::find($receiver_id);
    if(!$receiver) {
        return redirect()->back()->with('error', 'User not found');
    }

   
    $messages = Message::where(function($query) use ($receiver_id) {
        $query->where('user_id', auth()->user()->id)
              ->where('receiver_id', $receiver_id);
    })->orWhere(function($query) use ($receiver_id) {
        $query->where('user_id', $receiver_id)
              ->where('receiver_id', auth()->user()->id);
    })->get();

   
    return view('privatechat', compact('receiver', 'messages'));
}

public function setPrivateMessages(Request $request, $user_id, $receiver_id)
{
    $user = Auth::user();
    if ($request->ajax()) {

        $request->validate([
            'message' => 'required|max:255'
        ]);

        $message = auth()->user()->messages()->create([
            'message' => $request->message,
            'receiver_id' => $receiver_id,
            'status' => false // Status belum dibaca
        ]);
        $message = Message::where('id', $message->id)->with('user')->first();

        broadcast(new NewPrivateMessage($message, $user))->toOthers();

        return response()->json($message);
    }
}

public function markMessagesAsRead($user_id, $friend_id)
{
    Message::where('receiver_id', $user_id)
           ->where('user_id', $friend_id)
           ->update(['status' => 1]);

    return response()->json(['status' => 'success']);
}



}