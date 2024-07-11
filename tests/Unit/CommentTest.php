<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Models\User;
use App\Models\Post;
use Facades\Tests\Setup\CommentFactory;
use Facades\Tests\Setup\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CommentTest extends TestCase
{

    use RefreshDatabase;

    #[Test]
    public function it_has_a_user(): void
    {
        $this->signIn();
        $comment = CommentFactory::create();

        $this->assertInstanceOf(User::class, $comment->user);
    }

    #[Test]
    public function it_has_a_post(): void
    {
        $this->signIn();
        $comment = CommentFactory::create();

        $this->assertInstanceOf(Post::class, $comment->post);
    }
}
