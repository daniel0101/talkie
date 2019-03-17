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
   public function store($channel, Thread $thread){
       $this->validate(request(),[
            'body'=>'required'
       ]);
       $thread->addReply([
            'body'=>request('body'),
            'user_id'=>Auth::user()->id
       ]);
       return redirect()->back();
   }
}
