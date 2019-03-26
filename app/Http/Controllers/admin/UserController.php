<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    public function index()
    {
        return response()->json(['stuts','data'=>User::all()]);
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'email'=>'required|email|string|max:191|unique:users',
            'password'=>'required|string|min:6',
        ]);
        
         $user=new User();
         $user->name=$request->name;
         $user->email=$request->email;
         $user->password=bcrypt($request->password);
         $user->save();
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
