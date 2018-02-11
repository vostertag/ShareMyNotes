<?php

namespace ShareMyNotes;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
	
    public function group(){
    	return $this->belongsTo(Group::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
