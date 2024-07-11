<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\CommentFactory;

class ManageCommentsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_comment_belongs_to_a_sepcific_post_and_user(): void
    {
            $post = PostFactory::create();
            $user = $this->signIn();
            $comment = CommentFactory::create();
            $comment->post()->associate($post);

            $this->assertEquals($user->id, $comment->user_id);
            $this->assertEquals($post->id, $comment->post_id);
    }

    #[Test]
    public function a_user_may_create_comments(): void
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $post = PostFactory::create();

        $this->get("{$post->path()}")->assertOk();
        $this->post("{$post->path()}/comments", $attributes = ['body' => 'First comment'])->assertRedirect("/posts/{$post->id}");

        $this->assertDatabaseHas('comments', $attributes);

        $comment = Comment::first();

        $this->assertEquals($user->id, $comment->user_id);
        $this->assertEquals($post->comments->first()->id, $comment->id);
    }

    // #[Test]
    // public function test_test()
    // {
    //     $post = PostFactory::create();
    //     $user = $this->signIn();
    //     $comment = CommentFactory::create(['post_id' => $post->id, 'user_id' => $user->id]);

    //     $this->assertEquals($user->id, $comment->user_id);
    //     $this->assertEquals($post->id, $comment->post_id);
    // }
}
