<?php

namespace Tests\Setup;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class PostFactory
{
    protected $user;

    protected $tagsCount = 0;

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function withTags($tagsCount)
    {
        $this->tagsCount = $tagsCount;

        return $this;
    }

    public function create()
    {
        $post = Post::factory()->create();

        $tag = Tag::factory($this->tagsCount)->create();
        $post->tags()->attach($tag);

        return $post;
    }
}
