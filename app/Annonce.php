<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Annonce extends Model
{
    use HasSlug;

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

    public function images() {
        return $this->hasMany('App\ImageAnnonce');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

}
