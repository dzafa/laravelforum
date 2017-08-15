<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{   

    public function test_guest_can_not_create_forum_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads', []);
    }
    
    public function test_an_authenticate_user_can_create_forum_thread() 
    {
        
        $user = create('App\User');
        $this->be($user);
        
        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->body);
    }
}
