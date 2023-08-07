<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormAdminMail;
use App\Mail\FormUserMail;

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
    public function confirm(MailRequest $request): View
    {
        return view('mail.confirm', ['contents' => $request->validated()]);
    }

    /**
     * Display the login view.
     */
    public function send(MailRequest $request): View
    {
        $form_data = $request->validated();
        $email_admin = config('mail.email_admin');
        $email_user  = $form_data['email'];

        // 管理者宛メール
        Mail::to($email_admin)->send( new FormAdminMail($form_data) );
        // ユーザー宛メール
        Mail::to($email_user)->send( new FormUserMail($form_data) );
        
        // 二重送信対策のためトークンを再発行
        $request->session()->regenerateToken();
        
        return view('mail.conmplete', ['contents' => $form_data]);
    }

}
