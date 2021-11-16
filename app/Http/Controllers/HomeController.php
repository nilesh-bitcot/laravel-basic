<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class HomeController extends Controller
{
    // create a index method to handle home or root page
    public function index() {

        $messages = Message::all();

        return view('home',
            [
                'messages' => $messages
            ]
        );
    }
}
