<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;
use Exception;

class SocialLoginController extends Controller
{
    public function providers()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBack()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $existsUser = User::where('email', $user->email)->first();

        try {
            if ($existsUser) {
                Auth::loginUsingId($existsUser->id);
            } else {
                $u = new User;
                $u->name = $user->name;
                $u->email = $user->email;
                $u->google_id = $user->id;
                $u->password = md5(rand(1, 10000));
                $u->save();
                Auth::loginUsingId($u->id);
            }
            return redirect()->to('/home');
        } catch (Exception $e) {
                echo $e;
        }
    }
    
    public function home()
    {
        $user = Auth::user();
        if ($user) {
            return view('home', ['user'=>$user]);
        } else {
            return redirect()->to('/google_login');
        }
    }
}
