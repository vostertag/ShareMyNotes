<?php

namespace ShareMyNotes\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class CourseController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $course){
    	$user = Auth::user();
    	$course = \ShareMyNotes\Course::find($course);
    	if($course != null){
    		$current = $course->id;
    		if($course->user_id == $user->id && $user->role == 1){
    			$notes = $course->notes;
    			return view('common.notes', compact('user', 'notes', 'current'));
    		}else if($user->role == 2){
    			$user_courses = $user->course_users;
                $courses = [];
                foreach($user_courses as $c){
                    $courses[] = $c->course->id;
                }
                if(!in_array($course->id, $courses)){
                	return back();
                }
                $user_groups = $user->group_users;
                $groups = [];
                foreach($user_groups as $group){
                    $groups[] = $group->group->id;
                }
                $notes = \ShareMyNotes\Note::where('user_id', $user->id)->where('course_id', $course->id)
                ->orWhereHas('user.group_users', function($q) use($groups){
                    $q->whereIn('group_id', $groups);
                })->where('course_id', $course->id)
                ->orWhereHas('user', function($q){
                    $q->where('role', 1);
                })->where('course_id', $course->id)
                ->get();
                return view('common.notes', compact('user', 'notes', 'current'));
    		}
    	}
    	return redirect()->route('home');
    }

    public function save(){
    	$user = Auth::user();
    	if($user->role == 1){
	    	request()->validate([
	            'name' => 'required|string|max:255',
	        ]);

	        $course = new \ShareMyNotes\Course;
	        $course->name = request()->input('name');
	        $course->user_id = $user->id;
	        $course->save();
	    }
	    return back();
    }

    public function edit(){
    	$user = Auth::user();
    	if($user->role == 1){
	    	request()->validate([
	            'name' => 'required|string|max:255',
	            'course' => 'required|exists:courses,id'
	        ]);
	        $course = \ShareMyNotes\Course::find(request()->input('course'));
	        if($course->user->id == $user->id){
		        $course->name = request()->input('name');
		        $course->save();
		    }
	    }
	    return back();
    }

    public function delete(\ShareMyNotes\Course $course){
    	$user = Auth::user();
    	if($user->role == 1){
	        if($course->user->id == $user->id){
		        $course->delete();
		    }
	    }
	    return back();
    }

    public function joinCourse(){
    	$user = Auth::user();
    	if($user->role == 2){
    		$classesNotJoined = \ShareMyNotes\Course::whereHas('user', function ($q) use($user){
			    $q->where('university_id', $user->university_id);
			})->whereDoesntHave('course_users', function ($q) use($user){
				$q->where('user_id', $user->id);
			})->get();
			
			$classesJoined = \ShareMyNotes\Course::whereHas('user', function ($q) use($user){
			    $q->where('university_id', $user->university_id);
			})->whereHas('course_users', function ($q) use($user){
				$q->where('user_id', $user->id);
			})->get();

			$joined = $classesJoined->count();

			$classes = $classesJoined->merge($classesNotJoined);
    		
    		return view('student.course', compact('user', 'classes', 'joined'));
    	}
    	return back();
    }

    public function joinThisCourse(\ShareMyNotes\Course $course){
    	$user = Auth::user();
    	if($user->role == 2 && $course->user->university_id == $user->university_id){
    		$join = new \ShareMyNotes\CourseUser;
    		$join->user_id = $user->id;
    		$join->course_id = $course->id;
    		$join->save();
    	}
    	return back();
    }

    public function leaveCourse(\ShareMyNotes\Course $course){
    	$user = Auth::user();
    	if($user->role == 2){
    		$courseUser = \ShareMyNotes\CourseUser::where('course_id', $course->id)->where('user_id', $user->id);
    		$courseUser->delete();
    	}
    	return back();
    }

}

