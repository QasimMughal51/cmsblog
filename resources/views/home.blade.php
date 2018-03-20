@extends('layouts.app')

@section('content')
     <div class="panel panel-primary">
         <div class="panel-heading text-center"><h3>Dashboard</h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   {{Auth::user()->name}} you are logged in!
                </div>
            </div>

@endsection
