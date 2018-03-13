<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
   use DatabaseMigrations;

   protected $thread;

   public function setUp(){
       parent::setUp();


       $this->thread = factory('App\Thread')->create();
   }
    /** @test */
   public function a_thread_has_a_reply(){
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->thread->replies);
   }

   /** @test */
   public function a_thread_has_a_creator(){
       $this->assertInstanceOf('App\User',$this->thread->creator);
   }

   /** @test */
   public function a_thread_can_add_reply(){    
        $this->thread->addReply([
            'body'=>'Thread',
            'user_id'=>1
        ]);

        $this->assertCount(1,$this->thread->replies);
   }
}
