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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function(){
	Route::prefix('deputados')->group(function(){
        Route::get('/', 'DeputadoController@findAll')->name('index_deputados');	
        Route::get('/{id}', 'DeputadoController@findById')->name('index_deputados'); 
        Route::post('/', 'DeputadoController@create')->name('create_deputados');   
        
        Route::get('/assembleia', 'DeputadoController@getAssembleiaApi');   
	});
});

Route::namespace('Api')->name('api.')->group(function(){
	Route::prefix('assembleia')->group(function(){  
        Route::get('/', 'DeputadoController@cadastroDeputadosAssembleia');   
	});
});
