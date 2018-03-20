@extends('layouts.app')

@section('content')
    @include('admin.includes.error')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center">
                <h3>Edit Tag ({{$tag->tag}})</h3>
            </div>

        </div>
        <div class="body">
            <form action="{{route('tag.update',['id'=>$tag->id])}}" method="Post">

                {{@csrf_field()}}
                <div class="form-gorup">


                    <label class="" for="name">Tag Name</label>
                    <input type="text" name="tag" value="{{$tag->tag}}" class="form-control">
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