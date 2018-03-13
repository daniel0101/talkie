<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use Auth;

class RepliesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   public function store(Thread $thread){
       $thread->addReply([
            'body'=>request('body'),
            'user_id'=>Auth::user()->id
       ]);
   }
}
