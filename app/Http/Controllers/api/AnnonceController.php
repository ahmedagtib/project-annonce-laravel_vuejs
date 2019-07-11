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

       $Annonces = Annonce::where('type','=','free')->where('stuts','=','published')->take(12)->get();
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
            $annonces->where('categorie_id', '=', $r['categorie_id']);
        
        if($r['ville_id'] != -1)
            $annonces->where('ville_id', '=', $r['ville_id']);

        if($r['min_prix'] != 0)
            $annonces->where('prix', '>', $r['min_prix']);
        
        if($r['max_prix'] != 0)
            $annonces->where('prix', '<', $r['max_prix']);

        return response()->json($annonces->with(['images' => function ($q) {
             $q->where('isMain', 1);
        }])->where('stuts','=','published')->where('type','=','free')->paginate(12));

    }

    public function byslug (Request $r, $slug) {

        $Annonce = Annonce::where('slug', '=', $slug)->with(['images', 'categorie', 'ville', 'user'])->get();

        return response()->json(['stuts' => 'ok', 'data' => $Annonce]);

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


    public function getSiller(Request $request, $category_id, $ignore) {

        $similler = Annonce::where('categorie_id', $category_id)->inRandomOrder()->whereNotIn('id', [$ignore])->with(['images' => function ($q) {

            $q->where('isMain', 1);

        }])->take(5)->get();

        return response()->json($similler);

    }

    /** 
     * 
     * SEARCH Function
     * 
     *  */

    public function search (Request $request) {

        // $annoncesModel = new Annonce();
        // $annonces = $annoncesModel->newQuery();


        /**
         * 
         *  Problem solved: 
         *  1. images not able to show in with the select function (use leftJoin insted of with)
         *  2. query not show the same result with or without filter (use advanced where)
         *  3. you can't show images the main image only (use the advanced leftJoin)
         *                  
         * 
         */

        $annonces = Annonce::where('stuts', '=', 'published')->where('type','=','free')
                    ->leftJoin('image_annonces', function ($join) {
                        $join->on('annonces.id', '=', 'image_annonces.annonce_id')
                        ->where('image_annonces.isMain', '=', 1);
                    })
                    ->select(['slug', 'title', 'description', 'detaille', 'prix', 'image_annonces.name as image_annonce']);
        
        if (!empty($request['query'])) {
            // $annonces->orWhere('title', 'like', "%".$request['query']."%")
            // $annonces->where('description', 'like', "%".$request['query']."%");
            // ->orWhere('detaille', 'like', "%".$request['query']."%");

            $annonces->where(function ($query) use ($request) {

                $query->orWhere('title', 'like', "%".$request['query']."%")
                    ->orWhere('description', 'like', "%".$request['query']."%")
                    ->orWhere('detaille', 'like', "%".$request['query']."%");

            });

            // ['slug', 'title', 'description', 'detaille', 'prix']
        }

        if($request['categorie_id'] != -1) {
            $annonces->where('categorie_id', '=', $request['categorie_id']);
        }
        if($request['ville_id'] != -1) {
            $annonces->where('ville_id', '=', $request['ville_id']);
        }
        if($request['min_prix'] > 0) {
            $annonces->where('prix', '>=', $request['min_prix']);
        }
        
        if($request['max_prix'] > 0) {
            $annonces->where('prix', '<=', $request['max_prix']);
        }
        // return response()->json($annonces->where('stuts', '=', 'published')->where('type','=','free')
        //                 ->leftJoin('image_annonces', 'annonces.id', '=', 'image_annonces.annonce_id')
        //                 ->where('image_annonces.isMain', '=', 1)
        //                 ->select(['slug', 'title', 'description', 'detaille', 'prix', 'image_annonces.name as image_annonce'])->paginate(12));
        
        // return response()->json($annonces->get());

        return response()->json($annonces->paginate(10));

    }

    // Select * from Annonce where title like '%$query%' or desciption like '%$query%' or detaille like '%$query%'

}
