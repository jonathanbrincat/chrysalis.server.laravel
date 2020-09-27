<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
  public function index() {
    $title = 'Welcome To Laravel';

    //DEVNOTE: There are 2 ways to pass a variable to a view
    // return view('pages.index', compact('title'));
    // return view('pages.index')->with('title', $title); //with(what to reference variable inside of the view, variable being passed)

    return view('pages.index');
  }

  public function about() {
    return view('pages.about');
  }

  public function services() {
    $data = array(
      'title' => 'Services',
      'services' => ['Web Design', 'Programming', 'SEO']
    );

    return view('pages.services')->with($data);
    // return view('pages.services');
  }
}
