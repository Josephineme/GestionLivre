<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'Etagere'], function(){
    Route::post('/', 'etagereController@create'); 
    Route::match(['post','put'],'/{id}', 'EtagereController.@update');  
    Route::delete('/{id}', 'EtagereController@destroy');  
    Route::get('/', 'EtagereController@index');  
    Route::get('/{id}','EtagereController@find');
});

Route::group(['prefix'=>'Livre'], function(){
    Route::post('/', 'LivreController@create'); 
    Route::match(['post','put'],'/{id}', 'LivreController@update');  
    Route::delete('/{id}', 'LivreController@destroy');  
    Route::get('/', 'LivreController@index');  
    Route::get('/{id}','LivreController@find');
});

