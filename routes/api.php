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


Route::middleware(['auth_api'])->group(function () {


    Route::get('/me', 'Auth\\AuthController@me');

    Route::get('/funcionario/listpessoa', 'FuncionarioController@listPessoa');
    Route::get('/cotacao/listempresa', 'CotacaoController@listEmpresa');
    Route::get('/pessoajuridica/listsecretaria', 'PessoaJuridicaController@listSecretaria');
    Route::get('/licitacao/selectoptions', 'LicitacaoController@selectOptions');
    Route::delete('item/all', 'ItemController@deleteAll'); 

    //Route::apiResource('pessoa', PessoaController::class); 
    Route::apiResource('pessoafisica', PessoaFisicaController::class); 
    Route::apiResource('pessoajuridica', PessoaJuridicaController::class);  
    Route::apiResource('funcionario', FuncionarioController::class); 
    Route::apiResource('licitacao', LicitacaoController::class); 
    Route::apiResource('cotacao/empresa', CotacaoEmpresaController::class);  
    Route::apiResource('cotacao', CotacaoController::class);
    Route::apiResource('item', ItemController::class); 

    Route::post('/address/update', 'AddrressController@update');
    Route::post('/phone/update', 'PhoneController@update');
    Route::post('/representante/update', 'RepresentanteController@update');

    Route::post('/import', 'WrapperIExportController@import');
    Route::get('/export', 'WrapperIExportController@export');

});