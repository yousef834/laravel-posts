<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class TestController extends Controller
{
public function testAction()  
  {
    //see all posts from database
    $postsFromDB = Post::all();
    
    return view('/posts/index',['posts' => $postsFromDB]);
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
    $users = User::all();
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
    $users = User::all();
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
