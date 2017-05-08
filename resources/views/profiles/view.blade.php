@extends('layouts.master')

@section('title')
    {{$prof_username}}'s profile
@stop

@section('content')
    <h3>Profile of {{$prof_username}}
        @if($user->is_admin === 1)
            <span class="label label-success"><i class="fa fa-user-md"></i> Admin</span>
        @endif
    </h3>
    <hr/>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <img src="{{url('/images/default_profile2.png')}}"
                     class="img-circle img-responsive img-raised"
                    />
                <br/>
                <br/>
            </div>

            <div class="col-sm-9">
                <table class="table table-responsive">
                    <tr>
                        <td colspan="3">Joined <span data-time-format="time-ago" data-time-value="{{strtotime($user['created_at'])}}"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>:</td>
                        <td>{{$user['email']}}</td>
                    </tr>
                </table>
                @if(Session::get('id') === $user->id)
                <h4>Change password</h4>
                <form action="{{url('/changepassword')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ Session::get('id') }}">
                    <div class="label-floating form-group col-xs-6">
                        <label class="control-label" for="old_password">Old password</label>
                        <input class="form-control" type="password" name="old_password" />
                    </div>
                    <div class="label-floating form-group col-xs-6">
                        <label class="control-label" for="new_password">New password</label>
                        <input class="form-control" type="password" name="new_password" />
                    </div>
                    <div class="col-xs-12">
                        <button class="btn btn-primary"><i class="fa fa-edit"></i> Change password</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
@stop

@section('sidebar')
    @extends('layouts.sidebar')

    @parent
@stop