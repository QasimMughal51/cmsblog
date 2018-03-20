@extends('layouts.app');
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center"><h3>Tags</h3></div>
        </div>
        <div class="panel-body">
            @if($tags->count()>0)
                <table style="text-align: center" class="table table-bordered table-stripped table-hover">
                    <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Edit/Delete</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->tag}}</td>
                            <td><a href="{{route('tag.edit',['id'=> $tag->id])}}" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="{{route('tag.delete',['id'=>$tag->id])}}" class="btn btn-danger">Delete</a></td>

                        </tr>
                    @endforeach
                    </tbody>


                </table>

            @else
                <div class="text-center text-danger"><h3>No Tags Found yet</h3></div>

            @endif

        </div>

    </div>
@endsection