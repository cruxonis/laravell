@foreach($comments as $comment)
 
<div class="display-comment" 
@if($comment->parent_id != null) style="margin-left:40px;"  @endif>
<strong>{{ $comment->user->name }}</strong> <p class="pull-right">{{$comment->created_at}}</p>
    <div>{!!$comment->body!!}</div>
    
    {{--Delete comment--}} 
        @if(!Auth::guest())   
             
            @if(Auth::user()->id ==$post->user_id || Auth::user()->id ==$comment->user_id)
                   
                {!!Form::open(['action' => ['CommentController@destroy', $comment ->id], 'method'=>'POST', 'class' =>'pull-right' ])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete Comment', ['class'=> 'btn btn-default'])}}

                {!!Form::close()!!}
            @endif
        @endif
        
        <a href="" id="reply"></a>
        @if(!Auth::guest())
        
        {!! Form::open(['action' => 'CommentController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            
            {{Form::textarea('body','', ['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Write a response' ])}}
        </div>
        
        <div class="form-group">
            {{Form::hidden('post_id', $post->id)}}
            {{Form::hidden('parent_id', $comment->id)}}
        </div>
        
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        
        {!! Form::close() !!}   
            
            
        @endif
        <hr>
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
{{--<a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a> 

@if(Auth::user()->id ==$post->user_id || Auth::user()->id ==$comment->user_id)
                   
            {!!Form::open(['action' => ['CommentController@destroy', $comment ->id], 'method'=>'POST' ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete Comment', ['class'=> 'btn btn-default'])}}

            {!!Form::close()!!}
        @endif

--}}
