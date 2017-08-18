@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new thread</div>
                <div class="panel-body">

                @include('partials.error')
                
                <form method="POST" action="/threads">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="title" class="form-control" name="title" value="{{ old('title') }}" autofocus required>        
                    </div>
                    <div class="form-group">
                    <label for="channel">Select Channel</label>
                    <select class="form-control" name="channel_id" required>
                        <option value="">Choose One</option>
                    @foreach ($channels as $channel)
                        <option value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? 'selected' : ''}} >{{$channel->name}}</option>
                    @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>      
                    </div>    
                    <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit new thread</button>     </div>               
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
