<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use App\Question;
use App\Answer;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Following = Follow::where('from_id',Auth()->user()->id)->get("to_id");
        $GetUser = User::all();
        return view('home.index')->with('users',User::whereIn('id', $Following)->get())->with('getuser',$GetUser);
    }
}
