<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
         $user = Socialite::driver('google')->user();

         $authUser = $this->firstOrCreateUser($user);
         Auth::login($authUser, true);

         return redirect()->route('home');
    }

    protected function firstOrCreateUser($user)
    {
        $authUser = User::where('email', $user->email)->firstOrCreate([
            'name' => $user->name,
            'email' => $user->email,
        ]);

        return $authUser;
    }
}
