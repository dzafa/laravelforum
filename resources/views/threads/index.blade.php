@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h4>Threads</h4>
                @include('threads.partials.list', ['threads' => $threads])
                {{ $threads->links() }}
            </div>
        </div>
    </div>
@endsection
