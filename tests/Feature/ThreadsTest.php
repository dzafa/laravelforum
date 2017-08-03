<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_browse_threads () {
        
        $response = $this->get('/threads');
        
        $response->assertStatus(200);
    
    }
}
