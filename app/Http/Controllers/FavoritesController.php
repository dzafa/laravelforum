<?php

namespace App\Http\Controllers;

use App\Favorit;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($chanelId, $threadId, Reply $reply)
    {
        $reply->favorite();
        return back();
    }
}
