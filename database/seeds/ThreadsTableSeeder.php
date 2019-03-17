<?php

use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory('App\Thread',50)->create()->each(function($thread){
           $thread->replies()->save(factory(App\Reply::class)->make());
       });
    }
}
