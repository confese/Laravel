<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index()
    {
        return view("session/index");
    }
    function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email cannot be empty',
            'password.required'=>'Password cannot be empty',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infologin)){
            return redirect('student')->with('success', 'Login success');
        }else{
            return 'fail';
        }
    }

    function logout(){
        Auth::logout();
        return redirect('session')->with('success', 'Logout Success');
    }

    function register()
    {
        return view('session/register');
    }

    function create(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ],[
            'name.required' => 'Name cannot be empty',
            'email.required' => 'Email cannot be empty',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'Email already used',
            'password.required' => 'Password cannot be empty',
            'password.min' => 'Minimum 6 Character'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        User::create($data);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infologin)){
            return redirect('student')->with('success', Auth::user()->name . ' Login success');
        }else{
            return 'fail';
        }
    }
}
