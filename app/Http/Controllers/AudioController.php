<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recording;
use Illuminate\Support\Facades\Auth;

class AudioController extends Controller
{
    public function __construct() {
        $this->middleware('loginUser');
    }

    public function RecordingAudio(){
        return view('user.record-audio');
    }

    public function saveRecordingAudio(Request $request) {
        $audioName = null;
        if(!empty($request->audio_data)) {
            $audio = $request->audio_data;
            $audioName = time().'.'.$request->audio_data->extension();
            $folder = public_path('assets/audio');
            $audio->move($folder, $audioName);
        }
        $audio = new Recording();
        $audio->sender_id = Auth::user()->id;
        $audio->audio = $audioName;
        $audio->save();
    }
}
