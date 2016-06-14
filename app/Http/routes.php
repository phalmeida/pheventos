<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Administração dos eventos
 */
Route::group(['prefix' => 'administracao', 'middleware' => [] , 'web'], function($route){
    
    //Estilos Musicais
    $route->get('/estilos','Painel\EstiloController@index');
    $route->get('/estilo/cadastrar','Painel\EstiloController@cadastrar');
    $route->post('/estilo/cadastrar','Painel\EstiloController@cadastrarEstilo');
    $route->get('/estilo/editar/{id}','Painel\EstiloController@editar');
    
    //Rota inicial da Dashboard
    $route->get('/','Painel\PainelController@index');
    
});

Route::get('/', function () {
    return view('welcome');
});




Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/template', 'HomeController@template');
