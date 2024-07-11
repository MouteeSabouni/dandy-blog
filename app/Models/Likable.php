<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Likable
{
    public function like($user = null)
    {
        $user = $user ?? auth()->user();
        return $this->likes()->attach($user);
    }

    public function likes(): MorphToMany
    {
        return $this->morphToMany(User::class, 'likable')->withTimestamps();
    }
}
