<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){

        // dd($request->email);
        // validation
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
            'user_type' => 'required',
        ]);
        // dd($request->user_type);
        User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'username'=>$request->username,
            'user_type'=>$request->user_type,
            'password'=>Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));
        
        // redirect
        if($request->user_type == 'seller'){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('home');
        }
        
    }
}
