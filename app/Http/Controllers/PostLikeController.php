<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



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

        if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()){
            $user = auth()->user();
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }
        
        

        return back();

    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        
        return back();
    }

}
