<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable =['title','content','featured','category_id','slug'];
    protected $dates=['deleted_at'];

    public function getFeatured(){
        return asset('uploads/posts/'.$this->featured);
    }

    public function category(){
       return $this->belongsTo('App\Category');
    }
    Public function tags(){

        return $this->belongsToMany('App\Tag');
    }
}
