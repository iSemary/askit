<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\User;
use App\Follow;
use App\Question;
class ProfileController extends Controller {
    public function follow($ProfileUSERNAME) {
        $ProfileID = User::all()->where('user_name', $ProfileUSERNAME)->first()->id;
        if ($ProfileID != Auth()->user()->id) {

            $Followed = User::all()->where('user_name', $ProfileUSERNAME)->first()->follow->where('from_id', Auth()->user()->id)->where('to_id', User::all()->where('user_name', $ProfileUSERNAME)->first()->id)->count();
            if ($Followed != '1') {
                // I Didn't Follow This User So Le'ts Follow

                Follow::create([
                    'from_id'=>Auth()->user()->id,
                    'to_id'=>$ProfileID
                ]);
                session()->flash('success','Followed !');
                return redirect($ProfileUSERNAME);
            } else {
                // I Followed This user so i will unfollow => Delete Record
                $Unfollow = Follow::where('from_id' , Auth()->user()->id)->where('to_id',$ProfileID);
                $Unfollow->delete();

                session()->flash('success','UnFollowed !');
                return redirect($ProfileUSERNAME);
            }
        } else {
            session()->flash('error', 'You cannot follow yourself!');
            return redirect($ProfileUSERNAME);
        }
    }

    public function friends(){
        $Following = Follow::where('from_id',Auth()->user()->id)->get("to_id");
        return view('user.friends')->with('users',User::whereIn('id', $Following)->get());

    }

    public function find(Request $request){
        if($request->has('value')) {
            $value = $request->value;

            $users = User::where('user_name', 'like', '%'.$value.'%')->orderBy('id')->paginate(20);

            if ($users->isEmpty() ){
                $users = User::where('full_name', 'like', '%'.$value.'%')->orderBy('id')->paginate(20);
            }


            return view('user.friends')->with('user',$users);
        }else {
            return redirect(route('profile.friends'));
        }

    }

}
