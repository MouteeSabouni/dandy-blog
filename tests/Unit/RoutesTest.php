<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    #[Test]
    public function anyone_may_visit_the_home_page(): void
    {
        $this->get('/')->assertOk();
    }

    #[Test]
    public function anyone_may_visit_the_contact_page(): void
    {
        $this->get('/contact')->assertOk();
    }

    #[Test]
    public function anyone_may_visit_the_posts_page(): void
    {
        $this->get('/posts')->assertRedirect('login');
    }
}
