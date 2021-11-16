@extends('master')

@section('title', 'Blog Site')

@section('content')

<h2>Post Message</h2>

<form action="/create" method="post" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="title"><br>
    <input type="text" name="content" placeholder="content"><br>
    <input type="file" name="image" id="image" />
    {{ csrf_field() }}
    <button type="submit">submit</button>

</form>



<h2>Recent Messages</h2>

<ul>
    @foreach( $messages as $message )
    <li>
        {{ $message->title }} <br>
        {{ $message->content }} <br>
        {{ $message->created_at->diffForHumans() }} - 
        {{ $message->created_at->format('d-m-Y') }} <br>
        <a href="/message/{{ $message->id }}">view</a>
    </li>
    @endforeach
</ul>

@endsection