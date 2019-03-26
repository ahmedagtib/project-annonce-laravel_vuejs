<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Categorie;
class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(['stuts','data'=>Categorie::all()]);
    }

    public function store(Request $request)
    {
         $input=$request->all();
        
        $vildate=Validator::make($input,[
               'name'=>'required',     
        ]);
         if ($vildate->fails()){
        return response()->json($vildate->errors());
        }
         $category=Categorie::create($input);
         return response()->json(['stuts','data'=>$category]);
        
    }
    public function update(Request $request, $id)
    {
         $category=Categorie::find($id);
         if(empty($category)){
            return response()->json(['status'=>'error','message'=>'this category is not found'],404);
         }
         $input=$request->all();
        
        $vildate=Validator::make($input,[
               'name'=>'required',     
        ]);
         if ($vildate->fails()){
        return response()->json($vildate->errors());
        }
         $category->name=$request->name; 
         
         if($category->update()){
           return response()->json(['stuts','data'=>$category]);
         }    
    }
    public function destroy($id)
    {
        $Categorie=Categorie::find($id);
        if(empty($Categorie)){
           return response()->json(['status'=>'error','message'=>'this Categorie is not found'],404);
        }
        elseif($Categorie->delete()){
           return response()->json(['status'=>'error','data'=>$Categorie],200);
        }else{
            return response()->json(['status'=>'error'],500);
        }
    }
}
