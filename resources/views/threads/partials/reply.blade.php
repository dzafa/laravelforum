<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <div class="flex">
                <a href="#">{{ $reply->owner->name}}</a>
                 {{ "  on " .$reply->created_at->diffForHumans()}}
            </div>
            <div class="favorite">
                <form action="{{ $thread->path() . '/replies/' .$reply->id . '/favorites' }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-default  btn-sm" type="submit" {{ $reply->isFavorited() ? 'disabled' : ''}}>
                        {{ $reply->favorites()->count() }} {{ str_plural('Like', $reply->favorites()->count()) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

     <div class="panel-body">
        <div class="body">{{$reply->body}}</div>
    </div>
</div>
