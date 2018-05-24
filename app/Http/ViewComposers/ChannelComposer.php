<?php 

namespace App\Http\ViewComposers;

use App\Channel;
use Illuminate\View\View;

class ChannelComposer{

    public $channel;

    /**
     * initialize with channel Eloquent model
     * @param null
     * @return void
     */
    public function __construct(){
        $this->channel = Channel::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('channels', $this->channel);
    }
}