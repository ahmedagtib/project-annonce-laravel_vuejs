<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
class UserController extends Controller
{
    public function index()
    {
        return response()->json(['stuts','data'=>User::latest()->paginate(5)]);
    }

    public function store(Request $request){
        
       
         $vildate=Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'email'=>'required|email|string|max:191|unique:users',
            'password'=>'required|string|min:6',     
        ]);

         if ($vildate->fails()){
             return response()->json($vildate->errors());
         }
        
         $user=new User();
         $user->name=$request->name;
         $user->email=$request->email;
         $user->password=bcrypt($request->password);
         $user->save();
    }
    public function update(Request $request, $id)
    {
       
         $user=User::find($id);

        
         if(empty($user)){
            return response()->json(['status'=>'error','message'=>'this suer is not found'],404);
         }
           $vildate=Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'email'=>'required|email|string|max:191|unique:users',
            'password'=>'required|string|min:6',     
          ]);

         if ($vildate->fails()){
             return response()->json($vildate->errors());
         }


         $user->name=$request->name;
         $user->email=$request->email;
         $user->password=bcrypt($request->password);

         
         if($user->update()){
           return response()->json(['stuts'=>'success','data'=>$user]);
         }
       
         
    }
     public function destroy($id)
    {
        $User=User::find($id);
        if(empty($User)){
            return response()->json(['status'=>'error','message'=>'this User is not found'],404);
        }
        elseif($User->delete()){
           return response()->json(['status'=>'error','data'=>$User],200);
        }else{
            return response()->json(['status'=>'error'],500);
        }
    }

}
