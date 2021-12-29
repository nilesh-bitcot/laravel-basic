@extends('master')

@section('title', 'Blog Site')
@section('subtitle', $message->title)

@section('content')

<div class="row message-single">
    <div class="col-sm-12">

        <h2>{{ $message->title }} 
            <span class="links">| 
                <a onclick="return confirm('Are you sure, you want to delete this?')" href="/delete/{{$message->id}}">delete</a> | 
                <a href="/delete/{{$message->id}}" data-bs-toggle="modal" data-bs-target="#myModal">Edit</a> |
            </span>
        </h2>
        <div class="img-wrap">
            @if($message->image)
            <img src="{{ asset('images/'.$message->image) }}" width="300" alt="image" class="card-img-top" />
            <a href="/delete-image/{{$message->id}}" onclick="return confirm('Are you sure to delete feature image?')">Delete image</a>
            <!-- <img src="{{ url('storage/'.$message->image) }}" alt="image" /> -->
            <!-- <img src="{{ asset('storage/'.$message->image) }}" alt="image" /> -->
            @else
            <form name="add_image_form" action="/add-image" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image">Add feature Image</label>
                    <input type="file" class="form-control" name="image" id="image" required/>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $message->id }}" />
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
            @endif
        </div>

        <div class="card">
            <div class="card-body">
                <p class="small card-text"><strong>Posted: </strong>{{ $message->created_at->diffForHumans() }}</p>
                <p class="card-text">{{ $message->content }}</p>

                @if( count($message->messagemeta) > 0 )
                    <h3>Meta Data</h3>
                    @foreach($message->messagemeta as $meta)
                    <p>{{ $meta->meta_key }} - {{ $meta->meta_value }}</p>
                    @endforeach
                @endif          
            </div>
        </div>

        <p>
            
        <a href="/">Back</a>
        </p>
    </div>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update this post</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="/update" method="post" enctype="multipart/form-data">
                    <input type="text" class="form-control" name="title" placeholder="title" value="{{ $message->title }}"><br>
                    <input type="text" class="form-control" name="content" placeholder="content" value="{{ $message->content }}"><br>
                    @if( count($message->messagemeta) > 0 )
                        @foreach($message->messagemeta as $meta)
                        <input type="text" class="form-control" name="meta_key" placeholder="meta_key" value="{{ $meta->meta_key }}"><br>
                        <input type="text" class="form-control" name="meta_value" placeholder="meta_value" value="{{ $meta->meta_value }}"><br>
                        @endforeach
                    @else
                    <input type="text" class="form-control" name="meta_key" placeholder="meta_key" value=""><br>
                    <input type="text" class="form-control" name="meta_value" placeholder="meta_value" value=""><br>
                    @endif                    
                    <input type="hidden" name="id" value="{{ $message->id }}" >
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">submit</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection