<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageThreadTest extends TestCase
{   

    public function test_guest_can_not_create_new_thread()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }
    
    public function test_authenticate_user_can_create_forum_thread() 
    {
        $this->signIn();
        
        $thread = make('App\Thread');
        $response = $this->post('/threads', $thread->toArray());
       
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

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

    public function test_a_thread_requires_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_channel_id()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
        
        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($attributes = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $attributes);

        return $this->post('/threads', $thread->toArray());
    }

    public function test_user_can_filter_threads_according_to_a_channel()
    {   
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread', ['channel_id' => 999]);
        
        $this->get("/threads/{$channel->slug}")
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    public function test_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'Adnan']));

        $threadsByAdnan = create('App\Thread', ['user_id' => auth()->id()]);
        $threadsNotByAdnan = create('App\Thread');

        $this->get('/threads?by=Adnan')
            ->assertSee($threadsByAdnan->title)
            ->assertDontSee($threadsNotByAdnan->title);
    }

    public function test_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply',['thread_id' => $threadWithTwoReplies->id],2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply',['thread_id' => $threadWithThreeReplies->id],3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3,2,1], array_column($response["data"], 'replies_count'));
    }

    public function test_threads_can_be_deleted_by_owner()
    {
        $this->signIn();
        $thread = create('App\Thread');

        $this->json('DELETE', $thread->path());
        //$this->assertDatabaseMissing('threads',['id' => 2]);
    }
}