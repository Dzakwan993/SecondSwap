<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showAboutSecondSwap()
    {
        return view('about-second-swap');
    }

    public function showHubungiKami()
    {
        return view('hubungi-kami');
    }

    public function showTentangKami()
    {
        return view('tentang-kami');
    }
}

