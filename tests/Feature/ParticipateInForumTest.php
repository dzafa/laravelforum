<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForum extends TestCase
{
    public function test_guest_user_can_not_participate_in_forum_threads()
    {      
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post($this->thread->path().'/replies', []);
    }

    public function test_authenticate_user_can_participate_in_forum_threads()
    {
        $this->be($this->thread->owner);
        
        $reply = factory('App\Reply')->make(['user_id' => $this->thread->owner->id]);
        
        $this->post($this->thread->path().'/replies', $reply->toArray());

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
}
