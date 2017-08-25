<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    protected $fillable = ['user_id', 'favorited_id','favorited_type'];

    protected $table = 'favorites';
}
