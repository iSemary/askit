@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>User</span></th>
                                <th class="text-center"><span>Status</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($user))
                                @forelse($user as $users)
                                    <tr>
                                        <td>
                                            <img src="{{asset('storage/'.$users->profile->avatar)}}" alt="">
                                            <a href="/{{$users->user_name}}" class="user-link">{{$users->full_name}}</a>
                                            <span class="user-subhead"><a href="/{{$users->user_name}}">{{"@".$users->user_name}}</a></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="label label-default">Inactive</span>
                                        </td>
                                    </tr>
                                    <br>
                                @empty
                                    <tr><td><p class="text-center text-dark">No Records Found For <strong> @if(isset($_GET['value'])){{$_GET['value']}}@endif </strong>.</p></td></tr>
                            @endforelse
                            @else
                                @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <img src="{{asset('storage/'.$user->profile->avatar)}}" alt="">
                                            <a href="/{{$user->user_name}}" class="user-link">{{$user->full_name}}</a>
                                            <span class="user-subhead"><a href="/{{$user->user_name}}">{{"@".$user->user_name}}</a></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="label label-default">Inactive</span>
                                        </td>
                                    </tr>
                                    <br>
                                @empty
                                    <tr><td><p class="text-center text-dark">No friends yet.</p></td></tr>
                                @endforelse
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection