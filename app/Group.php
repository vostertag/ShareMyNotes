<?php

namespace ShareMyNotes;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function university(){
        return $this->belongsTo(University::class);
    }

    public function group_users(){
    	return $this->hasMany(GroupUser::class);
    }

    public function members_string(){
    	$group = $this;
    	$students = \ShareMyNotes\User::whereHas('group_users', function ($q) use($group){
		    $q->where('group_id', $group->id);
		})->get();
		$string = '';
		foreach($students as $student){
			$string .= $student->first_name . ' ' . $student->last_name;
			if($student != $students->last()){
				$string .= ', ';
			}
		}
		return $string;
    }
}
