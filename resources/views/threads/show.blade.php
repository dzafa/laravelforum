
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="author"><a href="#">{{ $reply->owner->name}}</a>
                            on {{$reply->created_at->diffForHumans()}}</div>
                    <div class="panel-body">
                        <div class="body">{{$reply->body}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
