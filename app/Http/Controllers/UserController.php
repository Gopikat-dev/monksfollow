<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => 'required',
        ]);

        User::create($incomingFields);
        return 'hello bob';
    }
}
