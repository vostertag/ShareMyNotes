<?php

namespace ShareMyNotes;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public function users(){
    	return $this->hasMany(User::class);
    }

    public function groups(){
    	return $this->hasMany(Group::class);
    }
}
