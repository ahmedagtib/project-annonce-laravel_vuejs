<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ville,App\Categorie,App\Annonce,App\ImageAnnonce,App\Comment,App\Profile,App\User;
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

         $vildate = Validator::make($request->all(),[
            'ville_id'=>'required|',
            'categorie_id'=>'required',
            'title'=>'required|string|min:6',
            'description'=>'required|string|min:15',
            'detialle'=>'required|string|min:6|max:100',
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

       $Annonces = Annonce::where('type','=','pay')->where('stuts','=','published')->take(4)->get();
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

        if($r['min_prix'] != 0)
            $annonces->where('prix', '>', $r['min_prix'])->where('stuts','=','published')->where('type','=','free');
        
        if($r['max_prix'] != 0)
            $annonces->where('prix', '<', $r['max_prix'])->where('stuts','=','published')->where('type','=','free');

        return response()->json($annonces->with(['images' => function ($q) {
             $q->where('isMain', 1);
        }])->paginate(10));

    }

    public function byslug($slug){
         $annonce=Annonce::where('slug','=',$slug)->first();
         if($annonce){
            return response()->json(['data'=>$annonce,'stuts'=>'ok']);
         }else{
            return response()->json(['data'=>"erorr"]);
         }
    }
    //post comment
    public function postcomment(Request $request){
     
        if($request->slug){
            $id=Annonce::where('slug','=',$request->slug)->first();
            //validate
            $vildate = Validator::make($request->all(),[
              'body'=>'required|string'
            ]);
            if ($vildate->fails()){
              $val=$vildate->errors();
                 return response()->json(['val'=>$val,'state'=>'error']);
             }
             //filter request
              $body=filter_var($request->body,FILTER_SANITIZE_STRING);
            //send data
                  $comment=new Comment();
                  $comment->body=$body;
                  $comment->user_id=$request->user_id;
                  $comment->annonce_id=$id->id;
             if($comment->save()){
                   return response()->json(['val'=>$comment,'state'=>'ok']);
             }else{
                return response()->json(['state'=>'error']);
             }

         }
         else{
            return response()->json(["data"=>"slug not found"]);
         } 
       
    }
    public function allcommentaboutpost($slug){

        if($slug){
             $id=Annonce::where('slug','=',$slug)->first(); 
             $comments = Comment::where('annonce_id',$id->id)->with('user')->orderBy('id','desc')->take(3)->get();
              $info=array();
               foreach($comments as $com){
                   $profile=$com->user->profile;
                   $info[]=array(
                          'userprofiale'=>$profile,
                          'comments'=>$com
                    );
                  }
                    return response()->json(['data'=>$info,'state'=>'yes']);
            
               }
          else{
                       return response()->json(['data'=>'error','state'=>'no']);
               }
         /*
       if(!empty($id)){
            $comments = Comment::where('annonce_id',$id)->with('user')->take(3)->get();
             $info=array();
               foreach($comments as $com){
                $profile=$com->user->profile;
                $info[]=array(
                  'userprofiale'=>$profile,
                   'comments'=>$com
                );
             }
             return response()->json(['data'=>$info,'state'=>'yes']);
       }else{
       
              return response()->json(['data'=>'error','state'=>'no']);
            }
       */
      
     
     
    }
    public function userstore(Request $request){
         if($request->id){
            $mystore=Annonce::Where('user_id','=',$request['id'])->where('stuts','=','published');
             return response()->json($mystore->with(['images' => function ($q) {
             $q->where('isMain', 1);
        }])->paginate(8));
         }else{
            return response()->json(['data'=>"id not found"]);
         }
    }
    public function getprofail(Request $request){
        if($request->id){
        $myprofail=Profile::Where('user_id','=',$request['id'])->first();
           return response()->json(['data'=>$myprofail]);
        }else{
           return response()->json(['data'=>"profail not found"]);
        }
    }

}
