@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            @if($question->privacy == "1")
                                <h6 class="card-title"><i class="fas fa-user-secret"></i> Question From Anonymous</h6>
                            @else
                                <h6 class="card-title">Question From <a class="text-primary"
                                                                        href="/{{$users->where('id',$question->from_id)->first()->user_name}}">{{$users->where('id',$question->from_id)->first()->full_name}}</a>
                                </h6>
                            @endif
                            <p class="card-text">{{$question->question_body}}</p>
                            <div class="form-group">
                                <form action="{{route('question.answer',$question->id)}}" method="POST">
                                    @csrf
                                    <textarea name="question_answer" class="form-control" cols="10" rows="5" placeholder="Answer the below question..."></textarea>
                                    <button class="btn btn-success float-right mt-3" type="submit"><i class="fas fa-feather"></i> Answer</button>
                                </form>
                            </div>
                            <p class="date-time"><i class="fas fa-calendar-alt"></i> {{$question->created_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection