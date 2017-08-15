<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{

    public function test_thread_has_replies()
    {
         $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function test_thread_has_an_owner()
    {
        $this->assertInstanceOf('App\User', $this->thread->owner);
    }

    public function test_thread_can_have_replies()
    {
        $this->assertCount(1, $this->thread->replies);
    }
}
