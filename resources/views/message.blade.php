@extends('master')

@section('title', 'Blog Site')

@section('content')

<h2>{{ $message->title }}</h2>

<p>{{ $message->content }}</p>
<p><strong>Posted: </strong>{{ $message->created_at->diffForHumans() }}</p>
<p>
    <img src="{{ asset('images/'.$message->image) }}" width="300" alt="image" />
    <!-- <img src="{{ url('storage/app/uploads/'.$message->image) }}" alt="image" /> -->
</p>

@foreach($messagemeta as $meta)
<p>{{ $meta->meta_key }} - {{ $meta->meta_value }}</p>

@endforeach


<p>
<a href="/delete/{{$message->id}}">delete</a>    
<a href="/">Back</a>
</p>

<p>Update this post</p>
<form action="/update" method="post" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="title" value="{{ $message->title }}"><br>
    <input type="text" name="content" placeholder="content" value="{{ $message->content }}"><br>
    <input type="text" name="meta_key" placeholder="meta_key" value=""><br>
    <input type="text" name="meta_value" placeholder="meta_value" value=""><br>
    <input type="hidden" name="id" value="{{ $message->id }}" >
    {{ csrf_field() }}
    <button type="submit">submit</button>

</form>

@endsection