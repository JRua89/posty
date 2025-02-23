<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;



class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store(Post $post, Request $request)
    {
        $user = User::find($post->user_id);
      
        if($post->likedby($user)){
            return response(null,409);
        }

        $post->likes()->create([
            'user_id' => $post->user_id,
        ]);

        return back();

    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        
        return back();
    }

}
