<?php

namespace ShareMyNotes;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function notes(){
    	return $this->hasMany(Note::class);
    }

    public function course_users(){
    	return $this->hasMany(CourseUser::class);
    }
}

