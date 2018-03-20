@extends('layouts.app');
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center"><h3>Users</h3></div>
        </div>
        <div class="panel-body">
            @if($users->count()>0)
                <table style="text-align: center" class="table table-bordered table-stripped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Permission</th>
                        <th>Delete</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img height="40" width="40"  src="{{$user->profile->avatar}}" alt="{{$user->profile->avatar}}"></td>
                            <td>{{$user->name}}</td>
                           @if($user->admin)
                                <td><a href="{{route('user.remove.admin',['id'=>$user->id])}}" class="btn btn-warning">Remove Admin</a></td>
                               @else
                                <td><a href="{{route('user.make.admin',['id'=>$user->id])}}" class="btn btn-success">Make Admin</a></td>
                               @endif
                            <td><a href="{{route('user.delete',['id'=>$user->id])}}" class="btn btn-danger">Delete</a></td>

                        </tr>
                    @endforeach
                    </tbody>


                </table>
            @else
                <div class="text-center text-danger"><h3>No User Found Yet</h3></div>
            @endif
        </div>

    </div>
@endsection