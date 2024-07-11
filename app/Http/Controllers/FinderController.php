<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FinderController extends Controller
{

    public function home()
    {
        $posts = Post::latest()->limit(3)->get();
        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function search()
    {
        $q = request('q');

        $posts = Post::where('title', 'like', '%' . $q . '%')
            ->orWhere('body', 'like', '%' . $q . '%')
            ->orWhere('excerpt', 'like', '%' . $q . '%')
            ->orWhereHas('tags', function($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%');
            })
            ->paginate(5);

        if($posts->count() === 0)
        {
            abort(404);
        } else {
            return view('posts.index', ['posts' => $posts]);
        }
    }

    public function loadServiceView($service)
    {
        $posts = $posts = Post::latest()->limit(3)->get();
        return view('services/' . $service, ['posts' => $posts]);
    }
}
