@forelse ($threads as $thread)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <div class="flex">
                    <h4><a href=" {{$thread->path()}}">{{$thread->title}}</a></h4>
                    Created by <a
                            href="/profiles/{{$thread->owner->name}}">{{ $thread->owner->name }}</a> {{ $thread->created_at->diffForHumans()}}
                </div>

                <strong><a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}</a></strong>
                @can ('update', $thread)
                    <form action="{{ $thread->path() }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button style="margin-left:5px;" class="btn btn-link btn-sm" type="submit">
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
        <div class="panel-body">
            {{$thread->body}}
        </div>
    </div>
    @empty
    <p>There is no threads at this moment.</p>
@endforelse