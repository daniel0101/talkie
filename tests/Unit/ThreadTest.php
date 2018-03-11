<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
   use DatabaseMigrations;
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
}
