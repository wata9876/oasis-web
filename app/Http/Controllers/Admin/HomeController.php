<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function dashboard()
  {
    return view('admin.home.dashboard');
  }

  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('admin.home.create');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $form = $request->all();

    $article = new Article();
    $article->fill($form)->save();
    return redirect()->route('blog');
  }  
    
}
