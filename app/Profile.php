<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['user_id','avatar','bio','facebook'];

    public function getAvatarAttribute($avatar){
        return asset('uploads/avatar/'.$avatar);
    }
    Public function user(){
        return $this->belongsTo('App\user');
    }
}
