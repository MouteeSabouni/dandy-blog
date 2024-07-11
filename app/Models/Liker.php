<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Liker
{
    public function like(Post $post)
    {
        $post->likes()->attach($this->id);
        $post->save();

        return $this;
    }

    public function unlike(Post $post)
    {
        $post->likes()->detach($this->id);
        $post->save();

        return $this;
    }

    public function hasLiked(Post $post): bool
    {
        if (! $post->exists) {
            return false;
        }

        return $post->likes->contains($this->id);
    }
}
