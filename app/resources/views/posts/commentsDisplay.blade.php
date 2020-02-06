@foreach($comments as $comment)
 
<div class="display-comment" 
@if($comment->parent_id != null) style="margin-left:40px;"  @endif>
<strong>{{ $comment->user->name }}</strong> <p>{{$comment->created_at}}</p>
        <div>{!!$comment->body!!}</div>
        
        <a href="" id="reply"></a>
        @if(!Auth::guest())
        {!! Form::open(['action' => 'CommentController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            
            {{Form::textarea('body','', ['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Body text' ])}}
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