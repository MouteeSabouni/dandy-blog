<?php

namespace Tests\Setup;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentFactory
{
    protected $user;
    protected $post;

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function under($post)
    {
        $this->post = $post;

        return $this;
    }

    public function create($post = null)
    {
        $comment = Comment::factory()->create();

        return $comment;
    }
}
