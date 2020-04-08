<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Setting;
use App\Profile;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('profile.setting')->with('user', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,Profile $profile , $id)
    {


//        dd($request);
        $user->where('id',$id)->update([
            'full_name'=> $request->full_name,
            'email'=> $request->email
        ]);

        if ($request->hasFile('avatar')){
            $profileAvatar = $request->avatar->store('user-avatar','public');
            if($profile->where('user_id',$id)->first()->avatar != "user-avatar/default-avatar.png"){
                Storage::disk('public')->delete($profile->where('user_id',$id)->first()->avatar);
            }
            $profile->where('user_id',$id)->first()->update(['avatar'=>$profileAvatar]);
        }


        session()->flash('success','Your Settings updated successfully.');
        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
