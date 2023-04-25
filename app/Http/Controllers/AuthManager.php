<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    function signup(){
        return view('signup');
    }
 function loginPost(Request $request){
     $request->validate([
         'email' => 'required|email',
         'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/'
         ]);
     $credentials = $request->only('email','password');
     if (Auth::attempt($credentials)){
         return redirect()->intended(route('books.index'));
     }
     return redirect(route('login'))->with('error','Invalid Credentials');
 }
    function signupPost(Request $request){
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/|min:8'
        ],
        [

            'password.regex' => 'The password must contain at least one uppercase letter ,one lowercase letter,one digit.
   ,one special character and 8 characters long.',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user){
            return redirect(route('signup'))->with('error','Registration Failed, Try Again');
        }
        return redirect(route('login'))->with('success','Registration Successful');
    }
    function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect(route('login'));
    }

}
