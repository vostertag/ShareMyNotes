<?php

namespace ShareMyNotes;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function course(){
    	return $this->belongsTo(Course::class);
    }

    public function versions(){
    	return $this->hasMany(Version::class);
    }
}
