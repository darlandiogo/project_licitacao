<?php

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

Route::get('/funcionario/listpessoa', 'FuncionarioController@listPessoa')->middleware('auth_api');
Route::get('/pessoajuridica/listsecretaria', 'PessoaJuridicaController@listSecretaria')->middleware('auth_api');
Route::get('/licitacao/selectoptions', 'LicitacaoController@selectOptions')->middleware('auth_api');
Route::delete('item/all', 'ItemController@deleteAll')->middleware('auth_api'); 

//Route::apiResource('pessoa', PessoaController::class); 
Route::apiResource('pessoafisica', PessoaFisicaController::class)->middleware('auth_api'); 
Route::apiResource('pessoajuridica', PessoaJuridicaController::class)->middleware('auth_api');  
Route::apiResource('funcionario', FuncionarioController::class)->middleware('auth_api'); 
Route::apiResource('licitacao', LicitacaoController::class)->middleware('auth_api'); 
Route::apiResource('cotacao', CotacaoController::class)->middleware('auth_api'); 
Route::apiResource('item', ItemController::class)->middleware('auth_api'); 

Route::post('/address/update', 'AddrressController@update')->middleware('auth_api');
Route::post('/phone/update', 'PhoneController@update')->middleware('auth_api');
Route::post('/representante/update', 'RepresentanteController@update')->middleware('auth_api');

Route::post('/import', 'WrapperIExportController@import')->middleware('auth_api');
Route::get('/export', 'WrapperIExportController@export')->middleware('auth_api');