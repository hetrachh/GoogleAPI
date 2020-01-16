<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Auth;
use Exception;

class LoginController extends Controller
{
    
    public function loginUser(Request $request)
    {

    }

    public function loginAdmin(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        $res = Auth::guard('api')->attempt(['email' => 'dpithwa@codal.com','password' => '1234']);
        var_dump($res);
        // try {
        //     if (Auth::guard('admin')->attempt($credentials)) {
        //         return 'pass';
        //     } else {
        //         return 'fail';
        //     }
        // } catch (Exception $e) {
        //        return $e;
        // }

    }
}
