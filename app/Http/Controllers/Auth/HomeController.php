<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * Display the login view.
    */
    public function dashboard(): View
    {
        return view('user.home.dashboard');
    }
}
