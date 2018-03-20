@extends('layouts.app')
@section('styles')

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection

@section('content')
    @include('admin.includes.error')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center">
                <h3>Edit Profile</h3>
            </div>

        </div>
        <div class="body">
            <form action="{{route('user.update',['id'=>$user->id])}}" method="Post" enctype="multipart/form-data">

                {{@csrf_field()}}
                <div class="form-gorup">

                    <label  for="name">User Name</label>
                    <input type="text" name="username" placeholder="Enter User Name" class="form-control" value="{{$user->name}}">
                </div>
                <div class="form-gorup">

                    <label  for="email">User Email</label>
                    <input type="email" name="email" placeholder="Enter Email Address" class="form-control" value="{{$user->email}}">
                </div>
                <div class="form-gorup">

                    <label c for="avatar">Avatar</label>
                    <input type="file" name="avatar"  class="form-control" >
                </div>
                <div class="form-gorup">

                    <label for="facebook">Facebook</label>
                    <input type="url" name="facebook" placeholder="Enter facebook Address" class="form-control" value="{{$user->profile->facebook}}">
                </div>
                <div class="form-gorup">

                    <label  for="bio">About</label>
                    <textarea name="bio" id="summernote" class="form-control" cols="30" rows="10">
                        {{$user->profile->bio}}
                    </textarea>
                </div>
                <div class="form-gorup">

                    <label class="" for="password"> Create New Password</label>
                    <input type="password" name="password" placeholder="Enter Password" class="form-control">
                </div>

                <div class="form-group ">
                    <div class="text-center " style="margin-top: 10px; ">
                        <input type="submit" class="btn btn-success" value="Update" >
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection