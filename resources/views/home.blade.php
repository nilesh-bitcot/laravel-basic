@extends('master')

@section('title', 'Blog Site')

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

<div class="row">
    <div class="col-sm-12">
        <h2>Post Message</h2>

        <form action="/create" method="post" enctype="multipart/form-data">

            <input type="text" class="form-control" name="title" placeholder="title"><br>
            <input type="text" class="form-control" name="content" placeholder="content"><br>
            <div class="mb-3">
                <input type="file" class="form-control" name="image" id="image" />
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">submit</button>

        </form>
    </div>
</div>
<dir class="row">
    <div class="col-sm-12">
        <h2>Recent Messages</h2>
        @foreach( $messages as $message )
            <div class="card" style="max-width:300px; float: left;">
                <img src="{{ asset('images/'.$message->image) }}" width="300" alt="image" class="card-img-top" />
                <!-- <img src="{{ url('storage/app/uploads/'.$message->image) }}" alt="image" /> -->
                <div class="card-body">
                    <h4 class="card-title">{{ $message->title }}</h4>
                    <p class="card-text">{{ $message->content }}</p>
                    <p class="card-text small">{{ $message->created_at->diffForHumans() }} - {{ $message->created_at->format('d-m-Y') }}</p>
                    <a href="/message/{{ $message->id }}" class="btn btn-primary">Read more</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection