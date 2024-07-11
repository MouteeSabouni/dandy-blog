<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('likes')->latest()->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        return redirect('/posts');
    }

    public function show(Post $post)
    {
        $post = Post::find($post->id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(UpdatePostRequest $request)
    {
        return redirect($request->save()->path());
    }

    public function getOldest()
    {
        $posts = Post::with('likes')->oldest()->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }

    public function getFeatured()
    {
        $posts = Post::withCount('likes')
        ->having('likes_count', '>', 0)
        ->orderBy('likes_count', 'desc')
        ->limit(15)
        ->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }

    public function getByUser(User $user)
    {
        $posts = $user->posts()->latest()->paginate(5);
        return view('posts.index', ['posts' => $posts, 'user' => $user]);
    }

    public function getByTag(Tag $tag)
    {
        $posts = $tag->posts()->latest()->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function getShort()
    {
        $posts = Post::with('likes')
            ->whereRaw('LENGTH(body) < ?', 500)
            ->limit(6)
            ->paginate(5);
        return view('posts.short', ['posts' => $posts]);
    }

    public function destroy(Post $post)
    {
        if($this->authorize('manage', $post))
        {
            $post->delete();
            return redirect('/posts');
        } else {
            abort(403);
        }
    }
}
