<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Follow;
use App\Question;
use App\Answer;
class QuestionsController extends Controller
{
    public function ask(Request $request){
        $UserID = User::where('user_name',$request->Username)->first()->id;
        if($request->anonymous == "on"){$UserAnon = "1";}else{$UserAnon = "0";}


        Question::create([
            'from_id'=>Auth::user()->id,
            'to_id'=>$UserID,
            'question_body'=>$request->QuestionBody,
            'privacy'=>$UserAnon
        ]);

        session()->flash('question-success','Your Question have been sent !');
        return back();
    }
    public function index(){
        $Questions = Question::where('to_id',Auth::user()->id)->where('answerd','0')->get();
//        dd($Questions);
        return view('profile.questions')->with('Questions',$Questions)->with('users',User::all());

    }
    public function delete($QuestionID){
        $question = Question::where('id',$QuestionID)->where('to_id',Auth::user()->id)->first();
        if ($question){
            $question->delete();
            session()->flash('delete-success','Question Deleted.');
            return redirect(route('profile.questions'));
        }else{
            return redirect(route('profile.questions'));
        }
    }
    // Show Question To answer it
    public function show($QuestionID){
        $question = Question::where('id',$QuestionID)->where('to_id',Auth::user()->id)->first();
        if ($question){
            return view('profile.SelectedQuestion')->with('question',$question)->with('users',User::all());
        }else{
            return redirect(route('profile.questions'));
        }
    }
    public function answer(Request $request, $QuestionID){
        $question = Question::where('id',$QuestionID)->where('to_id',Auth::user()->id)->first();
        if ($question && $question->answerd == "0"){
            Answer::create([
                'question_id'=>$question->id,
                'from_id'=>$question->from_id,
                'to_id'=>$question->to_id,
                'answer_body'=>$request->question_answer
            ]);
            // Mark Question as Answerd
            $question->answerd = "1";
            $question->save();


            // Get Question Owner Name if exist or anonymous
            if ($question->privacy == "1"){
                $QuestionFromUser = "Anonymous";
            }else{
                $QuestionFromUser = User::where('id',$question->from_id)->first()->full_name;
            }

            session()->flash('answer-success','You Answered From '.$QuestionFromUser.' have been sent !');
            return redirect(route('profile.index',Auth::user()->user_name));
        }else{
            return redirect(route('profile.questions'));
        }
    }
}
