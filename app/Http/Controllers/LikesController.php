<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikesController extends Controller
{
    public function like(Post $post)
    {
        $user = auth()->user();

        $user->like($post);

        return response()->json(['likes_count' => $post->likes()->count()]);
    }

    public function unlike(Post $post)
    {
        $user = auth()->user();

        $user->unlike($post);

        return response()->json(['likes_count' => $post->likes()->count()]);
    }
}
