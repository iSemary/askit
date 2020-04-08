@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(Session::has('delete-success'))
                    <div class="alert alert-primary" id="hideMe">{{Session::get('delete-success')}}</div>
                    @endif
                @forelse($Questions as $Question)
                    <div class="main-box clearfix mb-2">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                @if($Question->privacy == "1")
                                    <h6 class="card-title"><i class="fas fa-user-secret"></i> Question From Anonymous</h6>
                                @else
                                    <h6 class="card-title">Question From <a class="text-primary" href="/{{$users->where('id',$Question->from_id)->first()->user_name}}">{{$users->where('id',$Question->from_id)->first()->full_name}}</a></h6>
                                @endif
                                <p class="card-text">{{$Question->question_body}}</p>
                                <p class="date-time"><i class="fas fa-calendar-alt"></i> {{$Question->created_at}}</p>
                                <a href="{{route('question.show',$Question->id)}}" class="btn btn-success" ><i class="fas fa-feather"></i> Answer</a>
                                <a href="{{route('question.delete',$Question->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card" style="width: 100%;">
                        <div class="card-body text-center">
                            No Questions yet.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection