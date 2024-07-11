<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use App\Models\Post;
use App\Models\User;
use Facades\Tests\Setup\PostFactory;


class ManagePostsTest extends TestCase
{
    // use RefreshDatabase;

    #[Test]
    public function guests_cannot_manage_projects(): void
    {
        $this->get('posts/create')->assertRedirect('/login');
        $post = PostFactory::create()->toArray();
        $this->post('posts', $post)->assertRedirect('/login');
        $this->get("posts/{$post['id']}/edit")->assertRedirect('/login');
        $this->patch("posts/{$post['id']}", $post)->assertRedirect('/login');
        $this->delete("posts/{$post['id']}", $post)->assertRedirect('/login');
    }

    #[Test]
    public function a_user_may_create_posts(): void
    {
        $user = $this->signIn();

        $this->get('posts/create')->assertOk();
        $this->post('/posts', $attributes = Post::factory()->raw())->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', $attributes);
        $this->assertEquals($user->id, $attributes['user_id']);
    }

    #[Test]
    public function the_post_creator_may_update_it(): void
    {
        $user = $this->signIn();
        $post = PostFactory::ownedBy($user)->create();

        $attributes = [
            'title' => 'changed',
            'body' => 'changed as well',
            'excerpt' => 'also changed'
        ];

        $this->get($post->path() .'/edit')->assertOk();
        $this->patch($post->path(), $attributes)->assertRedirect($post->path());
        $this->assertDatabaseHas('posts', $attributes);
        $this->assertEquals($user->id, $post->user->id);
    }

    #[Test]
    public function a_user_may_like_then_unlike_a_post(): void
    {
        $user1 = $this->signIn();
        $post = PostFactory::ownedBy($user1)->create();
        $user2 = $this->signIn();
        $user2->like($post);

        $this->assertEquals($user2->id, $post->likes->first()->pivot->user_id);

        $user2->unlike($post);

        $this->assertEquals(0, $post->fresh()->likes->count());
    }

    #[Test]
    public function a_user_may_delete_their_post()
    {
        $viewer = $this->signIn();
        $creator = $this->signIn();

        $post = PostFactory::ownedBy($creator)->create();

        $this->assertDatabaseHas('posts', $post->toArray());

        $this->actingAs($viewer)->delete($post->path())->assertForbidden();
        $this->assertDatabaseHas('posts', $post->toArray());

        $this->actingAs($creator)->delete($post->path());
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    #[Test]
    public function view_by_tag(): void
    {

        $this->withoutExceptionHandling();

        $post = PostFactory::withTags(1)->create();
        $tag = $post->tags->first();

        $name = strtolower($tag->name);

        $this->actingAs($this->signIn())->get("/posts-by-tag/$name")->assertOk();
    }
}
