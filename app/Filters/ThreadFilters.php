<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by','popular'];

    /**
     * Filter query by username
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        
        return $this->query->where('user_id', $user->id);
    }

    /*
     * Filter query according most popular threads
     * @return mixed
     */
    protected function popular(){

        $this->query->getQuery()->orders = [];

        return $this->query->orderBy('replies_count','desc');
    }
}
