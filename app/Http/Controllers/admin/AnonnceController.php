<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Annonce;
use App\ImageAnnonce;
use Intervention\Image\ImageManagerStatic as Image;

class AnonnceController extends Controller
{
    public function index() {
        $Annonces = Annonce::latest()->paginate(10);
        $AnnoncesImages = array();
        foreach($Annonces as $Annonce) {
            $mainImage = ImageAnnonce::where('annonce_id', $Annonce->id)->where('isMain', 1)->first();
            $AnnoncesImages[] = array(
                'annonce'       => $Annonce,
                'imageAnnonce'  => $mainImage
            );
        }
        return response()->json($AnnoncesImages);

    }

    public function saveAnnonce(Request $r) {

       // return Request()->all();
        
        $Annonce = new Annonce();

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

        $Annonce->save();

        //  $Annonce->id;

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

        //return $r->images;  isMain

        return ['message' => 'success'];

    }
}
