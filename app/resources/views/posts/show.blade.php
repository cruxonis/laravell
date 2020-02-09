@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    <br><br>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id ==$post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post ->id], 'method'=>'POST', 'class' =>'pull-right' ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class'=> 'btn btn-danger'])}}

            {!!Form::close()!!}
        @endif
    @endif

    <h3>Write a Comment</h3>
    @if(!Auth::guest())
    
    {!! Form::open(['action' => 'CommentController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    
    <div class="form-group">
        {{Form::label('title', 'Body')}}
        {{Form::textarea('body','', ['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body text'])}}
    </div>
    
    <div class="form-group">
        {{Form::file('cover_image')}}
        {{Form::hidden('post_id', $post->id)}}
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    
    {!! Form::close() !!}
    @else 
    <a href="{{ route('login') }}">Log in</a> to post a comment <p>Don't have an accoutn? <a href="{{ route('register') }}">Register</a> here!</p>

    @endif

    <h3>View Comments</h3>
    @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id] ) 
    
    
    
@endsection

@section('content')
    
@endsection