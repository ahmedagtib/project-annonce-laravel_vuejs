<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Admin;
use Validator;
class AdminController extends Controller
{
    public function index()
    {
        return response()->json(['stuts'=>'success','data'=>Admin::latest()->paginate(5)]);
    }

    public function store(Request $request){
        
         $vildate=Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'email'=>'required|email|string|max:191|unique:admins',
            'password'=>'required|string|min:6',     
        ]);

         if ($vildate->fails()){
             return response()->json($vildate->errors());
         }

         $admin=new Admin();
         $admin->name=$request->name;
         $admin->email=$request->email;
         $admin->password=bcrypt($request->password);
         $admin->save();
          return response()->json(['stuts'=>'success','data'=>$admin]);
        
    }
     public function update(Request $request, $id)
    {
       
         $admin=Admin::find($id);
         if(empty($admin)){
            return response()->json(['status'=>'error','message'=>'this admin is not found'],404);
         }
           $vildate=Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'email'=>'required|email|string|max:191|unique:admins',
            'password'=>'required|string|min:6',     
          ]);

         if ($vildate->fails()){
             return response()->json($vildate->errors());
         }

         if ($vildate->fails()){
           return response()->json($vildate->errors());
        }

         $admin->name=$request->name;
         $admin->email=$request->email;
         $admin->password=bcrypt($request->password);
         $admin->save();
        
         
         if($ville->update()){
           return response()->json(['stuts'=>'success','data'=>$admin]);
         }
        
         
      
         
    }
     public function destroy($id)
    {
        $admin=Admin::find($id);
        if(empty($admin)){
            return response()->json(['status'=>'error','message'=>'this admin is not found'],404);
        }
        elseif($admin->delete()){
           return response()->json(['status'=>'error','data'=>$admin],200);
        }else{
            return response()->json(['status'=>'error'],500);
        }
    }
}
