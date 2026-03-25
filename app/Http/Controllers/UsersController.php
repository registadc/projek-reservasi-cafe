<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }
}