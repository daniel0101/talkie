<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function a_channel_has_many_threads(){
        $channel = create('App\Channel');
        $thread = create('App\Thread',['channel_id'=>$channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }

}