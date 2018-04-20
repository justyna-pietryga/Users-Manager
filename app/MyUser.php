<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    protected $fillable = array('user_name', 'password', 'name', 'surname', 'day_of_birth');

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'user_group', 'user_id', 'group_id')->withTimestamps();
    }
}
