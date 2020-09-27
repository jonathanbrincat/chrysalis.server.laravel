<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // load utility Storage library

use DB; // When not using Eloquent and constructing raw SQL queries you bring in the Database library
use App\Post;

// Eloquent ORM Object Relational Mapper used by default in Controllers

class PostController extends Controller
{
  public function __construct() {
    $this->middleware('auth', [ 'except' => ['index', 'show'] ]);
    //DEVNOTE: enforces authorised access to the controller(alternative to declaring on the routes or using conditional logic based on the auth() status)
    // DEVNOTE: exceptions can be allowed by passing in an array as a 2nd argument; declaring the methods on the controller that are allowed for unauthenticated access
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    // $posts = Post::all(); // DEVNOTE: fetches all of the data in this table
    // $posts = Post::orderBy('title', 'desc')->take(1)->get(); //DEVNOTE: when being more discreet with your queries you construct your statement and finish it with ->get();
    // return $post = Post::where('title', 'Post Two')->get();
    // return $posts = DB::select('SELECT * FROM posts'); //DEVNOTE SQL equivalent to Post::all()

    $posts = Post::orderBy('created_at', 'desc')->paginate(10);

    return view('posts.index')->with('posts', $posts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
      return view('posts.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $this->validate($request, [
      'title' => 'required',
      'body' => 'required',
      'cover_image' => 'image|nullable|max:1999', // DEVNOTE: with a lot of apache servers the default limit is 2mb
    ]);

    // Handle file upload
    if( $request->hasFile('cover_image') ) {
      // Get filename with the extension
      $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

      // Get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); // DEVNOTE: pathinfo is regular php method

      // Get just extension/MIMEtype
      $extension = $request->file('cover_image')->getClientOriginalExtension();

      // Filename to staor
      $filenameToStore = $filename.'_'.time().'.'.$extension; // DEVNOTE: we salt the fully qualified filename with a timestamp to make it unique. This is a guard because this is a user initiated action and we can not guarentee unique file names are used.

      // Upload the image
      // DEVNOTE: In Laravel, uploaded files will go to '/storage/app/public/' (app being root). For security this directory is not accessible/visible on the webserver(and can't be loaded). Instead we will create symbolic links mapping between assets in this depository to the app's live '/public/' on root. To make this scale we will symlink the whole directory. We can do this with artisan. 'php artisan storage:link'. This will create a symbolic link in '/public/storage' pointing to '/storage'
      $path = $request->file('cover_image')->storeAs('public/cover_image', $filenameToStore);

    }else {
      $filenameToStore = 'noimage.jpg';
    }

    // Create post
    $post = new Post; //$post = new App\Post();

    $post->title = $request->input('title');
    $post->body = $request->input('body');

    // Attach current logged in user(from auth session) user_id; NOTE: this is in the absense of declaring any relationships in the Models
    $post->user_id = auth()->user()->id; // DEVNOTE: auth()->user() is a helper method off the global auth object which returns currently logged in user data

    $post->cover_image = $filenameToStore;

    $post->save();

    return redirect('/posts')->with('success', 'Post Created'); //DEVNOTE: redirect browser with a flash message
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $post = Post::find($id);

    return view('posts.post')->with('post', $post);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $post = Post::find($id);

    // Check for correct user
    if(auth()->user()->id !== $post->user_id) {
      return redirect('/posts')->with('error', 'Unauthorised Page');
    }

    return view('posts.edit')->with('post', $post);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $this->validate($request, [
      'title' => 'required',
      'body' => 'required',
    ]);

    // Handle file upload
    if( $request->hasFile('cover_image') ) {
      // Get filename with the extension
      $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

      // Get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); // DEVNOTE: pathinfo is regular php method

      // Get just extension/MIMEtype
      $extension = $request->file('cover_image')->getClientOriginalExtension();

      // Filename to staor
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      // Upload the image
      $path = $request->file('cover_image')->storeAs('public/cover_image', $filenameToStore);

    }

    // Update post
    $post = Post::find($id);

    $post->title = $request->input('title');
    $post->body = $request->input('body');

    $post->cover_image = $filenameToStore;

    if( $request->hasFile('cover_image') ) {
      $post->save();
    }

    return redirect('/posts')->with('success', 'Post Updated'); //DEVNOTE: redirect browser with a flash message
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $post = Post::find($id);

    // Check for correct user
    if(auth()->user()->id !== $post->user_id) {
      return redirect('/posts')->with('error', 'Unauthorised Action');
    }

    if($post->cover_image != 'noimage.jpg') {
      Storage::delete('public/cover_image/'.$post->cover_image);
    }

    // Delete Post
    $post->delete();

    return redirect('/posts')->with('success', 'Post Removed'); //DEVNOTE: redirect browser with a flash message
  }
}
