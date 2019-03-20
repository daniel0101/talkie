<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->withoutExceptionHandling();
    }
    
    /** @test */ 
    public function guest_cannot_create_a_thread(){
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login'); 
            
        $this->post('/threads')
            ->assertRedirect('/login');        
    }
 

    /** @test */
    public function an_authenticated_user_can_create_new_talkie_thread(){
        //given a new user
        $this->signIn(); 
        //user post a thread
        // --make the thread first
        $thread = make('App\Thread');
        $response = $this->post('/threads',$thread->toArray());
        // dd($response->headers->get('Location'));
        //when we vist the threads page
        $response =  $this->get($response->headers->get('Location'));
        //we can see new thread on threads page
        $response->assertSee($thread->title)
                ->assertSee($thread->body);        
    }

    /** @test */
    public function a_thread_has_a_title(){
        $this->publishThread(['title'=>null])->assertSessionHasErrors('title');      
    }

    /** @test */
    public function a_thread_has_a_body(){
        $this->publishThread(['body'=>null])->assertSessionHasErrors('body');      
    }

     /** @test */
     public function a_thread_has_a_channelId(){
         factory('App\Channel',2)->create();

        $this->publishThread(['channel_id'=>null])->assertSessionHasErrors('channel_id');
        
        $this->publishThread(['channel_id'=>'wweesdf'])->assertSessionHasErrors('channel_id');
    }

    function publishThread($overrides){
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread',$overrides);

        return $response = $this->post('/threads',$thread->toArray());
    }
}
