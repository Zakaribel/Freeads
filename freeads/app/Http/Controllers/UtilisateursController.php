<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
        return redirect(route('login'))->with('success','You are registered');



    }
  

    public function login(){
        return view('auth.login');
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/register');
}

    public function validateLogin(Request $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect(route('home'))->with('success','You are now logged in');
        }
    }

    public function emailEdit(Request $request){
             var_dump($request->email);
        $affected = DB::table('users')
              ->where('id', $request->id)
              ->update(['email' => $request->email]);

           

    }
 
    

}
