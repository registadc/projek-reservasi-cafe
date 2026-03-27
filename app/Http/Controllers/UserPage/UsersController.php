<?php

namespace App\Http\Controllers\UserPage;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }
}