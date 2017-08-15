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
        <div class="col-md-8 col-md-offset-2">
            @foreach ($thread->replies as $reply)
                @include('threads.partials.reply')
            @endforeach
        </div>
    </div>
    @if (auth()->check())
    <div class="row">
       <div class="col-md-6 col-md-offset-3">
             <form class="form-horizontal" method="POST" action="{{ $thread->path().'/replies'}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Write something?" rows="5" required></textarea>
                    <br/>
                    <button type="submit" class="btn btn-default">Post</button>
                </div>                
            </form>
        </div>
    </div>
    @else 
        <p class="text-center">Please <a href="/login">sign in </a>to participate in this discussion<p>
    @endif
</div>
@endsection