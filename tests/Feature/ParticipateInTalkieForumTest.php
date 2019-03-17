<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInTalkieForumTest extends TestCase
{
    use DatabaseMigrations;

     /** @test */
     public function an_unauthenticated_user_cannot_participate_in_threads(){
        $this->withExceptionHandling();   
        //An existing  thread
        $thread = create('App\Thread'); 
        //when a user addes a reply to the thread
        $reply = make('App\Reply');      

        $this->post($thread->path().'/replies',$reply->toArray())
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_participate_in_threads(){
        $this->withoutExceptionHandling();
        //given an authenticated user
        $this->signIn(); //be logs in the created user
        //An existing  thread
        $thread = create('App\Thread'); 
        //when a user addes a reply to the thread
        $reply = make('App\Reply');
        $this->post($thread->path().'/replies',$reply->toArray()); //fakes a post request to the server
        //reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function a_reply_has_a_body(){
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply',['body'=>null]);
        $this->post($thread->path().'/replies',$reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
