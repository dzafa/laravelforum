<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{

    public function test_user_can_browse_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title)
            ->assertStatus(200);
    }

    public function test_user_can_view_single_thread()
    {         
        $this->get($this->thread->path())
            ->assertSee($this->thread->title)
            ->assertStatus(200);
    }

    public function test_user_can_read_replies_that_belong_to_threads()
    {      
        $this->get($this->thread->path())
            ->assertSee($this->reply->body)
            ->assertStatus(200);
    }
}
