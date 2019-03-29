<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'title','description','prix','categorie_id','ville_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function admin(){
        return $this->belongsTo('App\Admin');
    }
    public function categorie(){
        return $this->belongsTo('App\Categorie');
    }

    public function ville(){
        return $this->belongsTo('App\Ville');
    }

    public function images(){
        return $this->hasMany('App\ImageAnnonce');
    }

    public function generateSlug() {
        $slug = str_replace(' ', '-', $this->title);
        $nuberOfSlugs = Annonce::where('slug', 'like', $slug . '%')->count();
        if($nuberOfSlugs > 0) {
            return $slug . '-' . $nuberOfSlugs;
        }
        return $slug;
    }
}
