<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    /*
    public function index()
    {
        //$posts= Post ::orderBy('title', 'desc')->take(1)->get();
        $comments= Comment ::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.show')->with('comments',$comments);
    }
    */
    
    public function store(Request $request)
    {
        //create comments
        $comment=new Comment;
        $comment->body = $request->input('body');
        $comment->user_id= auth()->user()->id;
        $comment->post_id= $request->input('post_id');
        $comment->parent_id= $request->input('parent_id');
       
        
        $comment->save();

        return back()->with('success','Comment Created'); 

    }
//delete comments
    public function destroy($id)
    {
        $comment= Comment::find($id);
        if(auth()->user()->id !==$comment->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        /*if($post->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);

        }*/

        $comment->delete();
        return back()->with('success','Comment Deleted'); 
    }
    
    	
    }

