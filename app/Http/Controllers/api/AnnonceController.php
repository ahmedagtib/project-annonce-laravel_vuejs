<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ville,App\Categorie,App\Annonce,App\ImageAnnonce;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use DB;
class AnnonceController extends Controller
{
    public function getville(){
        
       return response()->json(Ville::all(),200);
    }
    public function getcategory(){
        
       return response()->json(Categorie::all(),200);
    }
    public function deposerannonce(Request $request){

         $vildate=Validator::make($request->all(),[
            'ville_id'=>'required|',
            'categorie_id'=>'required',
            'title'=>'required|string|min:6',
            'description'=>'required|string|min:15',
            'detialle'=>'required|string|min:6|max:20',
            'prix'=>'required|numeric', 
           // 'images' => 'mimes:jpeg,jpg,png|required|max:10000' 
        ]);

         if ($vildate->fails()){
            $val=$vildate->errors();
             return response()->json(['val'=>$val,'state'=>'error']);
         }
        $Annonce = new Annonce();
        $Annonce->user_id = $request->user_id;
        $Annonce->ville_id = $request->ville_id;
        $Annonce->categorie_id = $request->categorie_id;
        $Annonce->title = $request->title;
        $Annonce->slug = $Annonce->generateSlug();
        $Annonce->description = $request->description;
        $Annonce->detaille = $request->detialle;
        $Annonce->type ='free';
        $Annonce->stuts = 'pandding';
        $Annonce->prix = $request->prix;
        $Annonce->save();

        //  $Annonce->id;
        foreach ($request->images as $key => $image) {
            //Upload image to the server 
            $name = time() . $key . '.' . explode('/',explode(';',$image['img'])[0])[1];
            image::make($image['img'])->save(public_path('image/annonce/').$name);
            $request->merge(['images[]' => $name]);
            // Save Image to database
            $AnnoncesImages = new ImageAnnonce();
            $AnnoncesImages->annonce_id = $Annonce->id;
            $AnnoncesImages->name = $name; 
            $AnnoncesImages->isMain = $image["isMain"];
            $AnnoncesImages->save();
        } 

        return ['message' => 'success'];

    
        return Request()->all();
        
       
    }
    public function getadspay(){

       $Annonces = Annonce::where('type','=','pay')->where('stuts','=','published')->take(3)->get();
        $AnnoncesImages = array();
        foreach($Annonces as $Annonce) {
            $mainImage = ImageAnnonce::where('annonce_id', $Annonce->id)->where('isMain',1)->first();
            $AnnoncesImages[] = array(
                'annonce'       => $Annonce,
                'imageAnnonce'  => $mainImage
            );
        }
        return response()->json($AnnoncesImages);

    }

    public function getadsfree(){

       $Annonces = Annonce::where('type','=','free')->where('stuts','=','published')->take(3)->get();
        $AnnoncesImages = array();
        foreach($Annonces as $Annonce) {
            $mainImage = ImageAnnonce::where('annonce_id', $Annonce->id)->where('isMain',1)->first();
            $AnnoncesImages[] = array(
                'annonce'       => $Annonce,
                'imageAnnonce'  => $mainImage
            );
        }
        return response()->json($AnnoncesImages);

    }

    public function getannoncejoin(Request $request){
        
            $annonces = Annonce::select('annonces.*','categories.name as cat','villes.name as ville')
            ->join('villes', 'villes.id', '=', 'annonces.ville_id')
            ->join('categories', 'categories.id', '=', 'annonces.categorie_id')
            ->where('stuts','=','published')
            ->where('type','=','free')
            ->paginate(1);
            
            return $annonces;
    }

    public function getAll(Request $r) {
        $annonces = new Annonce();
        $annonces = $annonces->newQuery();
        if($r['categorie_id'] != -1)
            $annonces->where('categorie_id', '=', $r['categorie_id'])->where('stuts','=','published')->where('type','=','free');
        
        if($r['ville_id'] != -1)
            $annonces->where('ville_id', '=', $r['ville_id'])->where('stuts','=','published')->where('type','=','free');

        return $annonces->with(['images' => function () {
            
        }])->paginate(3);

    }
   
   
        

}
