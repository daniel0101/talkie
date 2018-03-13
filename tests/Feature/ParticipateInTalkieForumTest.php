<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInTalkieForumTest extends TestCase
{
    use DatabaseMigrations;

    //  /** @test */
    //  public function an_unauthenticated_user_cannot_participate_in_threads(){
    //     $this->expectException('Illuminate\Auth\AuthenticationException');
    //     $this->withoutExceptionHandling();
    // }

    /** @test */
    public function an_authenticated_user_can_participate_in_threads(){
        //given an authenticated user
        $this->be($user = factory('App\User')->create()); //be logs in the created user
        //An existing  thread
        $thread = factory('App\Thread')->create(); 
        //when a user addes a reply to the thread
        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies',$reply->toArray())->assertStatus(200); //fakes a post request to the server
        //reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
