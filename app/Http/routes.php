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


    /**
     * Eventos
     */
    $route->get('eventos','Administracao\EventoController@index');
    $route->get('evento/cadastrar','Administracao\EventoController@formCadastro');
    
    
    /**
     * Palestrantes
     */
    $route->get('palestrantes','Administracao\PalestranteController@index');
    $route->get('palestrante/cadastrar','Administracao\PalestranteController@formCadastro');
    $route->post('palestrante/cadastrar','Administracao\PalestranteController@salvarCadastro');
    $route->get('palestrante/editar/{id}','Administracao\PalestranteController@formEditar');
    $route->post('palestrante/editar/{id}','Administracao\PalestranteController@salvarEdicao');
    $route->get('palestrante/deletar/{id}','Administracao\PalestranteController@delete');
    $route->post('palestrante/pesquisar','Administracao\PalestranteController@pesquisar');
    
    
    
    //Rota inicial da Dashboard
    $route->get('/','Painel\PainelController@index');
    
});




Route::get('/', function () {
    return view('welcome');
});




Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/template', 'HomeController@template');
