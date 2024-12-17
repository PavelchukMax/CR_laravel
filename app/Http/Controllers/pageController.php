<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class pageController extends Controller
{
   
    public function profile_page()
    {
        $user = Auth::user();
        return view('profile_page', compact('user'));
    }
}