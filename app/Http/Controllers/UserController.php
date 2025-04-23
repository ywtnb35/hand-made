<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        return view('user.mypage',compact('user'));
    }
}
