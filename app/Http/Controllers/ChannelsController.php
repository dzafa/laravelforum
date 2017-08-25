<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function show(Channel $channel)
    {         
        $threads = $channel->threads()->latest()->paginate(10);
        return view('threads.index', compact('threads'));
    }
}
