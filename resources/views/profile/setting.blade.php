@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif
                <form action="{{route('settings.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="full_name" value="{{$user->where('id',Auth::user()->id)->first()->full_name}}" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="full_name">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" name="user_name" class="form-control" id="inlineFormInputGroup" value="{{$user->where('id',Auth::user()->id)->first()->user_name}}" placeholder="Username" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$user->where('id',Auth::user()->id)->first()->email}}" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <a href="" class="btn btn-danger">Change Password</a>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Avatar</label><br>
                        <img src="{{asset('storage/'.Auth::user()->profile->avatar)}}" width="50px;border-radius:100%" alt="">
                        <input type="file" name="avatar" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
