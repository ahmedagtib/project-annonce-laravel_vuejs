<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Ville;
class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['stuts','data'=>Ville::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $input=$request->all();
        
        $vildate=Validator::make($input,[
               'name'=>'required',     
        ]);
         if ($vildate->fails()){
        return response()->json($vildate->errors());
        }
        $ville=Ville::create($input);
      
         return response()->json(['stuts','data'=>$ville]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $ville=ville::find($id);
         if(empty($ville)){
            return response()->json(['status'=>'error','message'=>'this ville is not found'],404);
         }
         $input=$request->all();
        
        $vildate=Validator::make($input,[
               'name'=>'required',     
        ]);
         if ($vildate->fails()){
        return response()->json($vildate->errors());
        }
         $ville->name=$request->name; 
         
         if($ville->update()){
           return response()->json(['stuts','data'=>$ville]);
         }
      
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ville=Ville::find($id);
        if(empty($ville)){
            return response()->json(['status'=>'error','message'=>'this ville is not found'],404);
        }
        elseif($ville->delete()){
           return response()->json(['status'=>'error','data'=>$ville],200);
        }else{
            return response()->json(['status'=>'error'],500);
        }
    }
}
