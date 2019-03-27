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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::namespace('Api')->group(function(){
    Route::resource('usuarios', 'UserController', ['except' => ['create', 'edit']]);//->middleware('can:eAdmin');
    //Route::get('usuarios/pesquisar', ['as' => 'usuarios.pesquisar', 'uses' => 'UserController@pesquisar']);
    //Route::resource('empresa', 'EmpresaController');//->middleware('can:eAdmin');
});
