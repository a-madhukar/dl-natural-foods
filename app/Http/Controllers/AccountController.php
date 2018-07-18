<?php

namespace App\Http\Controllers;

use App\User; 
use Illuminate\Http\Request;
use App\Notifications\ActivateUserAccount;

class AccountController extends Controller
{
    public function activateUserAccount()
    {
        $user = User::whereEmail(request()->email)
        ->first()
        ->activate(); 

        if(auth()->guest()) auth()->login($user); 
        
        return redirect()->intended('home'); 
    }


    public function show()
    {
        return view('auth.resendActivationEmail'); 
    }


    public function sendActivationEmail()
    {
        event(
            auth()->user()->notify(new ActivateUserAccount(auth()->user()))
        ); 

        return back()->with('status', 'We sent you another email!');
    }
}
