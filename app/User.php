<?php

namespace ShareMyNotes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'profile_picture', 'university_id', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function university(){
        return $this->belongsTo(University::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function course_users(){
        return $this->hasMany(CourseUser::class);
    }

    public function group_users(){
        return $this->hasMany(GroupUser::class);
    }
}
