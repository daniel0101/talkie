<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */ 
    public function guest_cannot_create_a_thread(){
        $this->withoutExceptionHandling();
        $thread = factory('App\Thread')->make();
        $this->expectException(AuthenticationException::class); 
        $this->post('/threads',$thread->toArray());        
    }

    /** @test */
    public function an_authenticated_user_can_create_new_talkie_thread(){
        //given a new user
        $user =  $this->actingAs(factory('App\User')->create());
        //user post a thread
        // --make the thread first
        $thread = factory('App\Thread')->make();
        $this->post('/threads',$thread->toArray());
        //when we vist the threads page
        $response =  $this->get('/threads');
        //we can see new thread on threads page
        $response->assertSee($thread->title)
                ->assertSee($thread->body);        
    }
}
