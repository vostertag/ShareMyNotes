<?php

namespace ShareMyNotes\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$user = Auth::user();
    	$universities = \ShareMyNotes\University::all();

    	return view('common.account', compact("user", "universities"));
    }

    public function update(){
    	$user = Auth::user();

    	request()->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id,'.$user->id,
            'password' => 'confirmed',
            'university' => 'required|exists:universities,id',
            'avatar' => 'image|max:2048'
        ]);

        if(request()->file('avatar') != ""){
            $path = request()->file('avatar')->store('public/avatars');
            $path = basename($path);
        }else{
            $path = $user->profile_picture;
        }

	    $user->first_name = request()->input('first_name');
	    $user->last_name = request()->input('last_name');
	    $user->email = request()->input('email');
	    $user->university_id = request()->input('university');
	    $user->profile_picture = $path;
	    if (request()->input('password') != '')
	    {
	        $user->password = bcrypt(request()->input('password'));
	    }

	    $user->save();

	    return back();
    }

    public function delete(){
    	$user = Auth::user();
    	$user->delete();
    	return redirect()->route('home');
    }
}