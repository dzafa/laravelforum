<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    public function test_channel_consists_of_threads()
    {
        $channel = create('App\Channel');
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $channel->threads);
    }
}
