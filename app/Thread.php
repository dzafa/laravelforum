<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['title','body','user_id','channel_id'];

    public function path()
    {
        return '/threads/' . $this->channels->name .'/' .$this->id;
    }

    public function replies(){
        return $this->hasMany(Reply::class)->latest();
    }

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function addReply($reply){
        $this->replies()->create($reply);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class,'channel_id');
    }

}
