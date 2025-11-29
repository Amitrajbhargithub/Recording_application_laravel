<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Redirect;
use App\Models\Contact;
use App\Models\NewsLetter;
class ContactController extends Controller
{
    public function contact() {
        return view('contact');
    }

    public function saveFeedback(Request $request) {
        $rule = [
            'name' => 'required',
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
            'phone' => 'required|digits:10|numeric',
            'message' => 'required'
        ];
        $validate = Validator::make($request->all(),$rule);
        if($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput();
        } else {
            $user_id = '';
            if(Auth::check()){
                $user_id = Auth::user()->id;
            }
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->user_id = $user_id;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();
            return Redirect::to('/contact')->with('success','Feedback send successfully.');
        }
    }

    public function newsLetter(Request $request) {
        $rule = [
            'news_email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
        ];

        $validate = Validator::make($request->all(),$rule);
        if($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput();
        } else {
            $user_id = '';
            if(Auth::check()){
                $user_id = Auth::user()->id;
            }
            $news = new NewsLetter();
            $news->email = $request->news_email;
            $news->user_id = $user_id;
            $news->save();
            return redirect($request->route)->with('newsletter','news letter send successfully');
        }
    }
}
