<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class SessionsController extends Controller
{
    public function create(){
         if(!Auth::check()){
            return view('content.login');
         }
         return redirect('/dashboard');
    }

    public function store(){
        if(! auth()->attempt(request(['email','password'])) ){
            return back()->withErrors([
                'message' => 'Email or Password not correct!!'
            ]);
        }

        return redirect('/dashboard');
    }


    public function destroy()
    {
    	auth()->logout();
     	return redirect('/login');
    }    
}
