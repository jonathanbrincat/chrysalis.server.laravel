<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class DashboardController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
      $this->middleware('auth'); //DEVNOTE: enforces authorised access to the controller(alternative to declaring on the routes or using conditional logic based on the auth() status)
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $user_id = auth()->user()->id; // get current logged in user's id
    
    $user = User::find($user_id); // search the User model and find the matching entry by id

    return view('dashboard')->with('posts', $user->posts); //returned with the relationship '->posts' expressed in the model(which will grant access to the returns of that relationship - query made behind the scenes)

    // $user_id = auth()->user()->id;
    // $user = User::find($user_id);
    // return view('dashboard')->with('posts', $user->posts);
  }
}
