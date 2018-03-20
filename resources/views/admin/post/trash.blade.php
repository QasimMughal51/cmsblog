@extends('layouts.app');
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center"><h3>Trashed Posts</h3></div>
        </div>
        <div class="panel-body">
            @if($posts->count() >0)
                <table style="text-align: center" class="table table-bordered table-stripped table-hover">
                    <thead>
                    <tr>
                        <th>Post Featured Image</th>
                        <th>Post Title</th>
                        <th>Restore/Delete</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><img height="50" width="100" src="{{$post->getFeatured()}}" alt="Post Image"></td>
                            <td>{{$post->title}}</td>
                            <td><a href="{{route('post.restore',['id'=>$post->id])}}" class="btn btn-success">Restore</a>&nbsp;&nbsp;<a href="{{route('post.delete',['id'=>$post->id])}}" class="btn btn-danger">Delete</a></td>

                        </tr>
                    @endforeach
                    </tbody>


                </table>
                @else
                        <div class="text-center text-danger"><h4>No Trashed Post Found Yet</h4></div>

            @endif
        </div>

    </div>
@endsection