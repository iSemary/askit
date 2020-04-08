<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Follow;
use App\Question;
use Illuminate\Http\Request;

use App\User;
class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index')
            ->with('users',User::all())
            ->with('questions',Question::all())
            ->with('answers',Answer::all())
            ->with('follows',Follow::all());
    }
}
