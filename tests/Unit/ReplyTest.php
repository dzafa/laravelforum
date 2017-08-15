<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{

    public function test_reply_has_an_owner()
    {
        $this->assertInstanceOf('App\User', $this->reply->owner);
    }
}
