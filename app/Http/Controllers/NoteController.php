<?php

namespace ShareMyNotes\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NoteController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(){
    	$user = Auth::user();
    	if($user->role == 1){
    		$courses = $user->courses;
    	}else{
    		$courses = \ShareMyNotes\Course::whereHas('user', function ($q) use($user){
			    $q->where('university_id', $user->university_id);
			})->whereHas('course_users', function ($q) use($user){
				$q->where('user_id', $user->id);
			})->get();
    	}
    	return view('common.note', compact("user", "courses"));
    }

    public function store(){
    	$user = Auth::user();

    	request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'course' => 'required|exists:courses,id',
            'file' => 'required|max:4000|mimes:doc,docx,pdf,tex'
        ]);

    	if(request()->file('file') != ""){
            $path = request()->file('file')->store('public/files');
            $path = basename($path);
        }

        $note = new \ShareMyNotes\Note;
        $note->user_id = $user->id;
        $note->course_id = request()->input('course');
        $note->title = request()->input('title');
        $note->description = request()->input('description');
        $note->save();

        $version = new \ShareMyNotes\Version;
        $version->note_id = $note->id;
        $version->file = $path;
        $version->save();

        return redirect()->route('home');
    }

    public function edit(\ShareMyNotes\Note $note){
    	$user = Auth::user();
    	if($user->id != $note->user_id){
    		return back();
    	}
    	if($user->role == 1){
    		$courses = $user->courses;
    	}else{
    		$courses = \ShareMyNotes\Course::whereHas('user', function ($q) use($user){
			    $q->where('university_id', $user->university_id);
			})->whereHas('course_users', function ($q) use($user){
				$q->where('user_id', $user->id);
			})->get();

    	}
    	return view('common.note', compact('user', 'note', 'courses'));
    }

    public function update(\ShareMyNotes\Note $note){
    	$user = Auth::user();
		if($user->id != $note->user_id){
    		return back();
    	}
    	request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'course' => 'required|exists:courses,id',
            'file' => 'max:4000|mimes:doc,docx,pdf,tex'
        ]);

        if(request()->file('file') != ""){
            $path = request()->file('file')->store('public/files');
            $path = basename($path);
            $version = new \ShareMyNotes\Version;
		    $version->note_id = $note->id;
		    $version->file = $path;
		    $version->save();
        }

        $note->course_id = request()->input('course');
        $note->title = request()->input('title');
        $note->description = request()->input('description');
        $note->save();
        return back();
    }

    public function delete(){
    	$user = Auth::user();
    	request()->validate([
            'note' => 'required|exists:notes,id'
        ]);
    	$note = \ShareMyNotes\Note::find(request()->input('note'));
    	if($note->user->id == $user->id){
    		$note->delete();
    		return redirect()->route('home');
    	}
        return back();
    }

    public function search(){
    	$user = Auth::user();
    	$current = -1;
    	$search = true;
    	request()->validate([
            'search' => 'required|string|max:255',
        ]);
        $word = request()->input('search');
        $names = explode(" ", $word);
        if($user->role == 1){
            $notes = $user->notes;
        }else if($user->role == 2){
            $user_courses = $user->course_users;
            $courses = [];
            foreach($user_courses as $course){
                $courses[] = $course->course->id;
            }
            $user_groups = $user->group_users;
            $groups = [];
            foreach($user_groups as $group){
                $groups[] = $group->group->id;
            }
            $notes = \ShareMyNotes\Note::where('user_id', $user->id)->where('title', 'like', '%' . $word . '%')->orWhere('description', 'like', '%'.$word.'%')
            ->orWhereHas('user.group_users', function($q) use($groups){
                $q->whereIn('group_id', $groups);
            })->whereIn('course_id', $courses)->where('title', 'like', '%' . $word . '%')->orWhere('description', 'like', '%'.$word.'%')
            ->orWhereHas('user', function($q){
                $q->where('role', 1);
            })->whereIn('course_id', $courses)->where('title', 'like', '%' . $word . '%')->orWhere('description', 'like', '%'.$word.'%')
            ->get();
        }else{
        	return back();
        }
        return view('common.notes', compact('user', 'notes', 'current', 'search'));
    }
}
