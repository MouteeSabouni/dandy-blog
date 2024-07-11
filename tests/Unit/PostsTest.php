<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Facades\Tests\Setup\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_a_user(): void
    {
        $this->signIn();
        PostFactory::create();

        $this->assertInstanceOf(User::class, Post::first()->user);
    }

    #[Test]
    public function it_has_tags(): void
    {
        $this->signIn();
        $post = PostFactory::withTags(1)->create();

        $this->assertInstanceOf(Tag::class, $post->tags->first());
    }

    #[Test]
    public function it_has_likes(): void
    {
        $post = PostFactory::create();
        $user = $this->signIn();
        $post->like($user);

        $this->assertEquals(1, $post->likes->count());
    }
}
