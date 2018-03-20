@extends('layouts.app')

@section('content')
    @include('admin.includes.error')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center">
                <h3>Create New Category</h3>
            </div>

        </div>
        <div class="body">
            <form action="{{route('category.store')}}" method="Post">

                {{@csrf_field()}}
                <div class="form-gorup">


                    <label class="" for="name">Category Name</label>
                    <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                </div>
                <div class="form-group ">
                    <div class="text-center " style="margin-top: 10px; ">
                        <input type="submit" class="btn btn-success" value="Create" >
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection