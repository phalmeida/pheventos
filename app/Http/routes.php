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

Route::group(['middleware' => 'admin'], function ($route) {

    Route::group(['middleware' => 'auth:admin'], function ($route) {
        $route->get('/admin', 'AdminController@index');
    });
    $route->get('/admin/login', 'AdminController@login');
    $route->post('/admin/login', 'AdminController@postLogin');
    $route->get('/admin/logout', 'AdminController@logout');
});


/*
 * Administração dos eventos
 */
Route::group(['prefix' => 'administracao', 'middleware' => 'auth:admin', 'admin'], function ($route) {

    /**
     * Eventos
     */
    $route->get('eventos', 'Administracao\EventoController@index');
    $route->get('evento/cadastrar', 'Administracao\EventoController@formCadastro');
    $route->post('evento/cadastrar', 'Administracao\EventoController@salvarCadastro');
    $route->get('evento/editar/{id}', 'Administracao\EventoController@formEditar');
    $route->post('evento/editar/{id}', 'Administracao\EventoController@salvarEdicao');

    /**
     * Anexar Material ao Eventos
     */
    $route->get('evento/anexar/{id}', 'Administracao\EventoController@anexarMaterial');
    $route->post('evento/anexo/inserir', 'Administracao\EventoController@salvarAnexo');


    /**
     * Palestrantes
     */
    $route->get('palestrantes', 'Administracao\PalestranteController@index');
    $route->get('palestrante/cadastrar', 'Administracao\PalestranteController@formCadastro');
    $route->post('palestrante/cadastrar', 'Administracao\PalestranteController@salvarCadastro');
    $route->get('palestrante/editar/{id}', 'Administracao\PalestranteController@formEditar');
    $route->post('palestrante/editar/{id}', 'Administracao\PalestranteController@salvarEdicao');
    $route->get('palestrante/deletar/{id}', 'Administracao\PalestranteController@delete');
    $route->post('palestrante/pesquisar', 'Administracao\PalestranteController@pesquisar');

    /**
     * Lista de presença
     *
     */
    $route->get('presenca', 'Administracao\PresencaController@index');
    $route->get('presenca/lista/{id_evento}', 'Administracao\PresencaController@listaUsuarios');
    $route->post('presenca/salvar', 'Administracao\PresencaController@salvarPresenca');

    //Rota inicial da Dashboard
    $route->get('/', 'Painel\PainelController@index');

});

Route::group(['prefix' => 'usuario', 'middleware' => 'auth', 'web'], function ($route) {

    /**
     * Rota de inscrição do evento
     *
     */
    $route->get('evento/{id_evento}', 'Usuario\InscricaoController@inscricao');
    $route->get('eventos', 'Usuario\InscricaoController@eventos');
    $route->get('evento/cancelar/{id_evento}', 'Usuario\InscricaoController@cancelarInscricao');
    $route->get('evento/detalhar/{id_evento}', 'Usuario\InscricaoController@detalharEvento');

});


Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/template', 'HomeController@template');
