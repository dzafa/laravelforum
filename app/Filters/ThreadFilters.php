<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by','popular'];

    /**
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        
        return $this->query->where('user_id', $user->id);
    }

    protected function popular(){
        return $this->query->order_by('replies_count','desc');
    }
}
