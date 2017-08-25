<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    public function test_guest_user_can_not_favorite_any_reply()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post($this->thread->path() . '/replies/'. $this->reply->id .'/favorites');
    }

    public function test_an_authenticate_user_can_favorite_any_reply()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $this->post($thread->path() . '/replies/'. $reply->id .'/favorites');
        $this->assertCount(1, $reply->favorites);
    }

    public function test_authenticate_user_can_only_favorite_reply_once()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        try {
            $this->post($thread->path() . '/replies/'. $reply->id .'/favorites');
            $this->post($thread->path() . '/replies/'. $reply->id .'/favorites');

        }catch (\Exception $e)
        {
            $this->fail('Did not expect ot insert the same record set twice');

        }

        $this->assertCount(1, $reply->favorites);
    }
}
