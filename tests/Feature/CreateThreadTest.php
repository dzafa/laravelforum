<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{   

    public function test_guest_can_not_create_forum_thread_and_can_not_see_thread_page()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get('/threads/create');

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads', []);
    }
    
    public function test_an_authenticate_user_can_create_forum_thread() 
    {
        $this->signIn();
        
        $thread = create('App\Thread');

        $this->post('/threads', $thread->toArray());

      /*  $this->get($thread->path())
            ->assertSee($thread->body);*/
    }

}
