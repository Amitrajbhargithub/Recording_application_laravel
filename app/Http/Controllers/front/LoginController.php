<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Redirect;
use Hash;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    
    public function login() {
        return view('login');
    }

    public function demoLogin(Request $request) {
        $rule = [
            'email' => 'required|email',
            'password' => 'required|min:6|max:10'
        ];
        $validator = Validator::make($request->all(),$rule);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $user = User::where('email',$request->email)->first();
            if(!empty($user)) {
                // if($user->status !=0) {
                    $salt = $user->salt; 
                    if(! Hash::check($request->password.$salt, $user->password)) {
                        return Redirect::to('/login')->with('password', 'Password not Matched!')->withInput();
                    } else {
                        Auth::login($user);
                        return Redirect::to('/')->with('success', 'User Login Successfully');
                    }
                // } else {
                //     return Redirect::to('/login')->with('status','Your account not verified. Please check your gmail account and do verify.')->withInput();
                // }
            } else {
                return Redirect::to('/login')->with('email', 'Email Id not found')->withInput();
            }
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
