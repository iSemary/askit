@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix mb-2">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <p class="card-text" style="font-weight: bold">
                                <span><i class="fas fa-question-circle"></i></span>
                               {{$Question->question_body}}
                                    @if($Question->privacy == "1")
                                        Anonymous
                                        @else
                                    <a href="/{{$User->where('id',$Question->from_id)->first()->user_name}}">
                                        <img class="img-thumbnail img-smally"
                                             src="{{asset('storage/'. $User->where('id',$Question->from_id)->first()->profile->avatar)}}" alt="">
                                        {{$User->where('id',$Question->from_id)->first()->full_name}}
                                    @endif

                                </a>
                            </p>
                            <p class="card-text" id="answer-card">
                                <a href="/{{$User->where('id',$Question->to_id)->first()->user_name}}" style="font-size: 11px;">
                                    <img class="img-thumbnail img-smally"
                                         src="{{asset('storage/'. $User->where('id',$Question->to_id)->first()->profile->avatar)}}" alt="">
                                {{$User->where('id',$Question->to_id)->first()->full_name}}</a>
                                <br>
                                <i class="fas fa-comment-dots"></i>
                                {{$Answer->answer_body}}
                            </p>
                            <p class="date-time"><i class="fas fa-calendar-alt"></i> {{$Answer->created_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection