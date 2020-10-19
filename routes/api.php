<?php

use App\Http\Controllers\AddrressController;
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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/register', 'Auth\\AuthController@register');
Route::post('/login', 'Auth\\AuthController@login');
Route::post('/logout', 'Auth\\AuthController@logout');
Route::post('/refresh', 'Auth\\AuthController@refresh');

Route::get('/me', 'Auth\\AuthController@me')->middleware('auth_api');

Route::get('funcionario/listpessoa', 'FuncionarioController@listPessoa')->middleware('auth_api');
//Route::apiResource('pessoa', PessoaController::class); 

Route::apiResource('pessoafisica', PessoaFisicaController::class)->middleware('auth_api'); 
Route::apiResource('pessoajuridica', PessoaJuridicaController::class)->middleware('auth_api');  
Route::apiResource('funcionario', FuncionarioController::class)->middleware('auth_api'); 
 

Route::post('/address/update', 'AddrressController@update')->middleware('auth_api');
Route::post('/phone/update', 'PhoneController@update')->middleware('auth_api');

Route::get('/teste', function(){

    //return App\Models\Role::find(1)->permissions;
    return App\User::find(1)->roles;
});
