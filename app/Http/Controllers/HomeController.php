<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use App\Message;

class HomeController extends Controller
{
    // create a index method to handle home or root page
    public function index() {

        if(Auth::check()){

            $messages = Message::all();

            return view('home',
                [
                    'messages' => $messages
                ]
            );
        }
        return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }
}
