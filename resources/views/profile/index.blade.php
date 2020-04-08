@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{asset('storage/'.$user->profile->avatar)}}" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{$user->full_name}}
                        </div>
                        <div class="profile-usertitle-job">
                            {{'@'.$user->user_name}}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <div class="btn btn-success" style="background-color: #3F51B5;border-color: #3a4bab;">
                                    Followers<span class="badge badge-light">{{$user->follow->count()}}</span></div>
                            </li>
                            <li>
                                <div class="btn btn-success" style="background-color: #9C27B0;border-color: #6a1b9ade;">
                                    Following<span
                                            class="badge badge-light">{{$following->where('from_id','=','1')->where('to_id','<>','1')->count()}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="btn btn-dark" style="background-color: #2196F3;border-color: #1565c078;">
                                    Answers<span class="badge badge-light">{{$answers->count()}}</span></div>
                            </li>
                            <li>
                                <div class="btn btn-primary" style="background-color: #009688;border-color: #028477;">
                                    Likes<span class="badge badge-light">{{$answers->count()}}</span></div>

                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                @if(Session::has('error'))
                    <div class="alert alert-danger" id="hideMe">{{ Session::get('error') }}</div>
                @endif
                @if(Session::has('answer-success'))
                    <div class="alert alert-success" id="hideMe">{{ Session::get('answer-success') }}</div>
                @endif
                @if(Session::has('answer-deleted'))
                    <div class="alert alert-success" id="hideMe">{{ Session::get('answer-deleted') }}</div>
                @endif
                <div class="profile-content">
                    @forelse($answers as $answer)
                        <div class="main-box clearfix mb-2">
                            <div class="card" style="width: 100%;">
                                <div class="card-body">
                                    <p class="card-text" style="font-weight: bold">
                                        <span><i class="fas fa-question-circle"></i></span>
                                        {{$questions->where('id',$answer->question_id)->first()->question_body}}
                                        @if($questions->where('id',$answer->question_id)->first()->privacy == "1")
                                            <i class="fas fa-user-secret"></i>
                                        @else
                                            <a href="{{$other_user->where('id',$answer->from_id)->first()->user_name}}">
                                                <img class="img-thumbnail img-smally"
                                                     src="{{asset('storage/'.$other_user->where('id',$answer->from_id)->first()->profile->avatar)}}"
                                                     alt="">
                                                {{$other_user->where('id',$answer->from_id)->first()->full_name}}
                                            </a>
                                        @endif
                                    </p>
                                    <p class="card-text" id="answer-card">
                                        <i class="fas fa-comment-dots"></i>
                                        {{$answer->answer_body}}
                                    </p>
                                    <p class="date-time"><i class="fas fa-calendar-alt"></i> {{$answer->created_at}}</p>
                                    <form action="{{route('answer.delete',$answer->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        No Answers yet...
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
