<?php

namespace ShareMyNotes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            $current = 0;
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
                $notes = \ShareMyNotes\Note::where('user_id', $user->id)
                ->orWhereHas('user.group_users', function($q) use($groups){
                    $q->whereIn('group_id', $groups);
                })->whereIn('course_id', $courses)
                ->orWhereHas('user', function($q){
                    $q->where('role', 1);
                })->whereIn('course_id', $courses)
                ->get();
            }
            return view('common.notes', compact('user', 'notes', 'current'));
        }
        return view('welcome');
    }
}
