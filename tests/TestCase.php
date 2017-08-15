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

        $this->thread = factory('App\Thread')->create();

        $this->reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
    }
}
