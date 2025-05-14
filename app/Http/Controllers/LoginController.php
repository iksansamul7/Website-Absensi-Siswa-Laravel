<?php

namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class LoginController extends Controller
{
    public function login(){
        return view('logintampil');
    }

    public function loginuser(Request $request){
        if(Auth::attempt($request->only('name','password'))) {
            return redirect('/');
        }
        return redirect('/login');
    }


    
    public function register(){
        return view('registertampil');
    }

    public function registeruser(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),

        ]);
        return redirect('/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }


}
