@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4>{{$thread->title}}</h4>
                <br/>Created by 
                    <a href="#">{{$thread->owner->name}}</a>
                    on {{ $thread->created_at->diffForHumans()}}
                        </div> 
                <div class="panel-body">
                    <div class="body">{{$thread->body}}</div>

                </div>
            </div>
            <div class="replies">
                @foreach ($replies as $reply)
                    @include('threads.partials.reply')
                @endforeach
            </div>

            {{ $replies->links() }}

            @if (auth()->check())
            <div class="comment">
                <form method="POST" action="{{ $thread->path().'/replies'}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Write something?" rows="5" required></textarea>
                        <br/>
                        <button type="submit" class="btn btn-default">Post</button>
                    </div>
                </form>
            </div>
            @else
                <p class="text-center">Please <a href="/login">sign in </a>to participate in this discussion<p>

            @endif
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="#">{{ $thread->owner->name }}</a> and have {{ $thread->replies_count }} {{  str_plural('comment', $thread->replies_count) }}.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection