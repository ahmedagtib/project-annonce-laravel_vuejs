<?php
Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){

Config::set('auth.defines','admin.admin');
Route::get('/login','AdminAuthController@login');
Route::post('/login','AdminAuthController@dologin');
Route::group(['middleware'=>'admin:admin'],function(){
  
        Route::get('/','DashbordController@index');
        Route::any('/logout','AdminAuthController@logout');
        //ville
         Route::get('ville/all','VilleController@index');
         Route::post('ville/all','VilleController@store');
         Route::delete('ville/delete/{id}','VilleController@destroy');
         Route::put('ville/update/{id}','VilleController@update');
         //Categorie
          Route::get('Categorie/all','CategoryController@index');
         Route::post('Categorie/all','CategoryController@store');
         Route::delete('Categorie/delete/{id}','CategoryController@destroy');
         Route::put('Categorie/update/{id}','CategoryController@update');
        //user
         Route::get('user/all','UserController@index');
         Route::post('user/all','UserController@store');
         Route::delete('user/delete/{id}','UserController@destroy');
         Route::put('user/update/{id}','UserController@update');
         //annonce
         
        Route::get('/{any}','DashbordController@index')->where('any','.*');
});
}); 



