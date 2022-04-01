<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.index');
    }

    public function changeOptional(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('home');
        }

        $user = User::find(Auth::id());
        if ($user) {
            $user->name = $user->name ?? $request->userName;
            $user->email = $user->email ?? $request->userEmail;

            if (!$user->save()) {

                return back()->withErrors(
                    [
                        'errorProfile' => 'Чет пошло не так'
                    ]
                );
            }
        }

        return redirect()->route('profile');
    }
}
