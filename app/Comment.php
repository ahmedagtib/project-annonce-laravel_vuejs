<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     public function annonce(){
       return $this->belongsTo('App\Annonce');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
