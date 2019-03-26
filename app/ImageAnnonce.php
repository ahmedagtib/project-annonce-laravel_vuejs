<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageAnnonce extends Model
{
     protected $fillable = [
        'name','annonce_id','isMain'
    ];

    public function annonce(){
        $this->belongsTo('App\Annonce');
    }
}
