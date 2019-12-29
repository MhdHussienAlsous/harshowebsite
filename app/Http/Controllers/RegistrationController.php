<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;

class RegistrationController extends Controller
{
    public function create(){
    	return view('content.register');
    }

    public function store(Request $req){
    	$user = new user;
    	$user->name 	= $req->name;
    	$user->email    = $req->email;
    	$user->password = bcrypt($req->password);

    	$user->save();

    	//login
    	auth()->login($user);

    	//redirect
    	return redirect('index');
    }
}
