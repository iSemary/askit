@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 pb-2 col-md-8 col-xl-8">
                <div class="card-header">Questions</div>
                    @forelse($users as $user)
                        @foreach($user->question->where('answerd','1')->all() as $questions)
                            <div class="card mb-2" style="width: 100%;">
                                <div class="card-body">
                                    <p class="card-text" style="font-weight: bold">
                                        <span><i class="fas fa-question-circle"></i></span>
                                        {{$questions->question_body}}
                                        @if($questions->privacy == "1")
                                            <i class="fas fa-user-secret"></i>
                                            Anonymous
                                        @else
                                            <a href="/{{$getuser->where('id',$questions->from_id)->first()->user_name}}" style="font-size: 11px;">
                                                <img class="img-thumbnail img-smally" style="width: 35px;"
                                                     src="{{asset('storage/'.$getuser->where('id',$questions->from_id)->first()->profile->avatar)}}"
                                                     alt="">
                                                {{$getuser->where('id',$questions->from_id)->first()->full_name}}
                                            </a>
                                        @endif
                                </p>

                                <p class="card-text" id="answer-card">
                                    <a href="/{{$user->user_name}}" style="font-size: 11px;">
                                        <img class="img-thumbnail img-smally" style="width: 35px;"
                                             src="{{asset('storage/'.$user->profile->avatar)}}"
                                             alt="">
                                        {{$user->full_name}}
                                    </a>
                                    <br>
                                    <a class="answer-link" href="{{route('answer.index',$user->answer->where('question_id',$questions->id)->first()->id)}}">
                                    <i class="fas fa-comment-dots"></i> {{$user->answer->where('question_id',$questions->id)->first()->answer_body}}
                                    </a>
                                </p>
                                <p class="date-time"><i
                                            class="fas fa-calendar-alt"></i> 
                                    {{$user->answer->where('question_id',$questions->id)->first()->created_at}}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @empty
                        NO Followers
                    @endforelse
    </div>
    <div class="col-12 col-md-4 col-xl-4">
        <div class="card">
            <div class="card-header">Recommend Users</div>
            <div class="card-body">
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
                <a href=""><img data-toggle="tooltip" data-placement="top" title="User" class="img-smally m-2"
                                src="{{asset('storage/user-avatar/default-avatar.png')}}" alt=""></a>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection