@extends('layouts.app')

@section('content')
    @include('admin.includes.error')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center">
                <h3>Edit Category ({{$category->name}})</h3>
            </div>

        </div>
        <div class="body">
            <form action="{{route('category.update',['id'=>$category->id])}}" method="Post">

                {{@csrf_field()}}
                <div class="form-gorup">


                    <label class="" for="name">Category Name</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
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