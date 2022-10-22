<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register() {
        return view('user.register');
    }

    public function reg_user(Request $request) {
        $validated = $request->validate([
            'email'    => 'required|email|min:5|max:255',
            'password' => 'required|min:5|max:255',
            'password_2' => 'required|min:5|max:255',
        ]);

        if ($validated['password'] != $validated['password_2']) {
            return back()->withErrors([
                'password' => 'Пароли не совпадают',
            ]);
        };

        $user = new User();
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        $credentials = [
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }
    }

    public function login() {
        return view('user.login');
    }

    public function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('home');
    }


    public function auth(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email|min:5|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        // return Hash::make($credentials['password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Такой пользователь не существует',
        ])->onlyInput('email');
    }
}
