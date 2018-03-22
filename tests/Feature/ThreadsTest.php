<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        // $this->actingAs(factory('App\User')->create());
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);        
    }

    /** @test */
    public function a_user_can_view_a_single_thread(){

        $this->get($this->thread->path())
            ->assertStatus(200)
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);
    }

    /** @test */
    public function a_user_can_view_a_reply_associated_with_a_thread(){

       //given a reply
       $reply = factory('App\Reply')->create(['thread_id'=>$this->thread->id]); 

       $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

}
