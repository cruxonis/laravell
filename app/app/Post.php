<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    //Table name
    protected $table = 'posts';
    //primary key
    public $primaryKey='id';
    //timestamp
    public $timestamps=true;

    public function user(){
       return $this->belongsTo('App\User');

       
    }

    public function comments()
    {
        
        return $this->hasMany(Comment::class)->whereNull('parent_id')->orderBy('created_at','DESC');
    }
}

//->whereNull('parent_id')$comments= Comment ::orderBy('created_at', 'desc')->paginate(10);