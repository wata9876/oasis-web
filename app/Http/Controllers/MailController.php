<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MailController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('mail.index');
    }

    /**
     * Display the login view.
     */
    public function confirm(): View
    {
        echo 'メール確認';
        return view('mail.index');
    }

}
