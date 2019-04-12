<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\Profile;
use Intervention\Image\ImageManagerStatic as Image;
class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','profile','editreg']]);
    }

     public function register(Request $request)
     {
        
     $vildate=Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'email'=>'required|email|string|max:191|unique:users',
            'password'=>'required|string|min:6',     
        ]);

         if ($vildate->fails()){
            $val=$vildate->errors();
             return response()->json(['val'=>$val,'state'=>'error']);
         }
         $name=filter_var($request->name,FILTER_SANITIZE_STRING);
         $user=new User();
         $user->name=$name;
         $user->email=$request->email;
         $user->password=bcrypt($request->password);
         $user->save();
          $profile=Profile::create([
            'user_id'=> $user->id,
         ]);
          return response()->json(['user' => $user,'profil'=>$profile]);
          
     }
    
     public function editreg(Request $request){
        $id=$request->id;
         $user=User::where('id','=',$id)->first();
         if(empty($user)){
                 return response()->json(['error'=>'user not found']); 
            }
           $vildate=Validator::make($request->all(),[ 
            'name'=>'required|string|max:191',
            //'email'=>'required|email|string|max:191|unique:users',
            'password'=>'required|string|min:6', 
            ]);
           if($vildate->fails()){
               $val=$vildate->errors();
               return response()->json(['val'=>$val,'state'=>'error']);
             }
              $name=filter_var($request->name,FILTER_SANITIZE_STRING);
              $user->name=$name;
              //$user->email=$request->email;
              $user->password=bcrypt($request->password);
              $user->update([$user]);
              return response()->json(['user' => $user]);
         //return $user;
     }

     public function profile(Request $request){

            $id=$request->user_id;
            $profil=Profile::where('user_id','=',$id)->first();
            if(empty($profil)){
                 return response()->json(['error'=>'profial not found']); 
            }
           $vildate=Validator::make($request->all(),[
              'firstname'=>'required|string|max:20',
              'lastname'=>'required|string|max:20',
              'description'=>'required|string',  
              'adresse'=>'required|string',  
              'phone'=>'required|string',    
           ]);
            if($vildate->fails()){
               $val=$vildate->errors();
               return response()->json(['val'=>$val,'state'=>'error']);
            }
              $firstname=filter_var($request->firstname,FILTER_SANITIZE_STRING);
              $lastname=filter_var($request->lastname,FILTER_SANITIZE_STRING);
              $description=filter_var($request->description,FILTER_SANITIZE_STRING);
              $adresse=filter_var($request->adresse,FILTER_SANITIZE_STRING);

               $profil->first_name=$firstname;
               $profil->last_name=$lastname;
               $profil->description=$description; 
               $profil->adresse=$adresse;
               $profil->telephone=$request->phone;
               if(!empty($request->pic)){
                 $image = time() .'.'. explode('/',explode(';',$request->pic)[0])[1];
                 image::make($request->pic)->save(public_path('image/users/') . $image);
                  $profil->image=$image;
                } 
               $profil->update([$profil]);
             return response()->json(['profil' => $profil]);
          //return  $profil;
        //return Request()->all();
           
      }


    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
        
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard('api')->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
             'user'        =>$this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => $this->guard('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::Guard('api');
    }
}
