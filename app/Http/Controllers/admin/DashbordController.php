<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ville,App\Categorie,App\Annonce,App\ImageAnnonce,App\Comment,App\Profile,App\User;
class DashbordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('admin.dashbord');
    }
    public function getnumberannonce(){
       
             $annoncepublished=Annonce::Where('stuts','=','published')->count();
             $annoncepandding=Annonce::Where('stuts','=','pandding')->count();
             $annonceblocked=Annonce::Where('stuts','=','blocked')->count();
             $comment=Comment::count();
             return response()->json(['annoncepublished'=>$annoncepublished,
                                      'annoncepandding'=>$annoncepandding,
                                       'annonceblocked'=>$annonceblocked,
                                       'comment'=>$comment
                                     ]);  
          
    }
     public function getnumberads(){
       
             $annoncepublished=Annonce::Where('stuts','=','published')->count();
             $annoncepandding=Annonce::Where('stuts','=','pandding')->count();
             $annonceblocked=Annonce::Where('stuts','=','blocked')->count();
             return response()->json(['annoncepublished'=>$annoncepublished,
                                      'annoncepandding'=>$annoncepandding,
                                       'annonceblocked'=>$annonceblocked,
                                       
                                     ]);  
          
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
