<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeditationController extends Controller
{
    public function user(){
        return view('meditation.user');
    }
    
}
