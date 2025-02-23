<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostDislikeController extends Controller
{
    public function store(Post $post)
    {
        
        $post->dislikes()->create([
            'user_id' => $post->user_id,
        ]);

        return back();

    }
}
