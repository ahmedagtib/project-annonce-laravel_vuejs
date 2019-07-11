<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth','namespace'=>'api'], function ($router) {
    Route::post('register','AuthController@register');
    Route::post('editreg','AuthController@editreg');
    Route::post('profile','AuthController@profile');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('userstore/', 'AnnonceController@userstore');
     Route::post('getprofail', 'AnnonceController@getprofail');
     Route::get('getinfo/{id}','dashbordController@info');

});
Route::group(['namespace'=>'api'], function ($router) {
  Route::get('ville', 'AnnonceController@getville');
  Route::get('category', 'AnnonceController@getcategory');
  Route::post('postannonce', 'AnnonceController@deposerannonce');
  Route::get('getfree', 'AnnonceController@getadsfree');
  Route::get('getpay', 'AnnonceController@getadspay');
  //Route::post('all/', 'AnnonceController@getannoncejoin');
  Route::post('all/', 'AnnonceController@getAll');

  Route::get('annonce/single/{slug}', 'AnnonceController@getAnnonceBySlug');

  Route::get('Annoncebyslug/{slug}','AnnonceController@byslug');
  Route::get('annonce/{category_id}/{ignore}','AnnonceController@getSiller');
  Route::post('comment','AnnonceController@postcomment');
  Route::get('commentuser/{id}','AnnonceController@allcommentaboutpost');
  Route::post('search','AnnonceController@search');
   
});




