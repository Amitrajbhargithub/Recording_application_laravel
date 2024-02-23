<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Redirect;
use Hash;
use Auth;
use App\Models\Recording;
use App\Mail\RegisterAccount;
class UserDashboard extends Controller
{
    public function __construct() {
        $this->middleware('loginUser');
    }
    public function Dashboard() {
        $audio = Recording::where('user_id',Auth::user()->id)->get();
        return view('user.dashboard',compact('audio'));
    }

    public function Profile() {
        return view('user.profile');
    }

    public function updateProfile(Request $request) {
        $validate = [
            'name' => 'required',
            'phone' => 'required|digits:10|numeric',
            'password' => 'required|min:6|max:10',
            'image' => 'required'
        ];
        $validator = Validator::make($request->all(),$validate);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $image = $request->image;
            $path = $image->getClientOriginalName();
            $folder = public_path('assets/images/profile');
            $image->move($folder, $path);
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->phone_2 = $request->phone;
            $user->password = Hash::make($request->password);
            $user->show_password = $request->password;
            $user->image = $path;
            $user->save();
            // \Mail::to($request->email)->send(new RegisterAccount($user));
            return Redirect::to('/user/profile')->with('success','Profile update successfully.');
        }
    }
}
