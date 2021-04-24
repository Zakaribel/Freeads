<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Prophecy\Prophecy\Revealer;

class UtilisateursController extends Controller
{

  
    public function createUtilisateursForm(Request $request){

        return view('auth.register');
    }




    public function utilisateursForm(Request $request){
        
        $user = new User();
        
        $user->name = $request->post('name');
        $user->password = Hash::make($request->post('password'));
        $user->email = $request->post('email');
        $user->save();
        event(new Registered($user));
        return redirect(route('login'))->
        with('success','You are registered. You\'ve just receive an email to confirm your account. Please login now and then click on \'Verify email\' in your mailbox at ' . $request->email);

    }
  

    public function login(){
        return view('auth.login');
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return redirect(route('register'));
}

    public function validateLogin(Request $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect(route('home'))->with('success','You are now logged in');
        }else{
            
            return redirect(route('login'))->with('failed','Incorrect credentials');

        }
    }

    public function emailEdit(Request $request){
        $user = auth()->user();

               DB::table('users')
              ->where('id', $user->id)
              ->update(['email' => $request->email]);

              return redirect(route('register'))->with('success','email modified');
    }

    public function verification (EmailVerificationRequest $request) {

        $request->fulfill();


        return redirect('/home');
    }

    public function verificationNotif(Request $request) {

        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');

    }

}