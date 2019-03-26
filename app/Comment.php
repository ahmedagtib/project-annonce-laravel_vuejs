<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     public function annonce(){
        $this->belongsTo('App\Annonce');
    }

    public function user(){
        $this->belongsTo('App\User');
    }
}
