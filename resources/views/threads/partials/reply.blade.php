<div class="panel panel-default">
    <div class="panel-heading">
        <div class="author"><a href="#">{{ $reply->owner->name}}</a>
                on {{$reply->created_at->diffForHumans()}}</div>
        <div class="panel-body">
            <div class="body">{{$reply->body}}</div>
        </div>
    </div>
</div>