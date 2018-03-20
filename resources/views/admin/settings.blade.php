@extends('layouts.app')

@section('content')
    @include('admin.includes.error')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="text-center">
                <h3>Settings</h3>
            </div>

        </div>
        <div class="body">
            <form action="{{route('settings.update')}}" method="Post">

                {{@csrf_field()}}
                <div class="form-gorup">
                    <label  for="sitename">Site Name</label>
                    <input type="text" name="name" value="{{$settings->site_name}}" class="form-control">
                </div>
                <div class="form-gorup">
                    <label  for="email">Email</label>
                    <input type="text" name="name" value="{{$settings->email}}" class="form-control">
                </div>
                <div class="form-gorup">
                    <label  for="contact">Contact</label>
                    <input type="text" name="name" value="{{$settings->contact_no}}" class="form-control">
                </div>
                <div class="form-gorup">
                    <label for="Address">Address</label>
                    <input type="text" name="name" value="{{$settings->address}}" class="form-control">
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