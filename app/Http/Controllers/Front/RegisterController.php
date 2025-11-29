<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Redirect;
use Hash;
use Auth;
use Str;
use App\Mail\RegisterAccount;
use App\Mail\MailConfirmation;
class RegisterController extends Controller
{
    public function register() {
        return view('registration');
    }

    public function SaveUser(Request $request) {
        $validate = [
            'name' => 'required',
            'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
            'phone' => 'required|digits:10|numeric',
            'password' => 'required|min:6|max:10'
        ];
        $validator = Validator::make($request->all(),$validate);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $salt = Str::random(10);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password.$salt);
            $user->show_password = $request->password;
            $user->salt = $salt;
            $user->save();
            // \Mail::to($request->email)->send(new RegisterAccount($user));
            return Redirect::to('/register')->with('success','Registration Successfully.Please check your gmail account and do verify.');
        }
    }

    public function verifyAccount($id) {
        $user_id = decrypt($id);
        $update = User::find($user_id);
        $update->is_email_verified = '1';
        $update->save();
        \Mail::to($update->email)->send(new MailConfirmation($update));
        return view('verification-page');
    }
}
