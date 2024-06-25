<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider; // Add this line to import RouteServiceProvider

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Check if the user is blocked
        if ($user->is_blocked) {
            Auth::logout(); // Logout the blocked user
            return redirect()->back()->with('error', 'Your account has been blocked.');
        }

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }
}
