 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><a href="#">{{$thread->creator->name}}</a> posted: {{$thread->title}}</div>

                <div class="card-body">
                    <article>
                        <h4>{{ $thread->title}}</h4>
                        <div class="body">{{$thread->body}}</div>
                    </article>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach($thread->replies as $reply) 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="#">{{$reply->owner->name}}</a> replied {{$reply->created_at->diffForHumans()}}</div>
    
                <div class="card-body">
                    <article>
                        <div class="body">{{$reply->body}}</div>
                    </article>
                </div>
            </div>
        </div>
        @endforeach
        @if(Auth::check())
        <div class="col-md-8">
            <form action="{{$thread->path().'/replies/'}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <textarea name="body" class="form-control" cols="5" placeholder="post a reply..."></textarea>
                </div>
                <button type="submit" class="btn btn-info">post</button>
            </form>
        </div>
        @else
        <div class="col-md-8">
            <p class="text-center">Please <a href="{{route('login')}}">Sign in</a> to participate in this thread</p>
        </div>  
        @endif
    </div>
</div>
@endsection
