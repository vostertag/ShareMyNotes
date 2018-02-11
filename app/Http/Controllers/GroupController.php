<?php

namespace ShareMyNotes\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GroupController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$user = Auth::user();
    	if($user->role == 2){
    		$groups = \ShareMyNotes\Group::whereHas('group_users', function ($q) use($user){
			    $q->where('user_id', $user->id);
			})->get();
    		return view('student.group', compact('user', 'groups'));
    	}
    	return back();
    }

    public function save(){
    	$user = Auth::user();
    	if($user->role == 2){
    		request()->validate([
	            'name' => 'required|string|max:255'
	        ]);
	        $group = new \ShareMyNotes\Group;
	        $group->name = request()->input('name');
	        $group->university_id = $user->university_id;
	        do {
			    $token = str_random(15);
			} while (\ShareMyNotes\Group::where("token", "=", $token)->first() instanceof \ShareMyNotes\Group);
			$group->token = $token;
			$group->save();

			$groupUser = new \ShareMyNotes\GroupUser;
			$groupUser->user_id = $user->id;
			$groupUser->group_id = $group->id;
			$groupUser->save();
			return back();
    	}
    	return back();
    }

    public function join(string $token){
    	$user = Auth::user();
    	if($user->role == 2){
    		$group = \ShareMyNotes\Group::where('token', '=', $token)->get()->first();
    		$already = \ShareMyNotes\Group::where('token', '=', $token)->whereHas('group_users', function ($q) use($user){
			    $q->where('user_id', $user->id);
			})->get();
    		if($already->count() == 0){
    			$groupUser = new \ShareMyNotes\GroupUser;
				$groupUser->user_id = $user->id;
				$groupUser->group_id = $group->id;
				$groupUser->save();
    		}
    		return redirect()->route('groups');
    	}
    	return back();
    }

    public function leave(\ShareMyNotes\Group $group){
    	$user = Auth::user();
    	if($user->role == 2){
    		$already = \ShareMyNotes\GroupUser::where('group_id', '=', $group->id)->where('user_id', '=', $user->id)->get()->first();
    		$already->delete();
    		if($group->members_string() == ''){
    			$group->delete();
    		}
    		return back();
    	}
    	return back();
    }

}
