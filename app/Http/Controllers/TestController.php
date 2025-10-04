<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
public function showLogin()
    {
        return view('posts.login');
    }

public function Login(Request $request)
{
    // Validate the incoming request data
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user); // تسجيل الدخول يدوي
        return redirect()->route('index.action');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}

public function showRegister()
    {
        return view('posts.register');
    }
    
public function register(Request $request)
{


    // $request->validate([
    //     'name' => ['required', 'string', 'max:255'],
    //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //     'password' => ['required', 'string', 'min:6', 'confirmed'],
    // ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);


    return redirect()->route('login')->with('success', 'User registered successfully, please login.');



}
public function logout(Request $request)
{
    Auth::logout();
    // $request->session()->invalidate();
    // $request->session()->regenerateToken();
    return redirect()->route('login');
}


public function testAction()  
  {
    $posts = Auth::user()->posts; // Collection بكل البوستات الخاصة باليوزر

    return view('posts.index', compact('posts'));
  }

public function show($postId)
  {
    $singlepostfromDB = Post::find($postId);
    //$singlepostfromDB = Post::findOrFail($postId);

    if(is_null($singlepostfromDB)){
      return to_route('index.action');
    }

    return view('/posts/show',['post'=> $singlepostfromDB]);
  }

public function create()
  {
    $users = Auth::user();
    return view('/posts/create',  ['users' => $users]);
  }

public function store()
  {
      //1- validate the user data
      request()->validate([
        'title' => ['required','min:3'],
        'description' => ['required','min:5'],
        'post_creator' => ['required','exists:users,id'],
      ]);
    //1- get the user data
    $title = request()->title;
    $description = request()->description;
    $postCreator = request()->post_creator;

    //2- update the user data in the database
    $post = new Post();
    $post->title = $title;
    $post->description = $description;
    $post->user_id = $postCreator;
    $post->save();

    //3- redirect the user to the index page with a success message 

    return to_route('index.action');
  }
  
  public function edit($postId)
  {
    //select all users from the database
    $users = Auth::user();
    $post = Post::find($postId);
    
    return view('posts.edit', ['users' => $users], ['post' => $post]);
    
  }
  public function update($postId)
  { 

    //1- get the user data
    $title = request()->title;
    $description = request()->description;
    $postCreator = request()->post_creator;
    
          //1- validate the user data
      request()->validate([
        'title' => ['required','min:3'],
        'description' => ['required','min:5'],
        'post_creator' => ['required','exists:users,id'],
      ]);

    //2- store the user data in the database
    $post = Post::find($postId);
    $post->update([
      'title' => $title,
      'description' => $description,
      'user_id' => $postCreator,
    ]);



    //3- redirect the user to the index page with a success message
  
    return to_route('post.show', $postId);

  }
  public function destroy($postId)
  {
  //1-select the post from the database
    $post = Post::findOrFail($postId);
  //2-delete the post
    $post->delete();
  //3-redirect to the index page with a success message
    return to_route('index.action');
  }
}
