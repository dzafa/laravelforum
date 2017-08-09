
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Created by 
                    <a href="#">{{$thread->owner->name}}</a>
                        {{$thread->title}}</div>
                <div class="panel-body">
                    <div class="body">{{$thread->body}}</div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach ($thread->replies as $reply)
                @include('threads.partials.reply')
            @endforeach
        </div>
    </div>
    @if (auth()->check())
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
           Hello
        </div>
    </div>
    @endif
</div>
@endsection
