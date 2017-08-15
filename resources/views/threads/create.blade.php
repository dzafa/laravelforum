@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new thread</div>
                <div class="panel-body">
                <form method="POST" action="/threads">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="title" class="form-control" name="title" value="{{ old('title') }}" required autofocus>        
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" class="form-control" placeholder="Write something?" rows="5" required></textarea>      
                    </div>    
                    <div class="form-group">
                    <button type="submit" class="btn btn-default">Post</button>     </div>               
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
