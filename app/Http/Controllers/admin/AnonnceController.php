<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAnnonce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Annonce;
use App\ImageAnnonce;
use Intervention\Image\ImageManagerStatic as Image;

class AnonnceController extends Controller
{
    public function index() {

        $annonces = Annonce::with(['images' => function($q) {
            $q->where('isMain','=',1);
        }])->paginate(5);

        return response()->json($annonces);

    }

    public function saveAnnonce(StoreAnnonce $r) {

        if(!$r->validated()) {
            
            return response()->json(['message' => 'error', 'text', $r->errors()->add('error of one filed')]);

        }

        $Annonce = new Annonce();

        $Annonce->user_id = $r->user_id;

        $Annonce->ville_id = $r->ville_id;

        $Annonce->categorie_id = $r->categorie_id;

        $Annonce->title = $r->title;

        $Annonce->description = $r->description;

        $Annonce->detaille = $r->detaille;

        $Annonce->type = $r->type;

        $Annonce->stuts = $r->stuts;

        $Annonce->prix = $r->prix;

        foreach ($r->images as $key => $image) {
            //Upload image to the server
            $name = time() . $key . '.' . explode('/',explode(';',$image['img'])[0])[1];
            image::make($image['img'])->save(public_path('image/annonce/') . $name);
            $r->merge(['images[]' => $name]);
            // Save Image to database
            $AnnoncesImages = new ImageAnnonce();
            $AnnoncesImages->annonce_id = $Annonce->id;
            $AnnoncesImages->name = $name;
            $AnnoncesImages->isMain = $image["isMain"];
            $AnnoncesImages->save();
        }

        if($Annonce->save()) {
            
            return ['message' => 'success'];
            
        } else {

            return ['message' => 'error'];

        }

    }

    public function getAnnonce($id) {

        $annonce = Annonce::where('id',$id)->with(['images','ville','categorie'])->get();

        return response()->json($annonce);

    }

    public function update(StoreAnnonce $r) {

        if(!$r->validated()) {
            
            return response()->json(['message' => 'error', 'text', $r->errors()->add('error of one filed')]);

        }

        $Annonce = Annonce::find($r->id);

        foreach($r->images as $key => $image) {
            if(!isset($image['id'])) {
                    
                $name = time() . $key . '.' . explode('/',explode(';',$image['img'])[0])[1];
                image::make($image['img'])->save(public_path('image/annonce/') . $name);
                $Annonce->images()->save(new ImageAnnonce(['name' => $name, 'isMain' => $image->isMain]));
            } else {
                $cuurentImg = $Annonce->images()->find($image['id']);
                $cuurentImg->isMain = $image['isMain'];
                $cuurentImg->update();

            }
        }

        foreach ($r->delatedImages as $image) {
            
            $Annonce->images()->find($image['id'])->delete();

        }

        $Annonce->user_id = $r->user_id;

        $Annonce->ville_id = $r->ville_id;

        $Annonce->categorie_id = $r->categorie_id;

        $Annonce->title = $r->title;

        $Annonce->slug = $Annonce->generateSlug();

        $Annonce->description = $r->description;

        $Annonce->detaille = $r->detaille;

        $Annonce->type = $r->type;

        $Annonce->stuts = $r->stuts;

        $Annonce->prix = $r->prix;
        
        return $Annonce->update() ? ['message' => 'sucess', 'data' => Request()->all()] : ['message' => 'error'];

    }

}
