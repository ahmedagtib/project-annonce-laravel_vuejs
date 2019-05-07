<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ville,App\Categorie,App\Annonce,App\ImageAnnonce,App\Comment,App\Profile,App\User;
class dashbordController extends Controller
{
     public function info($id){
        if($id){
             $annoncepublished=Annonce::Where('user_id','=',$id)->Where('stuts','=','published')->count();
             $annoncepandding=Annonce::Where('user_id','=',$id)->Where('stuts','=','pandding')->count();
             $annonceblocked=Annonce::Where('user_id','=',$id)->Where('stuts','=','blocked')->count();
             $comment=Comment::where('user_id','=',$id)->count();
             return response()->json(['annoncepublished'=>$annoncepublished,
                                      'annoncepandding'=>$annoncepandding,
                                       'annonceblocked'=>$annonceblocked,
                                       'comment'=>$comment
                                     ]);
         }else{
            return response()->json(['data'=>"id not found"]);
         }
          
    }
    
}
