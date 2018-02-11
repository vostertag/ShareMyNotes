<?php

namespace ShareMyNotes\Http\Controllers\Auth;

use ShareMyNotes\User;
use ShareMyNotes\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm($role){
        $universities = \ShareMyNotes\University::all();
        return view('auth.register', compact('role', 'universities'));
    }

    public function register($role){
        if($role == "student"){
            $role = 2;
        }else{
            $role = 1;
        }

        request()->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'university' => 'required|exists:universities,id',
            'avatar' => 'image|max:2048'
        ]);

        if(request()->file('avatar') != ""){
            $path = request()->file('avatar')->store('public/avatars');
            $path = basename($path);
        }else{
            $path = "defaultUser.png";
        }
        

        $user = $this->create(request()->all(), $role, $path);
        Auth::login($user);
        return redirect()->route('home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'university_id' => 'required|exists:universities,id',
            'profile_picture' => 'image|file',
            'role' => 'required|integer|max:2|min:1'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \ShareMyNotes\User
     */
    protected function create(array $data, int $role, string $path)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'university_id' => $data['university'],
            'profile_picture' => $path,
            'role' => $role
        ]);
    }
}
