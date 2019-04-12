<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageAnnonce extends Model
{
     protected $fillable = [
        'name','annonce_id','isMain'
    ];

    protected $touches = ['Annonce'];

    public function annonce(){
        return $this->belongsTo('App\Annonce','annonce_id');
    }
}
