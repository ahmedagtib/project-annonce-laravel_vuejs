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
        foreach ($r->images as $key => $image) { 
            $name = time() . $key . '.' . explode('/',explode(';',$image)[0])[1];
            image::make($image)->save(public_path('image/annonce/') . $name);
        }
        //return ;

    }
}
