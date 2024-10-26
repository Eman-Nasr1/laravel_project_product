<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
      //  dd($request->all());
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully.');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(request $request){
 //
        $validationData=$request->validate([
            
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
       // dd($validationData);
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);


    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

}
