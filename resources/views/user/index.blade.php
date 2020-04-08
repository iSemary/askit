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
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <form style="display: inline;" action="{{route('profile.follow',$user->user_name)}}"
                              method="get">
                            <button type="submit" class="btn btn-success btn-sm">
                                @if($user->follow->where('from_id' , Auth()->user()->id)->where('to_id',$user->id)->count() > 0)
                                    Unfollow
                                @else
                                    Follow
                                @endif
                            </button>
                        </form>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="#">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Overview </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Account Settings </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="glyphicon glyphicon-ok"></i>
                                    Tasks </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-flag"></i>
                                    Help </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                @if(Session::has('success'))
                    <div class="alert alert-primary" id="hideMe">{{ Session::get('success') }}</div>
                @endif
                @if(Session::has('question-success'))
                    <div class="alert alert-primary" id="hideMe">{{ Session::get('question-success') }}</div>
                @endif
                <div class="profile-content">
                    <div class="ask-section">
                        <form action="{{action('QuestionsController@Ask')}}" method="POST">
                            @csrf
                            <div class="form-group" id="AskSection">
                                <label for="exampleFormControlTextarea1">Ask <b>{{$user->full_name}}</b> something
                                    !</label>
                                <input type="hidden" name="Username" value="{{$user->user_name}}">
                                <textarea class="form-control" name="QuestionBody" id="exampleFormControlTextarea1"
                                          placeholder="When, Where and why ?! | Make your question now!"
                                          rows="3"></textarea>
                                <div class="ask-section-btns pt-2">
                                    <label class="switch">
                                        <input type="checkbox" name="anonymous" checked>
                                        <span class="slider round"></span>
                                    </label><span class="ml-2" style="font-weight: bold;font-size: 12px">Ask Anonymously</span>
                                    <button type="submit" id="AskBtn" class="btn btn-primary float-right">Ask</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- Questions--}}
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
@section('scripts')
@endsection