<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */

    protected $thread;

    public function setUp(){
        
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function test_user_can_browse_all_threads(){
        $this->get('/threads')
            ->assertSee($this->thread->title)
            ->assertStatus(200);
    }

    public function test_user_can_view_single_thread(){         
        $this->get($this->thread->path())
            ->assertSee($this->thread->title)
            ->assertStatus(200);
    }

    public function test_a_user_can_read_replies_that_belong_to_threads(){      
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body)
            ->assertStatus(200);
    }
}
