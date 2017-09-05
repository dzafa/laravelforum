@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h4>{{  $profileUser->name }} - <small>Created at {{ $profileUser->created_at->diffForHumans() }}</small></h4>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>Info o korisniku</p>
                    </div>
                </div>

                <h4>Started threads by {{  $profileUser->name }}</h4>
                @include('threads.partials.list', ['threads' => $threads])
                {{ $threads->links() }}
            </div>
        </div>
    </div>
@endsection
