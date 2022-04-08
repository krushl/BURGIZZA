<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if(Auth::attempt($request->only(['login','password']))){
            return back()->withErrors([
                'errorRegister'=>'Пользователь с такими данными уже существует!'
            ]);
        }

        $user = User::create([
            'login'=>$request->login,
            'password'=> Hash::make($request->password),
            'role_id' => 2,
        ]);

        if($user){
            Auth::login($user);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'errorRegister' =>'что-то пошло не так...'
        ]);
    }
}
