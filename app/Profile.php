<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name','description', 'adresse', 'telephone',
        'image', 'online', 'confirmed',

    ];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
