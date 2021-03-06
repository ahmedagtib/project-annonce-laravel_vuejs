<?php




Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){

Config::set('auth.defines','admin.admin');
Route::get('/login','AdminAuthController@login');
Route::post('/login','AdminAuthController@dologin');
Route::group(['middleware'=>'admin:admin'],function(){
        //dashbord
        Route::get('/getnumberannonce','DashbordController@getnumberannonce');
        Route::get('/getnumberads','DashbordController@getnumberads');
        Route::get('/','DashbordController@index');
        Route::get('/logout','AdminAuthController@logout');
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
         Route::get('Annonce/all', 'AnonnceController@index');
         Route::post('Annonce/add', 'AnonnceController@saveAnnonce');
         Route::get('Annonce/single/{id}', 'AnonnceController@getAnnonce');
         Route::post('Annonce/update', 'AnonnceController@update');
         Route::post('Annonce/Test', 'AnonnceController@Test');

         //admin
         Route::get('admin/all','AdminController@index');
         Route::post('admin/all','AdminController@store');
         Route::delete('admin/delete/{id}','AdminController@destroy');
         Route::put('admin/update/{id}','AdminController@update');
         //start annonce
         
         //end annonce
        Route::get('/{any}','DashbordController@index')->where('any','.*');


});
}); 
      Route::get('/{any}','welcomepage@index')->where('any','.*');

