<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    protected $thread;

    protected $reply;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->thread = create('App\Thread');       

        $this->reply = create('App\Reply', ['thread_id' => $this->thread->id]);
    }

    public function signIn($user = null)
    {
        $user = $user ?: create('App\User');

        $this->actingAs($user);

        return $user;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report (\Exception $e) {}
            public function render($request, \Exception $e)
            {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }
}
