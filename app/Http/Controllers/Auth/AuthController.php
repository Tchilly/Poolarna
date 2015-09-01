<?php

namespace Poolarna\Http\Controllers\Auth;

use Validator;
use Hash;
use Auth;
use Session;
use Illuminate\Http\Request;

use Poolarna\Http\Controllers\Controller;
use Poolarna\User;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Display the login form.
     *
     * @return Response
     */
    public function login()
    {
        // Show login form
        return view('auth.login');

    }

    /**
     * Display the registration form.
     *
     * @return Response
     */
    public function register()
    {
        // Show login form
        return view('auth.register');

    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            //'name' => 'required|max:255',
            'email' => 'required|email|min:3,max:255',
            //'email' => 'required|email|max:255|unique:users',
            //'password' => 'required|confirmed|min:6',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('auth/login')
                        ->withErrors($validator)
                        ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Authentication passed...
            return redirect()->intended('/');

        }

        return redirect('auth/login')
            ->withErrors('Could not sign you in, email or password did not match!')
            ->withInput();;

    }

    // Logout
    public function logout()
    {

        Session::flush();
        Auth::logout();

        return redirect()->intended('/')->with('status', 'You have been logged out!');

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4,max:255',
            'email' => 'required|email|min:3,max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return redirect('auth/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/auth/login')->with('status', 'You have been created, just sign in and be done!');

    }
}
