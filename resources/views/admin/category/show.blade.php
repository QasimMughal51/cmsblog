@extends('layouts.app');
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center"><h3>Categories</h3></div>
        </div>
        <div class="panel-body">
            @if($categories->count()>0)
                <table style="text-align: center" class="table table-bordered table-stripped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Edit/Delete</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td><a href="{{route('category.edit',['id'=> $category->id])}}" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="{{route('category.destroy',['id'=>$category->id])}}" class="btn btn-danger">Delete</a></td>

                        </tr>
                    @endforeach
                    </tbody>


                </table>

                @else
                <div class="text-center text-danger"><h3>No Category Found yet</h3></div>

            @endif

        </div>

    </div>
    @endsection