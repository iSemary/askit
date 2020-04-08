<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Follow;
use App\Question;
use App\Answer;
class AnswersController extends Controller
{
    public function delete($AnswerID){
        $Answer = Answer::where('id',$AnswerID);
        $Question = Question::where('id',$Answer->first()->question_id);

        if ($Answer->first()->to_id == Auth::user()->id){
            $Question->first()->update(['answerd' => '0']);
            $Answer->delete();

            session()->flash('answer-deleted','Answer deleted successfully, and the question had been moved to Questions.');
            return redirect(route('profile.index',Auth::user()->user_name));
        }else {
            return redirect(route('profile.index',Auth::user()->user_name));
        }
    }
    public function index($AnswerID){
        $Answer = Answer::where('id',$AnswerID)->first();
        $Question = Question::where('id',$Answer->question_id)->first();

        return view('user.SelectedAnswer')->with('Answer',$Answer)->with('Question',$Question)->with('User',User::all());

    }
}
