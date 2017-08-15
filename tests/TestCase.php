<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    protected $thread;

    protected $reply;

    public function setUp(){
        parent::setUp();

        $this->thread = create('App\Thread');

        $this->reply = create('App\Reply', ['thread_id' => $this->thread->id]);
    }

    public function signIn($user = null)
    {
        $user = $user ?: create('App\User');

        $this->be($user);

        return $this;
    }
    
}
