<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable=['name'];

    public function annonces(){
        $this->hasMany('App\Annonce');
    }
}
