<?php

namespace ShareMyNotes;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    public function course(){
    	return $this->belongsTo(Course::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
