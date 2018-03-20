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
                <h3>Create New Post</h3>
            </div>

        </div>
        <div class="body">
            <form action="{{route('post.store')}}" method="Post" enctype="multipart/form-data">

                {{@csrf_field()}}
                <div class="form-gorup">
                    <label class="" for="name">Post Title</label>
                    <input type="text" name="title" placeholder="Enter Post Title" class="form-control" value="{{old('title')}}">
                </div>
                <div class="form-gorup">
                    <label  for="category">Select Category</label>
                    <select name="category"  class="form-control">
                        <option value="">--Select Category--</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>

                </div>
                <div class="form-gorup">
                    <label class="" for="featured">Post Featured Image</label>
                    <input type="file" name="featured"  class="form-control">
                </div>
                <div class="form-group  checkbox-inline ">

                    <div ><lable>Tags</lable> </div>
                    @foreach($tags as $tag)
                        <div class="checkbox  ">
                            <lable><input type="checkbox" name="tags[]" value="{{$tag->id}}">{{$tag->tag}}</lable>
                        </div>

                    @endforeach

                </div>
                <div class="form-gorup">
                    <label class="" for="content">Post Content</label>
                    <textarea name="post_content" id="summernote" class="form-control" placeholder="Enter Post Content" cols="30" rows="10">{{old('content')}}</textarea>
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