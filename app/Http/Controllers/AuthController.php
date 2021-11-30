<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('/auth/login');
    }
    
    public function register()
    {
        return view('/auth/register');
    }

    public function postLogin( Request $request )
    {
        /*$request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);*/

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return Redirect::to("login")->withError('Oppes! You have entered invalid credentials');
    }

    public function postRegister(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ],
            [
                'password.min' => 'Password has to be :min chars long'
            ]
        );

        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->all();
 
        $check = $this->create($data);
        if( $check ){
            return Redirect::to("/")->withSuccess('Great! You have Successfully loggedin');    
        }else{
            return Redirect::to("/")->withError('Oops! something went wrong.');
        }
        

    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
