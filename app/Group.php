<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = array('name');

    public function myUsers()
    {
        return $this->belongsToMany('App\MyUser', 'user_group', 'group_id', 'user_id')->withTimestamps();
    }
}
