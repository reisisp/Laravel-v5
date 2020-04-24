<?php

namespace App\Http\Controllers;


use App\Adaptors\Adaptor;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginVK()
    {
        if (Auth::check()) {
            return redirect()->route('news.index');
        }
        return Socialite::with('vkontakte')->redirect();
    }

    public function responseVK(Adaptor $userAdaptor)
    {
        if (Auth::check()) {
            return redirect()->route('news.index');
        }
        $user = Socialite::driver('vkontakte')->user();
        $userInSystem = $userAdaptor->getUserBySocId($user, 'vk');
        Auth::login($userInSystem);
        return redirect()->route('news.index');

    }
}
