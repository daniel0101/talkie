@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Thread</div>

                <div class="card-body">
                    <form action="/threads" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" name="title" class="form-control" placeholder=""> 
                        </div>
                        <div class="form-group">
                            <label for="description">Body</label>
                            <textarea name="body" rows="5" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-fill btn-info">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
