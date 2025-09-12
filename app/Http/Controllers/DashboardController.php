<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
          $user = Auth::user()->load([
        'role',
        'messages',
        'moods',
        'journals',
        'challenges',
        'exercises'
    ]);
    $topPost = Post::inRandomOrder()->first();
return view('dashboard',compact(['user','topPost']));
    }
}
