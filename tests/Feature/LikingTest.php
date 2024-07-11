<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\CommentFactory;


class LikingTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_post_can_be_liked(): void
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();
        $post = PostFactory::create();
        $post->like($user);

        $this->assertTrue($post->likes->contains($user));
    }

    #[Test]
    public function a_comment_can_be_liked(): void
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();
        $comment = CommentFactory::create();
        $comment->like($user);

        $this->assertTrue($comment->likes->contains($user));
    }
}
