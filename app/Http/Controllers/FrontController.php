<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function aboutUs() {
        return view('about');
    }

    public function program() {
        return view('program');
    }

}
