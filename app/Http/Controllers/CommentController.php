<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Arr;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        $attributes = request()->validate([
            'body' => 'required|string',
        ]);

        $attributes = Arr::add($attributes, 'user_id', auth()->id());
        $attributes = Arr::add($attributes, 'post_id', $post->id);

        $comment = auth()->user()->comments()->create($attributes);

        $comment->post()->associate($post);
        $comment->save();

        return back();
    }

    public function update(Post $post, Comment $comment)
    {
        $attributes = request()->validate([
            'body' => 'required|string',
        ]);

        $comment->update($attributes);

        return back();
    }

    public function destroy(Comment $comment)
    {
        if(! auth()->id() === $comment->user_id)
        {
            abort(403);
        }
            $comment->delete();
            return back();
    }
}
